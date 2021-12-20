/*==================================
* Author        : "Sheetal"
==================================== */
function fnQuestion(){
	var message = $('.messageAlert');
	message.empty().removeClass("errorMsg successMsg");
	if($('#question').val()==''){
		message.addClass("errorMsg");
		message.text("Please enter question");
		return false;
		}
	if($('#course').val()==''){
		message.addClass("errorMsg");
		message.text("Please select course");
		return false;
		}
	if($('#mark').val()==''){
		message.addClass("errorMsg");
		message.text("Please enter mark");
		return false;
		}
	if($('#exam').val()==''){
		message.addClass("errorMsg");
		message.text("Please select exam");
		return false;
		}	
		var dataString = $('#questionForm').serialize();
				$.ajax({
    			type: "POST",
    			url: "questionController.php",
    			datatype: "html",
    			data: dataString,
    			success: function(result) {
    				var obj = JSON.parse(result);
    				if(obj.success){
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("successMsg");
						message.text(obj.msg);
    				    $('input:text,select, textarea').val("");
					}else{
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("errorMsg");
						message.text("Server not responding");
					}
    			}
		});
}
			
function fnSaveCourse(){
	var message = $('.messageAlert');
	message.empty().removeClass("errorMsg successMsg");
	if($('#course').val()==''){
		message.addClass("errorMsg");
		message.text("Please enter course");
		return false;
		}
	if($('#batch').val()==''){
		message.addClass("errorMsg");
		message.text("Please select branch");
		return false;
		}		
	var dataString = $('#courseForm').serialize();
				$.ajax({
    			type: "POST",
    			url: "connect.php",
    			datatype: "html",
    			data: dataString,
    			success: function(result) {
					var obj = JSON.parse(result);
    				if(obj.success){
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("successMsg");
						message.text(obj.msg);
    				    $('input:text,select, textarea').val("");
					}else{
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("errorMsg");
						message.text("Server not responding");
					}
    				
				}
		});
			}
	function fnGenerateQuestion(){
		var dataString = $('#printForm').serialize();
			$.ajax({
    			type: "POST",
    			url: "printController.php",
    			datatype: "html",
    			data: dataString,
    			success: function(result) {
					alert('lkkkk');
					
    				
				}
		});
	}
/* Save Examination Details */			
function fnSaveExamDetail(){
	var message = $('.messageAlert');
	message.empty().removeClass("errorMsg successMsg");
	if($('#course').val()==''){
		message.addClass("errorMsg");
		message.text("Please select course");
		return false;
		}
	if($('#examType').val()==''){
		message.addClass("errorMsg");
		message.text("Please select examType");
		return false;
		}
	
	if($('#examName').val()==''){
		message.addClass("errorMsg");
		message.text("Please enter exam name");
		return false;
		}
	if($('#examDate').val()==''){
		message.addClass("errorMsg");
		message.text("Please enter exam date");
		return false;
		}	
		var dataString = $('#examForm').serialize();
				$.ajax({
    			type: "POST",
    			url: "examController.php",
    			datatype: "html",
    			data: dataString,
    			success: function(result) {
    				var obj = JSON.parse(result);
    				if(obj.success){
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("successMsg");
						message.text(obj.msg);
    				    $('input:text,select, textarea').val("");
					}else{
						message.empty().removeClass("errorMsg successMsg");
						message.addClass("errorMsg");
						message.text("Server not responding");
					}
    			}
		});
}
/*Print function */
function printDiv() {
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    mywindow.document.writeln('<html><head><title>Exam</title>'); 
    mywindow.document.writeln('</head><body>');
    mywindow.document.writeln('<div>');
	var reportData = document.getElementById('printQuestionPaper').innerHTML;
    mywindow.document.write(reportData);
    mywindow.document.writeln('</div></body></html>');
    mywindow.print();
    mywindow.close();
}
