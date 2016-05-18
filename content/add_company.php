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
            <h1><img src='images/icon_set2/Store.ico' width='40'><font color='blue'>  แก้ไขข้อมูลร้านค้า </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=content/add_company"><i class="fa fa-edit"></i> ข้อมูลร้านค้า</a></li>
              <li class="active"><i class="fa fa-edit"></i> แก้ไขข้อมูลร้านค้า</li>
              <?php }}else{?>
            <h1><img src='images/icon_set2/Store.ico' width='40'><font color='blue'>  เพิ่มข้อมูลร้านค้า </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลร้านค้า</li>
              <?php }?>
            </ol>
        </section>
    <section class="content">
<?php
if(null !==(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING))){
    $method=filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    if($method=='edit'){
        $edit_id=filter_input(INPUT_GET,'id',  FILTER_SANITIZE_STRING);
        $sql="select * from se_company
            where comp_id='$edit_id'";
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
                  <h3 class="box-title"><img src='images/icon_set2/Store.ico' width='25'> ข้อมูลร้านค้า</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                    <div class="col-lg-3 ol-xs-12"> 
                <label>ชื่อร้านค้า &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['comp_name'];}?>' type="text" class="form-control" name="comp_name" id="comp_name" placeholder="ชื่อร้านค้า" onkeydown="return nextbox(event, 'comp_vax')" required="">
             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>เลขที่เสียภาษี &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['comp_vax'];}?>' type="text" class="form-control" name="comp_vax" id="comp_vax" placeholder="เลขที่เสียภาษีร้านค้า" onkeydown="return nextbox(event, 'comp_address')">
             	</div>
                        </div>
                        <div class="col-lg-12">
                  <div class="col-lg-3 ol-xs-12">
         			<label>ที่อยู่ร้านค้า &nbsp;</label>
                                <textarea name="comp_address" id="comp_address" class="form-control" placeholder="ที่อยู่ร้านค้า"  onkeydown="return nextbox(event, 'comp_tell')" required=""><?php if(isset($method)){ echo $result[0]['comp_address'];}?></textarea>		
                      </div>
                    <div class="col-lg-3 ol-xs-12"> 
                <label>หมายเลขโทรศัพท์ &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['comp_tell'];}?>' type="text" class="form-control" name="comp_tell" id="comp_tell" placeholder="หมายเลขโทรศัพท์" onkeydown="return nextbox(event, 'comp_mobile')">
             	</div>
                    <div class="col-lg-3 ol-xs-12"> 
                <label>หมายเลขโทรศัพท์มือถีอ &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['comp_mobile'];}?>' type="text" class="form-control" name="comp_mobile" id="comp_mobile" placeholder="หมายเลขโทรศัพท์มือถีอ" onkeydown="return nextbox(event, 'comp_fax')">
             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>โทรสาร &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $result[0]['comp_fax'];}?>' type="text" class="form-control" name="comp_fax" id="comp_fax" placeholder="หมายเลขโทรสาร" onkeydown="return nextbox(event, 'submit')">
             	</div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
</div>
    <?php if(isset($method)){
    if($method=='edit'){?>
    <input type="hidden" name="method" id="method" value="edit_comp">
    <input type="hidden" name="edit_id" id="edit_id" value="<?=$result[0]['comp_id'];?>">
   <input class="btn btn-warning" type="submit" name="submit" id="Submit" value="แก้ไข">
    <?php }}else{?> 
   <input type="hidden" name="method" id="method" value="add_comp">
   <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
   <?php }?>
</form>
        <br>
    <?php include 'content/list_company.php';?>
</section>
 
         