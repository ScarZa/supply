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
            <h1><img src='images/icon_set1/load_upload.ico' width='40'><font color='blue'>  เพิ่มข้อมูลขอยืมวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลขอยืมวัสดุ</li>
             </ol>
        </section>
    <section class="content">
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <div class="row">
          <div class="col-lg-12">
              <?php if(empty($method)){$coll_bos='collapsed-box';}?>
              <div class="box box-primary box-solid <?= $coll_bos?>">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set1/direction_up.ico' width='25'> ข้อมูลขอยืมวัสดุ</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        
                    <div class="col-lg-3 ol-xs-12"> 
                <label>ผู้ยืม &nbsp;</label>
<select name="empno" id="empno" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">
    <option value="">เลือกบุคคลากร</option> 
        <?php
        $sql="SELECT empno, CONCAT(firstname,' ',lastname) as fullname FROM emppersonal ORDER BY empno";
        $mydata1=new Db_mng();
                $mydata1->read="connection/conn_DB.txt";
                $mydata1->config();
                $mydata1->conn_mysqli();
                $mydata1->db_m($sql);
        $result=$mydata1->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata1->close_mysqli();
        for($i=0;$i<count($result);$i++){
        if($result[$i]['empno']==$edit[0]['empno']){$selected='selected';}else{$selected='';}
        echo "<option value='".$result[$i]['empno']."'$selected>".$result[$i]['fullname'] ."</option>";
        
    }
        ?>
            
        </select>             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>วันที่ขอยืม &nbsp;</label>
                <input value='<?php if(isset($method)){ echo $edit[0]['or_date'];}?>' type="date" class="form-control" name="bo_date" id="bo_date" placeholder="วันที่" onkeydown="return nextbox(event, 'mate_unit')">
             	</div>
                       
                        
                  <div class="col-lg-3 ol-xs-12">
         			<label>หน่วยงาน &nbsp;</label>
<select name="dep_id" id="dep_id" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">
    <option value="">เลือกหน่วยงาน</option> 
        <?php
        $sql="select * from department order by depid";
        $mydata2=new Db_mng();
                $mydata2->read="connection/conn_DB.txt";
                $mydata2->config();
                $mydata2->conn_mysqli();
                $mydata2->db_m($sql);
        $result=$mydata2->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata1->close_mysqli();
        for($i=0;$i<count($result);$i++){
        if($result[$i]['depId']==$edit[0]['dep_id']){$selected='selected';}else{$selected='';}
        echo "<option value='".$result[$i]['depId']."'$selected>".$result[$i]['depName'] ."</option>";
        
    }
        ?>
            
        </select>                       </div>
                    <div class="col-lg-3 ol-xs-12"> 
                <label>เลขทะเบียนยืม &nbsp;</label>
                <input value="<?php if(isset($method)){ echo $edit[0]['order_amount'];}?>" type="text" class="form-control" name="bo_no" id="bo_no" placeholder="เลขทะเบียนยืม" onkeydown="return nextbox(event, 'min')">
             	</div>
                        <div class="col-lg-3 ol-xs-12"> 
                <label>จำนวนรายการที่ขอยืม &nbsp;</label>
                <input value="<?php if(isset($method)){ echo $edit[0]['order_amount'];}?>" type="text" class="form-control" name="borrow" id="borrow" placeholder="จำนวนรายการที่ขอยืม" onkeydown="return nextbox(event, 'min')">
             	</div>
                    </div>
                </div>
              </div>
          </div>
</div>
   <input type="hidden" name="method" id="method" value="add_borrow_order">
   <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
</form>
        <br>
    <?php include 'content/list_borrow_order.php';?>
</section>
 
         