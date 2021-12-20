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
<div id="printQuestionPaper">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$course = $_POST['course'];
$code = $_POST['code'];
$sl_no = 1;
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    // set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT question_master.pk_id as id,question,question_master.status_id as mark,cl.class_name as course,cl.class_code as code,cl.batch as batch,ex.exam_name as exam FROM question_master "; 
$sql .= "INNER JOIN class_master as cl ON cl.pk_id = question_master.class ";
$sql .= "INNER JOIN exam_master as ex ON ex.pk_id = question_master.exam_id_fk ";
$sql .= "WHERE cl.class_name = '".$course."' ";
$sql .= "OR cl.class_code = '".$code."' ";
$res = $pdo->query($sql); 
$query2 = "SELECT cl.class_name as course,cl.class_code as code,cl.batch as branch FROM class_master as cl "; 
$query2 .= "WHERE cl.class_name = '".$course."' ";
$query2 .= "OR cl.class_code = '".$code."' ";
$menulisting = $pdo->query($sql); 
$i=0; 
while($row = $menulisting->fetch()) { 
      $i++;
      $courseName = $row["course"]; 
	  $courseCode = $row["code"];
	  $branch = $row["batch"];
	  $exam = $row["exam"];
      echo "<h3>Course : ".$courseName."</h3>";
	  echo "<h3>Course code : ".$courseCode."</h3>";
	  echo "<h3>Branch : ".$branch."</h3>";
	  echo "<h3>Exam Name : ".$exam."</h3>";
     if($i==1){break;}   
 }  

echo "<table id='a' width='100%'>"; 
//echo "<tr>";
	//		echo "<th>Course</th>";
		//	echo "</tr>";
			//echo "<tr>";
			//echo "<th>Branch</th></tr>";
			//echo "<tr>";
			//echo "<th>Course code</th></tr>";
            //echo "<tr>"; 
        while ($row = $res->fetch()) { 
			
            echo "<td>".$sl_no."</td>"; 
            echo "<td>".$row['question']."</td>"; 
			echo "<td>".$row['mark']." Mark</td>"; 
			//echo "<td>".$row['batch']."</td>";  
            echo "</tr>"; 
			$sl_no++;
        } 
        echo "</table>"; 
?>
</div>
<button class="btn" onclick="printDiv()" type="button">Print</button>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script>

</script>
</body>
</html>
