<?php

include ("../session/validateSession.php");
include ("../database/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $result = new stdClass();
    $result->success = true;
    $result->message = "";

    $databaseName = "marcianGol";
    mysqli_select_db($conn, $databaseName);

    $stmt = $conn->prepare("SELECT U.id_user, U.name, U.last_name, U.email, T.photo
                            FROM user U
                            INNER JOIN team T
                            ON T.id_team = U.id_team
                            WHERE U.id_user = ?");

    if (!$stmt) {
        $result->message .= "Error preparing the query: " . $conn->error;
        $result->success = false;
        set_error_log($result->message);
    } else {
        $stmt->bind_param("i", $_SESSION['id_user']);

        if (!$stmt->execute()) {
            $result->message .= "Error executing the query: " . $stmt->error;
            set_error_log($result->message);
        } else {
            $stmt->bind_result($result->id_user, $result->name, $result->last_name, $result->email, $result->photo);

            if (!$stmt->fetch()) {
                $result->success = false;
                $result->message = "No result for the Id User: " . $_SESSION['id_user'];
                set_error_log($result->message);
            } else {
                $result->success = true;
            }

        }  


    }

    echo json_encode($result);

}


?>