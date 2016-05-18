<script type="text/javascript">
function nextbox(e, id) {
    var keycode = e.which || e.keyCode;
    if (keycode == 13) {
        document.getElementById(id).focus();
        return false;
    }
}
</script>
<script type="text/javascript">
		function popup(url,name,windowWidth,windowHeight){    
				myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
				mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
				properties = "width="+windowWidth+",height="+windowHeight;
				properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
				window.open(url,name,properties);
	}
</script>    
        <section class="content-header">
              <?php if(isset($_REQUEST['method'])){
              if($_REQUEST['method']=='edit'){?>
            <h1><img src='images/icon_set2/contacts.ico' width='40'><font color='blue'>  แก้ไขข้อมูลประเภทวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=content/add_mate_type"><i class="fa fa-edit"></i> ข้อมูลประเภทวัสดุ</a></li>
              <li class="active"><i class="fa fa-edit"></i> แก้ไขข้อมูลประเภทวัสดุ</li>
              <?php }}else{?>
            <h1><img src='images/icon_set2/contacts.ico' width='40'><font color='blue'>  เพิ่มข้อมูลประเภทวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลประเภทวัสดุ</li>
              <?php }?>
            </ol>
        </section>
    <section class="content">
<?php
if(null !==(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING))){
    $method=filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    if($method=='edit'){
        $edit_id=filter_input(INPUT_GET,'id',  FILTER_SANITIZE_STRING);
        $sql="select * from se_material_type
            where mate_type_id='$edit_id'";
        $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $mydata->close_mysqli();
    
    
}}
?>
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <div class="row">
          <div class="col-lg-12">
              <?php if(empty($method)){$coll_bos='collapsed-box';}?>
              <div class="box box-primary box-solid <?= $coll_bos?>">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set2/contacts.ico' width='25'> ข้อมูลประเภทวัสดุ</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                    <div class="col-lg-3 ol-xs-12"> 
                <label>ชื่อประเภทวัสดุ &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['type_name'];}?>' type="text" class="form-control" name="type_name" id="comp_name" placeholder="ชื่อชนิดวัสดุ" required>
             	</div>

                        </div>
                    </div>
                </div>
              </div>
          </div>
</div>
    <?php if(isset($method)){
    if($method=='edit'){?>
    <input type="hidden" name="method" id="method" value="edit_mate_type">
    <input type="hidden" name="edit_id" id="edit_id" value="<?=$result[0]['mate_type_id'];?>">
   <input class="btn btn-warning" type="submit" name="submit" id="Submit" value="แก้ไข">
    <?php }}else{?> 
   <input type="hidden" name="method" id="method" value="add_mate_type">
   <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
   <?php }?>
</form>
        <br>
    <?php include 'content/list_mate_type.php';?>
</section>
 
         