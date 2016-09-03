  <script language="javascript">
function fncSubmit()
	{
	 if(document.form1.user_pwd.value != document.form1.user_pwd2.value)
		{
			alert('การยืนยันรหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ');
			document.form1.user_pwd.focus();		
			return false;
		}else{	
			return true;
			document.form1.submit();
		}
}
</script>
<section class="content-header">
               <h1> <font color="blue">ตั้งค่าผู้ใช้งาน</font></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่าผู้ใช้งาน</li>
            </ol>
</section>
			<?php 
                $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
    
			 if(null !==(filter_input(INPUT_GET, 'ss_id', FILTER_SANITIZE_NUMBER_INT))){ 
			 $user_idGet=filter_input(INPUT_GET, 'ss_id', FILTER_SANITIZE_NUMBER_INT);
                          if(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING)=='update_user'){
                             $status= filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
                         }else{
                         $status=$_SESSION['Status_s'];}
			 $sql="select ssm.*,concat(e.firstname,' ',e.lastname) as fullname from  ss_member ssm
                             inner join emppersonal e on e.empno=ssm.ss_Name where ssm.ss_Name='$user_idGet' and ssm.ss_Status='$status'";
			 $mydata->db_m($sql);
                         $resultGet=$mydata->select();
			 }
			   ?> 
<section class="content">
<div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">เพิ่มผู้ใช้งานระบบ</h3>
                    </div>
                <div class="panel-body">		
                    <form name='form1' class="navbar-form navbar-left"  action='index.php?page=process/prc_data' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
                        <b>ชื่อ-นามสกุล </b><br>
                        <div class="form-group">	
                        <?php if($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5'){?>
                            <input type="text" name='names'   id='names' class='form-control' value='<?=$resultGet[0]['fullname']?>'  onkeydown="return nextbox(event, 'save');" readonly >
                            <input type="hidden" name="name" id="name" value="<?=$resultGet[0]['ss_Name']?>">
                            <?php }else{?>
                         	<select name="name" id="name" required  class="form-control select2"  onkeydown="return nextbox(event, 'fname');"> 
				<?php	$sql = "SELECT empno,concat(firstname,' ',lastname) as fullname  FROM emppersonal order by empno ";
				 echo "<option value=''>เลือกบุคลากร</option>";
                                 $mydata1=new Db_mng();
                $mydata1->read="connection/conn_DB.txt";
                $mydata1->config();
                $mydata1->conn_mysqli();
                $mydata1->db_m($sql);
        $result=$mydata1->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata1->close_mysqli();
        for($i=0;$i<count($result);$i++){
                                if($result[$i]['empno']==$resultGet[0]['ss_Name']){$selected='selected';}else{$selected='';}
				echo "<option value='".$result[$i]['empno']."' $selected>".$result[$i]['fullname']." </option>";
				 } ?>
			 </select>
                            <?php }?>
			 </div> 
                        <br>
                        <div class="form-group">
                            <?php include 'content/js/right.php';?>
                        </div><br>
                        <?php if($_SESSION['Status_s']=='ADMIN'){
                            $read='';
                        }else{
                            $read='readonly';
                        }
?>
			<div class="form-group">	
                            <b>ชื่อผู้ใช้งาน</b><br>
                        <input type='text' name='user_account'  id='user_account' placeholder='ชื่อผู้ใช้งาน' class='form-control'  onkeydown="return nextbox(event, 'user_pwd');"   value='<?php if(!empty($user_idGet)){ echo $resultGet[0]['ss_user_name'];}?>' required <?= $read?>>
			 </div> 
                        <br>
			<?PHP 
			if(empty($user_idGet)){
			 	$required='required';			
			}else{
				$required='';
			}
			?> 
			<div class="form-group">
                            <b>รหัสผ่าน</b><br>
			<input type="password" name='user_pwd'  id='user_pwd' placeholder='รหัสผ่าน' class='form-control'  value=''  onkeydown="return nextbox(event, 'user_pwd2');" <?= $required?>>
			 </div><br>
	 		<div class="form-group">
                            <label for="user_pwd2">ยืนยันรหัสผ่าน</label><br>
			<input type="password" name='user_pwd2' id='user_pwd2' placeholder='ยืนยันรหัสผ่าน' class='form-control'  value=''  onkeydown="return nextbox(event, 'save');" <?= $required?>>
			 </div><br>
                         <font color="red"><?php 	if(!empty($user_idGet)){echo "*หากไม่เปลี่ยนรหัสผ่านไม่ต้องแก้ไข";}?></font>
 <br>
 <?PHP 
	if(!empty($user_idGet)){
            if(!empty($_GET['ID'])){
            $Get_id=$_GET['ID'];}  else {
                $Get_id=$resultGet[0]['ss_UserID'];
}
                echo "<input type='hidden' name='ID' value='$Get_id'>";
		echo "<input type='hidden' name='ss_id' value='$user_idGet'>";
		echo "<input type='hidden' name='method' value='update_user'>";
                ?>
        <p><button  class="btn btn-warning" id='save'> แก้ไข </button > <input type='reset' class="btn btn-danger"   > </p>
	<?php }  else {?>
        <input type="hidden" name="method" value="add_user">
         <p><button  class="btn btn-success" id='save'> บันทึก </button > <input type='reset' class="btn btn-danger"   > </p>
              <?php } ?>
		</form>

      </div>
    </div>
              </div>
    </div>
         <?php if($_SESSION['Status_s']=='ADMIN'){?>
        	  <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">ผู้ใช้งานระบบ</h3>
                    </div>
                  <div class="panel-body">
                    
<?php include 'list_user.php';?> 
      <!--  row of columns -->
 </div>
       </div></div></div>   
         <?php }?>
</section>
