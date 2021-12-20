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
<div class="messageAlert"></div>
   <form id="questionForm" role="form" method="POST" action="">
       <input type="hidden" name="_token" value="">
       <div class="form-group">                    	
            <label class="control-label">Question</label>
             <div>
                <textarea class="comment-box" id="question" name="question"></textarea>                        	
             </div>
        </div>
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
            <label class="control-label">Mark</label>
             <div>
                <input type="text" class="textbox" id="mark" name="mark">                        	
             </div>
        </div>
		<!-- Exam -->
		   <div class="form-group">
            <label class="control-label">Exam</label>                        
<?php
$servername = "localhost";
$username = "root";
$password = "";
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT pk_id,exam_name FROM exam_master"; 
    $res = $pdo->query($sql);
	echo "<div>";	
    echo "<select name='exam' class='select-input' id='exam'>";
	echo "<option value=''>--select--</option>";
        while ($row = $res->fetch()) { 
            echo "<tr>"; 
            echo "<option value='".$row['pk_id']."'>".$row['exam_name']."</option>"; 
           
        } 
        
echo "</select>";
?>
</div>
		</div>
	</br>	
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn" type="button" onclick="fnQuestion()">Save</button>
      </div>
    </div>
    </form>
</div>
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>
