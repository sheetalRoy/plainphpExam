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
<p class="header-text">Print Question</p>
</div>
<div class="mainArea" id="loadArea">
</br>
<div class="messageAlert"></div>
<form id="printForm" role="form" method="POST" action="printController.php">
<input type="hidden" name="_token" value="">    
	<div class="form-group">
    <!-- Course -->
        <label class="control-label">Course</label>
        <div>
            <input type="text" id="code" name="course" class="textbox">
                        	
        </div>
    </div>
	<div class="form-group">
    <!-- Course code -->
        <label class="control-label">Course code</label>
        <div>
            <input type="text" id="code" name="code" class="textbox">
                        	
        </div>
    </div>
	<div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn" type="submit" onclick="fnGenerateQuestion()">Generate Question</button>
      </div>
    </div>
</form>
</br>
</div>
<div class="footer">
<p class='dashboard-text'>Designed & Developed by Laiphangbam Sheetal</p>
</div>
</body>
</html>
