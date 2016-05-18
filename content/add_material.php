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
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  แก้ไขข้อมูลวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=content/add_company"><i class="fa fa-edit"></i> ข้อมูลวัสดุ</a></li>
              <li class="active"><i class="fa fa-edit"></i> แก้ไขข้อมูลวัสดุ</li>
              <?php }}else{?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  เพิ่มข้อมูลวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลวัสดุ</li>
              <?php }?>
            </ol>
        </section>
    <section class="content">
<?php
if(null !==(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING))){
    $method=filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    if($method=='edit'){
        $edit_id=filter_input(INPUT_GET,'id',  FILTER_SANITIZE_STRING);
        $sql="select * from se_material
            where mate_id='$edit_id'";
        $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $edit=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $mydata->close_mysqli();
    
    
}}
?>
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <div class="row">
          <div class="col-lg-12">
              <?php if(empty($method)){$coll_bos='collapsed-box';}?>
              <div class="box box-primary box-solid <?= $coll_bos?>">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ข้อมูลวัสดุ</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        
                    <div class="col-lg-3 ol-xs-12"> 
                <label>ชนิดวัสดุ &nbsp;</label>
<select name="mate_type_id" id="mate_type_id" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">
    <option value="">เลือกประเภทวัสดุ</option> 
        <?php
        $sql="select * from se_material_type";
        $mydata1=new Db_mng();
                $mydata1->read="connection/conn_DB.txt";
                $mydata1->config();
                $mydata1->conn_mysqli();
                $mydata1->db_m($sql);
        $result=$mydata1->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata1->close_mysqli();
        for($i=0;$i<count($result);$i++){
        if($result[$i]['mate_type_id']==$edit[0]['mate_type_id']){$selected='selected';}else{$selected='';}
        echo "<option value='".$result[$i]['mate_type_id']."'$selected>".$result[$i]['type_name'] ."</option>";
        
    }
        ?>
            
        </select>             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>ชื่อวัสดุ &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $edit[0]['mate_name'];}?>' type="text" class="form-control" name="mate_name" id="mate_name" placeholder="ชื่อวัสดุ" onkeydown="return nextbox(event, 'mate_unit')">
             	</div>
                       
                        
                  <div class="col-lg-3 ol-xs-12">
         			<label>หน่วยนับ &nbsp;</label>
                                <input value="<?php if(isset($method)){ echo $edit[0]['mate_unit'];}?>" name="mate_unit" id="mate_unit" class="form-control" placeholder="หน่วยนับ"  onkeydown="return nextbox(event, 'receive')" required="">	
                      </div>
                    <div class="col-lg-3 ol-xs-12"> 
                <label>จำนวน &nbsp;</label>
                <input <?php if(isset($method)){ echo 'readonly';}?> type="text" class="form-control" name="receive" id="receive" placeholder="จำนวนวัสดุ" onkeydown="return nextbox(event, 'min')">
             	</div>
                    <div class="col-lg-3 ol-xs-12"> 
                <label>จำนวนต่ำสุด &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $edit[0]['min'];}?>' type="text" class="form-control" name="min" id="min" placeholder="จำนวนต่ำสุดที่ควรเหลือในคลัง" onkeydown="return nextbox(event, 'max')">
             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>จำนวนสูงสุด &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $edit[0]['max'];}?>' type="text" class="form-control" name="max" id="max" placeholder="จำนวนสูงสุดที่ควรมีในคลัง" onkeydown="return nextbox(event, 'submit')">
             	</div>
                        
                    </div>
                </div>
              </div>
          </div>
</div>
    <?php if(isset($method)){
    if($method=='edit'){?>
    <input type="hidden" name="method" id="method" value="edit_mate">
    <input type="hidden" name="edit_id" id="edit_id" value="<?=$edit[0]['mate_id'];?>">
   <input class="btn btn-warning" type="submit" name="submit" id="Submit" value="แก้ไข">
    <?php }}else{?> 
   <input type="hidden" name="method" id="method" value="add_mate">
   <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
   <?php }?>
</form>
        <br>
    <?php include 'content/list_material.php';?>
</section>
 
         