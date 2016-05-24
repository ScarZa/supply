<?php //require'../connection/connect.php'; ?>
<?php
 //if($_SESSION['Status_s']=='ADMIN'){ 
$result=$_GET['result'];
$select_id=$_GET['select_id'];
if ($result == 'process') {  
  
				echo "<option value=''>เลือกระบบ</option>";
                                if($select_id=='ADMIN'){
                                  if( $resultGet[0]['ss_process']=="0"){$Ok='selected';}
                                  echo "<option value='0'  $Ok>ผู้ดูแลระบบทั้งหมด</option>";
                                }elseif ($select_id=='SUSER') {
				if($resultGet[0]['ss_process']=="5"){$Selected='selected';}
				echo "<option value='5'  $Selected>ผู้ดูแลระบบพัสดุ</option>";	
}  } //}?>

