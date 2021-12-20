<?php
$servername = "localhost";
$username = "root";
$password = "";
$startTime = $_POST['startTime'];
$course = $_POST['course'];
$examDate = $_POST['examDate'];
$examName = $_POST['examName'];
$examType = $_POST['examType'];
$examCode = $_POST['examCode'];
$endTime = $_POST['endTime'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO exam_master(exam_type_fk,exam_name,exam_code,exam_date,class,start_time,end_time)VALUES(?,?,?,?,?,?,?)";
    // use exec() because no results are returned
    $conn->prepare($sql)->execute([$examType,$examName,$examCode,$examDate,$course,$startTime,$endTime]);
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