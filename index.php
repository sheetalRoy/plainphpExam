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
	<style>
body {
  margin: 0;
}


</style>
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
<p class="header-text">Dashboard</p>
</div>
<div class="mainArea" id="loadArea">
</br>

<?php
$conn = mysqli_connect("localhost","root","","examination");
$questionArr = mysqli_query($conn,"SELECT * FROM question_master");
$countQ  = mysqli_num_rows($questionArr);
$courseArr = mysqli_query($conn,"SELECT * FROM class_master");
$countC  = mysqli_num_rows($courseArr);
$uploadArr = mysqli_query($conn,"SELECT * FROM upload_file");
$countU  = mysqli_num_rows($uploadArr);
$examArr = mysqli_query($conn,"SELECT * FROM exam_master");
$countE  = mysqli_num_rows($examArr);
echo "<div class='moduleContent'>";
echo "<div class='dashboard'>";
echo "<p class='dashboard-text'>Total number of question</p>";
echo "<p class='dashboard-text'>".$countQ."</p>";
echo "</div>";
echo "<div class='dashboard'>";
echo "<p class='dashboard-text'>Total number of course</p>";
echo "<p class='dashboard-text'>".$countC."</p>";
echo "</div>";
echo "</div><div class='moduleContent'>";
echo "<div class='dashboard'>";
echo "<p class='dashboard-text'>Total number of exam</p>";
echo "<p class='dashboard-text'>".$countE."</p>";
echo "</div>";
echo "<div class='dashboard'>";
echo "<p class='dashboard-text'>Total number of upload mark</p>";
echo "<p class='dashboard-text'>".$countU."</p>";
echo "</div>";
echo "</div>";
?>
</div>
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>	
</html>



