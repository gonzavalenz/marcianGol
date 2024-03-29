<?php

/* ------------------------ GET DATA USERS ------------------------ */

/* 

It need the User Id as 'id_user.

Returns an object with the next keys:
    - success: Boolean.
    - message: If there were an error then it saves here.
    - id_user: User ID.
    - name: Name of the user.
    - last_name: Last name of the user.
    - email: Email of the user.
    - photo: Path of the photo.

*/


include ("../session/validateSession.php");
include ("../database/connection.php");
include ("../error_stmt/errorFunctions.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $result = new stdClass();
    $result->success = true;

    $databaseName = "marcianGol";
    mysqli_select_db($conn, $databaseName);

    $stmt = $conn->prepare("SELECT U.id_user, U.name, U.last_name, U.email, T.photo
                            FROM user U
                            INNER JOIN team T
                            ON T.id_team = U.id_team
                            WHERE U.id_user = ?");

    if (!$stmt) {
        error_stmt($result, "Error preparing the query: " . $conn->error, $stmt, $conn);
    } 
    
    $stmt->bind_param("i", $_SESSION['id_user']);

    if (!$stmt->execute()) {
        error_stmt($result, "Error executing the query: " . $conn->error, $stmt, $conn);
    } 
    
    $stmt->bind_result($result->id_user, $result->name, $result->last_name, $result->email, $result->photo);

    if (!$stmt->fetch()) {
        error_request($result, "No result for the Id User: " . $_SESSION['id_user']);
    } else {
        $result->success = true;
    }

    echo json_encode($result);

}


?>