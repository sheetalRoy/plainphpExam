<?php
$fruitArr1 = array('Apple','Bananas','Cherries');
$fruitArr2 = array('Guava','Blueberry ','Bananas','Blueberries');
//$fruitArr2 = array('Apple','Blueberry ','Bananas','Blueberries');
$temp1 = '';
$temp2 = '';
$commonArr = array();
$commonArr2 = array();
$j=0;
$j=count($fruitArr1);
for($i=0;$i<count($fruitArr1);$i++){
	
	$temp1 = $fruitArr1[$i];
	foreach($fruitArr2 as $key => $value){
		if($i==0){
			if($temp1!=$value){
				//insert 2nd array value;
				$commonArr[$key] = $value;
			}
		}else{
			break;
		}
		
		
		
		//echo $commonArr[1];
		//echo $commonArr[2];
		//echo $commonArr[3];
	}
	$j=count($fruitArr2);
		$commonArr[$j]=$temp1;
		$j++;
	//$commmonArr[$j] = $temp1;
	//echo count($commonArr);
}
foreach($commonArr as $a){
			
		echo $a;
		}
	

?>