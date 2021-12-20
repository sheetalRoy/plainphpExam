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

<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="course.php">Course</a></li>
  <li><a class="" href="question.php">Question Bank</a></li>
  <li><a class="" href="searchQuestion.php">Set Question</a></li>
  <li><a href="print.php">Print Question</a></li>
  <li><a href="exam.php">Exam</a></li>
  <li><a href="upload.php">Upload</a></li>
</ul>
<div class="header-bar">
<p class="header-text">Question Bank</p>
</div>
<div class="mainArea" id="loadArea">
</br>
<div id="printQuestionPaper">
   <form id="register" role="form" method="POST" action="">
                                                             
<?php
$servername = "localhost";
$username = "root";
$password = "";
$sl_no = 1;
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    // set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT question_master.pk_id as id,question,question_master.status_id as mark,cl.class_name as course,cl.class_code as code,cl.batch as batch FROM question_master "; 
$sql .= "INNER JOIN class_master as cl ON cl.pk_id = question_master.class ";
$res = $pdo->query($sql); 
echo "<table class='tbl-container' width='100%'>"; 
echo "<tr>"; 
echo "<th>Sl.No.</th>"; 
echo "<th>Question</th>";
echo "<th>Mark</th>"; 
echo "<th>Course</th>";
echo "<th>Course code</th>";
echo "<th>Branch</th>"; 
//echo "<th>Action</th>"; 
echo "</tr>"; 
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<td>".$sl_no."</td>"; 
            echo "<td>".$row['question']."</td>";
			echo "<td>".$row['mark']."</td>";	
			echo "<td>".$row['course']."</td>"; 
			echo "<td>".$row['code']."</td>";
			echo "<td>".$row['batch']."</td>"; 
           // echo "<td><button class='btn' type='button'>Set</button></td>"; 
            echo "</tr>"; 
			$sl_no++;
        } 
        echo "</table>"; 
?>

                    
</form>
</div><!--printQuestionPaper end-->
<button class="btn" onclick="printDiv()" type="button">Print</button>
<a href="exportExcelController.php">Export Excel</a>
</div>
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>
