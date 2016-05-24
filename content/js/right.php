<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>
<body>
 
  
<?php //include'connection/connect.php';?>
	<script language="JavaScript">

function Check_txt(){
	if(document.getElementById('admin').value==""){
		alert("กรุณาระบุ จังหวัด ด้วย");
		document.getElementById('admin').focus();
		return false;
	}
	if(document.getElementById('right').value=='No'){
		alert("กรุณาระบุ อำเภอ ด้วย");
		document.getElementById('right').focus();
		return false;
	}
	
	if(document.getElementById('district').value==""){
		alert("กรุณาระบุ ตำบล ด้วย");
		document.getElementById('district').focus();
		return false;
	}
}
</script>
    <div class="form-group"> 
        <label>ระดับการใช้งาน &nbsp;</label><br>
                    <?php if($_SESSION['Status_s']=='ADMIN'){ ?>
	<select name='admin' id='admin'class='form-control' onchange="data_show(this.value,'process');"  required >
			<?php 		
				echo "<option value=''>เลือกระดับการใช้งาน</option>";			
		 		if( $resultGet[0]['ss_Status']=="ADMIN"){$ok='selected';}
				if( $resultGet[0]['ss_Status']=="A"){$ok2='selected';}
				if($resultGet[0]['ss_Status']=="SUSER"){$selected='selected';}
				echo "<option value='SUSER'  $selected>ผู้ดูแลระบบย่อย</option>";	
				//echo "<option value='A'  $ok2 >หัวหน้าฝ่าย</option>";	
				echo "<option value='ADMIN'  $ok >ผู้ดูแลระบบ</option>";						
				?>
			</select>
                         <?php }else{?>
                                <input type="text" name=''   id='' class='form-control'  value='<?= 'ผู้ดูแลระบบย่อย'?>' readonly >
                                    <input type="hidden" name="admin" id="admin" value="<?= $resultGet[0]['ss_Status']?>">
                         <?php }?>
                                </div>
        <div class="form-group">
        <label>ระดับการดูแลระบบ &nbsp;</label><br>
       
        <?php if(!empty($_GET['ss_id'])){ ?>
        
        <?php if($_SESSION['Status_s']=='ADMIN'){ ?>
	
             <select class="form-control" name='process' id='process'>
			<?php 		
				echo "<option value=''>เลือกระบบ</option>";			
		 		if( $resultGet[0]['ss_process']=="0"){$Ok='selected';
                                echo "<option value='0'  $Ok>ผู้ดูแลระบบทั้งหมด</option>";
                                }elseif( $resultGet[0]['ss_process']=="5"){
				if($resultGet[0]['ss_process']=="5"){$Selected='selected';}
				echo "<option value='5'  $Selected>ผู้ดูแลระบบพัสดุ</option>";	
                                }						
				?>
                         <?php }else{
                             if($resultGet[0]['ss_process']=='0'){
                                 $process='ผู้ดูแลระบบทั้งหมด';
                                    }elseif ($resultGet[0]['ss_process']=='5'){
                                  $process='ผู้ดูแลระบบพัสดุ';  
                                }
?>
                                <input type="text" name=''   id='' class='form-control'  value='<?= $process?>'  onkeydown="return nextbox(event, 'save');" readonly >
                                    <input type="hidden" name="process" id="process" value="<?= $resultGet[0]['ss_process']?>">
                         <?php }}  else {?>
                                        <select class="form-control" name='process' id='process'>
            <option value="">เลือกระบบ</option>
            <?php }?>
	</select>
	</div>
        <!--<div class="form-group">
        <label>ตำบล &nbsp;</label>  
	<select class="form-control" name='district' id='district'>
            <?php/* if($_REQUEST[method]=='edit'){
                $rstTemp = mysql_query("select * from district where DISTRICT_ID='$edit_person[tambol]'");
                while ($arr_2 = mysql_fetch_array($rstTemp)){
                if($arr_2[DISTRICT_ID]==$edit_person[tambol]){$selected='selected';}else{$selected='';}
                echo "<option value='$arr_2[DISTRICT_ID]' $selected>$arr_2[DISTRICT_NAME]</option>";
                
                } }  else {*/?>
		<option value="">---โปรดเลือกตำบล---</option>
                <?php// }?>
	</select>
        </div>-->

<script language="javascript">
// Start XmlHttp Object
function uzXmlHttp(){
    var xmlhttp = false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){
            xmlhttp = false;
        }
    }
 
    if(!xmlhttp && document.createElement){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
// End XmlHttp Object

function data_show(select_id,result){
	var url = 'content/js/right2.php?select_id='+select_id+'&result='+result;
	//alert(url);
	
    xmlhttp = uzXmlHttp();
    xmlhttp.open("GET", url, false);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
    xmlhttp.send(null);
	document.getElementById(result).innerHTML =  xmlhttp.responseText;
}
//window.onLoad=data_show(5,'amphur'); 
</script>

