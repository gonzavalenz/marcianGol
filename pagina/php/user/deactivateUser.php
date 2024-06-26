<?php

/* ------------------------ DEACTIVATE USER IN DATABASE ------------------------ */
/* 

It need the User Id as 'id_user.

Returns an object with the next keys:
    - success: Boolean.
    - message: If there were an error then it saves here.

*/

include ("../session/validateSession.php");
include ("../database/connection.php");
include ("../error_stmt/errorFunctions.php");

$id_user = !empty($_GET['id_user']) ? $_GET['id_user'] : null;

$result = new stdClass();
$result->success = true;

$databaseName = "marcianGol";
mysqli_select_db($conn, $databaseName);

# Update instruction
$updateQuery = "UPDATE user SET active = 0 WHERE id_user = ?";
$stmt = $conn->prepare($updateQuery);

if (!$stmt) {
    error_stmt($result, "Error preparing the query: " . $conn->error, $stmt, $conn);
}

if ($id_user === null) {
    $stmt->bind_param("i", $_SESSION['id_user']);
} else {
    $stmt->bind_param("i", $id_user);
}

if (!$stmt->execute()) {
    error_stmt($result, "Error executing the query: " . $conn->error, $stmt, $conn);
}     



$stmt->close();
$conn->close(); 

echo json_encode($result);

?>