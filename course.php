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
<p class="header-text">Course</p>
</div>
<div class="mainArea" id="loadArea">
</br>
<div class="messageAlert"></div>
<form id="courseForm" role="form" method="POST" action="">
<input type="hidden" name="_token" value="">
    <div class="form-group">
    <!-- Course -->
        <label class="control-label">Course</label>
    <div>
        <input type="text" id="course" name="course" class="textbox">
                        	
    </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Course code</label>
        <div>
            <input type="text" id="code" name="code" class="textbox">
                        	
        </div>
    </div>
                    <div class="form-group">
                    	<!-- Branch -->
                        <label class="control-label">Branch</label>
                        <div>
                            <input type="text" id="batch" name="batch" class="textbox">
                        	
                        </div>
                    </div>
                    
                     <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn" type="button" onclick="fnSaveCourse()">Save</button>
      </div>
    </div>
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$sl_no = 1;
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    // set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT cl.class_name as course,cl.class_code as code,cl.batch as branch FROM class_master as cl "; 
$res = $pdo->query($sql); 
echo "<table class='tbl-container' width='100%'>"; 
echo "<tr>"; 
echo "<th>Sl.No.</th>"; 
echo "<th>Course</th>"; 
echo "<th>Course Code</th>";
echo "<th>Branch</th>"; 
//echo "<th>Action</th>"; 
echo "</tr>"; 
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<td>".$sl_no."</td>"; 
            echo "<td>".$row['course']."</td>"; 
			echo "<td>".$row['code']."</td>"; 
			echo "<td>".$row['branch']."</td>"; 
            //echo "<td><button class='btn' type='button'>Set</button></td>"; 
            echo "</tr>"; 
			$sl_no++;
        } 
        echo "</table>"; 
?>
</div>
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>	
</html>



