<?php

require $_SERVER['backend'] . '/dane.php';
if (isset($_COOKIE['logtoken'])) {
    $ciastko = $_COOKIE['logtoken'];
}
$ciastko_hash = hash('sha256',$ciastko);
$sql = "SELECT mail FROM $table WHERE token = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ciastko_hash);
$stmt->execute();
$stmt->store_result();




    if ($stmt->num_rows > 0) {
        echo json_encode (["status" => "valid"]);
        $stmt->close();
        exit();
    }
    else {
        echo json_encode (["status" => "notvalid"]);
        $stmt->close();
        exit();
        

    }

?>
    

