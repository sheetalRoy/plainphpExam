<?php
$servername = "localhost";
$username = "root";
$password = "";
$batch = $_POST['batch'];
$course = $_POST['course'];
$code = $_POST['code'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO class_master(class_name,class_code,batch)VALUES(?,?,?)";
    // use exec() because no results are returned
    $conn->prepare($sql)->execute([$course,$code,$batch]);
    // $conn->exec($sql);

    // echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
$jsonobj = array(
    "msg" => 'Save Successfully!',
    "success" => true
);
    $jsonData = json_encode($jsonobj); 
    echo $jsonData;
?>