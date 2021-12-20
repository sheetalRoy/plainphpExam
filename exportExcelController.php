<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- META DATA -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->				
        <!-- TITLE OF SITE -->
        <title>Assignment</title>
        <!-- for title img -->
		<link rel="shortcut icon"  type="image/icon" href="assets/images/logo/favicon.png"/>       
        <!--style.css -->
        <link rel="stylesheet" href="assets/css/style.css">        
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$sl_no = 1;
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT question_master.pk_id as id,question,question_master.status_id as mark,cl.class_name as course,cl.class_code as code,cl.batch as batch FROM question_master "; 
$sql .= "INNER JOIN class_master as cl ON cl.pk_id = question_master.class ";
$res = $pdo->query($sql); 
echo "<table>"; 
echo "<tr>"; 
echo "<th>Sl.No.</th>"; 
echo "<th>Question</th>";
echo "<th>Mark</th>"; 
echo "<th>Course</th>";
echo "<th>Course code</th>";
echo "<th>Branch</th>";  
echo "</tr>"; 
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<td>".$sl_no."</td>"; 
            echo "<td>".$row['question']."</td>";
			echo "<td>".$row['mark']."</td>";	
			echo "<td>".$row['course']."</td>"; 
			echo "<td>".$row['code']."</td>";
			echo "<td>".$row['batch']."</td>";  
            echo "</tr>"; 
			$sl_no++;
        } 
        echo "</table>"; 
$file="question.xls";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

?>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script>

</script>
</body>
</html>
