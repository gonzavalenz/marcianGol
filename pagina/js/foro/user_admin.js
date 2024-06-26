// Ajax to get all the users from database
function getUsers() {
	return new Promise(function (resolve, reject) {
		var settings = {
            "url": "../../php/user/getUser.php",
            "method": "GET",
            "timeout": 0,
            "data": {
                active_user: 1
            }
		}

		$.ajax(settings).done(function (response) {
			resolve(response);
		}).fail(function (jqXHR, textStatus, errorThrown) {
			reject(errorThrown);
		});
	});
}

// Ajax to deactivate the user from the database
function deactivateUser(idUser, nameUser, location) {
	return new Promise(function (resolve, reject) {
		$.ajax({
            url: "../../php/user/deactivateUser.php",
            type: "GET", 
            data: {
                id_user: idUser,
            },
            success: function(response) {

                try {
                    response = JSON.parse(response);
                } catch (error) {
                    response.success = false;
                }
                
                // Show modals to user
                if (response.success) {

                    $("#confirmModalLabel").text("Usuario Desactivado");
                    $("#confirmModalText").text("Se desactivó correctamente el usuario: '" + nameUser + "'.");
                    
                    // Evento que se dispara cuando el modal se cierra
                    $('#confirmModal').on('hidden.bs.modal', function () {
                        // Redireccionar una vez que el modal se haya cerrado
                        window.location.href = location;
                    });
                } else {
                    console.log(idForo);
                    $("#confirmModalLabel").text("Error al desactivar");
                    $("confirmModalText").text("Lo siento, hubo un error al desactivar el usuario. Contáctese con soporte");
                }

                $('#confirmModal').modal('show');
                $('#confirmQuestion').modal('hide');
            },
            error: function(xhr, status, error) {
                // Acciones a realizar en caso de error
                console.log("Error en la solicitud AJAX:", error);
            }
        });
	});
}

// Function to create rows to fill the body table
function createRow(user) {

    var id_deactivate_btn = "deactivate_btn_" + user.id_user;
    var id_modify_btn = "modify_btn_" + user.id_user;

    // Creating rows
    var row = $("<tr>");
    row.append("<td>" + user.id_user + "</td>");
    row.append("<td>" + user.user_name + "</td>");
    row.append("<td>" + user.last_name + "</td>");
    row.append("<td>" + user.email + "</td>");
    row.append("<td>" + user.name + "</td>");
    var active = user.active ? "<i class='las la-check' style='color: green'></i>" : "<i class='las la-times' style='color: red'></i>";
    row.append("<td>" + active + "</td>");
    var admin = user.admin ? "<i class='las la-check' style='color: green'></i>" : "<i class='las la-times' style='color: red'></i>";
    row.append("<td>" + admin + "</td>");
    
    // If the user is not active then the deactivate button is disabled
    if (user.active === 1) {
        row.append('<td><button class="btn-deactivate btn btn-danger" id="' + id_deactivate_btn + '">Desactivar</button></td>');
    } else {
        row.append('<td><button class="btn btn-danger disabled">Desactivar</button></td>');
    }
    
    return row;
}

// Función de comparación personalizada para ordenar por iconos
function compareIcons(a, b) {
    var iconA = $(a).find('i').attr('class');
    var iconB = $(b).find('i').attr('class');

    // Lógica para ordenar por clases de iconos
    if (iconA < iconB) {
        return -1;
    }
    if (iconA > iconB) {
        return 1;
    }
    return 0;
}

function orderTableUser(column, order) {
    var table = $('#table_userList').find('tbody');
    var rows = table.find('tr').toArray();

    rows.sort(function(a, b) {
        // If the column is 'activo' or 'admin' I catch the class to order, and if not I catch the atribute 'data-column'
        if ((column === 'activo') || (column === 'admin')) {
            var aValue = $(a).find('td:eq(' + $('th[data-column="' + column + '"]').index() + ')').find('i').attr('class');
            var bValue = $(b).find('td:eq(' + $('th[data-column="' + column + '"]').index() + ')').find('i').attr('class');

        } else {
            var aValue = $(a).find('td:eq(' + $('th[data-column="' + column + '"]').index() + ')').text();
            var bValue = $(b).find('td:eq(' + $('th[data-column="' + column + '"]').index() + ')').text();
        }
         
        // Convertir valores a minúsculas para la comparación (ignorar mayúsculas/minúsculas)
        aValue = aValue.toLowerCase();
        bValue = bValue.toLowerCase();
    
        if (order === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });

    table.empty().append(rows);
}

$(document).ready(function() {
    
    // Filling the body table with the user information
    getUsers().then(function (users) {
		if (users != null) {
			var objUsers = JSON.parse(users);
			
            for (var i = 0; i < objUsers.data.length; i++) {
                var row = createRow(objUsers.data[i]);
                $("#table_user_body").append(row);
            }

		} else {
			console.log("Nop");
		}
	}).catch(function (error) {
		console.error("Error al obtener foros:", error);
	});

    // Display deactive modal
    $(document).on("click", ".btn-deactivate", function() {

        // Get the ID of the foro clicked
        var id_user = $(this).attr("id");
        id_user = id_user.split("_");
        id_user = id_user[id_user.length - 1];
        console.log(id_user);

        var row = $(this).closest('tr');
        var nameUser = row.find('td:eq(1)').text();
        var lastNameUser = row.find('td:eq(2)').text();
        var complete_name = lastNameUser + " " + nameUser;
        
        $("#questionModalLabel").text("Desactivar Usuario");
        $("#questionModalText").text("¿Desea desactivar el usuario '" + complete_name + "'? Una vez desactivado no se podrá reactivar.");
        $('#confirmQuestion').modal('show');

        $("#confirmQuestionBtn").on("click", function() {
            deactivateUser(id_user, complete_name, "user_admin.php");
        })
    })

    // Manage the sort request
    $('.sortable').on('click', function() {

        var column = $(this).data('column');
        var sortOrder = $(this).hasClass('asc') ? 'desc' : 'asc';
        
        // Remover clases de ordenación de otras columnas
        $('.sortable').removeClass('asc desc');
        
        // Agregar clase de ordenación a la columna clicada
        $(this).addClass(sortOrder);
        
        // Lógica para ordenar la tabla
        orderTableUser(column, sortOrder);
    });
})