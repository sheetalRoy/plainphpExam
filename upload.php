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
<p class="header-text">Upload Mark</p>
</div>
<div class="mainArea" id="loadArea">
</br>
   <form action="uploadController.php" method="post" enctype="multipart/form-data">
<input type="file" class="textbox" name="fileToUpload" id="filepath"/>
<input type="submit" name="SubmitButton" class="btn"/>
<div class="uploadContainer">
                                                   
<?php
$servername = "localhost";
$username = "root";
$password = "";
$sl_no = 1;
$pdo = new PDO("mysql:host=$servername;dbname=examination", $username, $password);
    // set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT file_path FROM upload_file "; 
$res = $pdo->query($sql); 


        while ($row = $res->fetch()) { 
			echo "<div class='imgContainer'>";
            echo '<img src="'.$row['file_path'].'"height="250" width="250">'; 
			echo "</div>";
			$sl_no++;
        } 
        
?>

                    
</form>
</div>
</div> <!--mainArea end -->
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
</body>
</html>
