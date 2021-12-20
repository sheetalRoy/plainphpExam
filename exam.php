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
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
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
<p class="header-text">Examination</p>
</div>
<div class="mainArea" id="loadArea">
</br>
<div class="messageAlert"></div>
<form id="examForm" role="form" method="POST" action="">
<input type="hidden" name="_token" value="">
<div class="form-group">
<label class="control-label">Course</label>                        
<?php
$servername = "localhost";
$username = "root";
$password = "";
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT pk_id,class_name FROM class_master"; 
    $res = $pdo->query($sql);
	echo "<div>";	
    echo "<select name='course' class='select-input' id='course'>";
	echo "<option value=''>--select--</option>";
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<option value='".$row['pk_id']."'>".$row['class_name']."</option>"; 
           
        } 
        
echo "</select>";
?>
</div>
</div>
	<div class="form-group">
    <!-- exam type -->
        <label class="control-label">Exam Type</label>
        <div>
            <select name="examType" id="examType" class="select-input">
				<option value="">--select--</option>
				<option value="1">Written</option>
				<option value="2">Oral</option>
				<option value="3">Practical</option>
            </select>
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Exam Name</label>
        <div>
            <input type="text" id="examName" name="examName" class="textbox">
                        	
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Exam Code</label>
        <div>
            <input type="text" id="examCode" name="examCode" class="textbox">
                        	
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Exam Date</label>
        <div>
            <input type="date" id="examDate" name="examDate" class="textbox">
                        	
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Start Time</label>
        <div>
            <input type="time" id="" name="startTime" class="textbox">
                        	
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">End Time</label>
        <div>
            <input type="time" id="" name="endTime" class="textbox">
                        	
        </div>
    </div>
             
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn" type="button" onclick="fnSaveExamDetail()">Save</button>
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
$sql = "SELECT ex.exam_name as examName,ex.exam_type_fk as type, ex.exam_code as code, ex.exam_date as date,ex.start_time as start FROM exam_master as ex "; 
$res = $pdo->query($sql); 
echo "<table class='tbl-container' width='100%'>"; 
echo "<tr>"; 
echo "<th>Sl.No.</th>"; 
echo "<th>Exam Type</th>";
echo "<th>Exam Name</th>"; 
echo "<th>Exam Code</th>";
echo "<th>Date</th>"; 
echo "<th>Start Time</th>";
//echo "<th>Action</th>"; 
echo "</tr>"; 
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<td>".$sl_no."</td>"; 
			if($row['type']==1){
				echo "<td>Written</td>";
			}else if($row['type']==2){
				echo "<td>Oral</td>";
			}else{
				echo "<td>Practical</td>";
			}
            echo "<td>".$row['examName']."</td>"; 
			echo "<td>".$row['code']."</td>"; 
			echo "<td>".$row['date']."</td>"; 
			echo "<td>".$row['start']."</td>"; 
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



