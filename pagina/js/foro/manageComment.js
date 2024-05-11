
// Ajax to update the like interaction
function updateLike(id_comment) {
    return new Promise(function (resolve, reject) {

        var settings = {
            "url": "../../php/comment/like.php",
            "method": "POST",
            "timeout": 0,
            "data": {
                id_comment: id_comment
            }
        };

        $.ajax(settings).done(function (response) {
            resolve(response);
            response = JSON.parse(response);

            var iconId = "#iconId_" + id_comment;
            var likesTagId = "#idLikesTag_" + id_comment;
            
            // If the result is a like or get back of the like
            if (response.reaction) {
                // Paint the heart and update count likes
                $(iconId).attr('class', 'las la-heart la-2x');
                $(likesTagId).text(response.count_likes);
            } else {
                // Clean the heart and update count likes
                $(iconId).attr('class', 'lar la-heart la-2x');
                $(likesTagId).text(response.count_likes);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            reject(errorThrown);
        });
    });
}

$(document).ready(function() {
    $(document).on("click", ".btn_reaction", function() {
        // Getting the ID of the comment
        var id_comment = $(this).attr('id');
        var id_comment = id_comment.split("_");
        id_comment = id_comment.pop();

        updateLike(parseInt(id_comment));
    })  
})