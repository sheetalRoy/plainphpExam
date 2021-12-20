<?php
$servername = "localhost";
$username = "root";
$password = "";
$question = $_POST['question'];
$course = $_POST['course'];
$mark = $_POST['mark'];
$examId = $_POST['exam'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO question_master(question,exam_id_fk,class,status_id)VALUES(?,?,?,?)";
    // use exec() because no results are returned
    $conn->prepare($sql)->execute([$question,$examId,$course,$mark]);
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
    // }
// catch(PDOException $e)
//     {
//     echo "Connection failed: " . $e->getMessage();
//     }
?>