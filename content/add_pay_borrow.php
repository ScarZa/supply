<section class="content-header">
              <?php if(isset($_REQUEST['method'])){
              if(($_REQUEST['method']=='edit') or ($_REQUEST['method']=='report')){?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  รายการจ่ายวัสดุ </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <?php if($_REQUEST['method']=='edit'){?>
              <li><a href="index.php?page=content/add_pay_order"><i class="fa fa-edit"></i> ข้อมูลจ่ายวัสดุ</a></li>
              <?php }?>
              <li class="active"><i class="fa fa-edit"></i> จ่ายวัสดุ</li>
              <?php }}?>           
            </ol>
        </section>
    <section class="content">
<?php if(null !==(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING))){
    $method=filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    if($method=='edit'){
        $bo_id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql="select CONCAT(e.firstname,' ',e.lastname) as fullname,bo.bo_date,d.depName,bo.bo_no from se_borrow_order bo
            inner join emppersonal e ON e.empno=bo.empno
            inner join department d ON d.depId=bo.dep_id
            where bo.bo_id='$bo_id'";
        $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $detial_order=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    
    include 'plugins/funcDateThai.php';
    ?>
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <table border="0">
        <tr>
            <td>เลขทะเบียนยืม : </td>
            <td> <input value="<?php if(isset($method)){ echo $detial_order[0]['bo_no'];}?>" type="text" name="bo_no" id="bo_no" placeholder="เลขทะเบียนยืม" class="form-control" required=""></td>
        </tr>
        <tr>
            <td>วันที่บันทึก : </td>
            <td> <?= DateThai2($detial_order[0]['bo_date'])?></td>
        </tr>
        <tr>
            <td>ผู้บันทึก : </td>
            <td> <?= $detial_order[0]['fullname']?></td>
        </tr>
        <tr>
            <td>หน่วยงาน : </td>
            <td> <?= $detial_order[0]['depName']?></td>
        </tr>
        <tr>
            <td>วันที่จ่ายวัสดุ : </td>
            <td> <input type="date" name="pbo_date" id="pbo_date" required class="form-control" ></td>
        </tr>
        <tr>
            <td>ผู้รับวัสดุ : </td>
            <td><select name="receiver" id="receiver" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">
    <option value="">เลือกบุคคลากร</option> 
        <?php
        $sql="SELECT empno, CONCAT(firstname,' ',lastname) as fullname FROM emppersonal ORDER BY empno";
        $mydata2=new Db_mng();
                $mydata2->read="connection/conn_DB.txt";
                $mydata2->config();
                $mydata2->conn_mysqli();
                $mydata2->db_m($sql);
        $result=$mydata2->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata2->close_mysqli();
        for($i=0;$i<count($result);$i++){
        if($result[$i]['empno']==$edit[0]['empno']){$selected='selected';}else{$selected='';}
        echo "<option value='".$result[$i]['empno']."'$selected>".$result[$i]['fullname'] ."</option>";
        
    }
        ?>
            
        </select></td>
        </tr>
    </table>
    <br>
    <div class="row">
          <div class="col-lg-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ข้อมูลรายการจ่ายวัสดุ</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <?php
                        
    
                        $sql="select * from se_borrow where bo_id='$bo_id'";
                        $mydata->db_m($sql);
                        $edit=$mydata->select();
                                               
                        $I=0;
                        for($c=1;$c<= count($edit);$c++){?>
                        <div class="col-lg-12">
                            <div class="col-lg-1 col-xs-1" align="right">
                                <h4><?= $c?>.</h4>
                            </div>
                            <div class="col-lg-3 col-xs-12">
                                <div class="form-group">
                            <label>ชนิดวัสดุ &nbsp;</label>
<!--<select name="mate_id[]" id="mate_id[]" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">-->
    <select name="mate_id[]" id="mate_id[]" required  class="form-control select2" data-placeholder="Select a State" style="width: 100%;">
    <option value="">เลือกวัสดุ</option> 
        <?php
        $sql="select * from se_material";
        $mydata1=new Db_mng();
                $mydata1->read="connection/conn_DB.txt";
                $mydata1->config();
                $mydata1->conn_mysqli();
                $mydata1->db_m($sql);
        $result=$mydata1->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata1->close_mysqli();
        for($i=0;$i<count($result);$i++){
        if($result[$i]['mate_id']==$edit[$I]['mate_id']){$selected='selected';}else{$selected='';}
        echo "<option value='".$result[$i]['mate_id']."'$selected>".$result[$i]['mate_name'] ."</option>";
        
    }
        ?>
            
    </select></div> </div>
                            <div class="col-lg-3 ol-xs-12"> 
                <label>จำนวน &nbsp;</label>
                <input value="<?php if(isset($method)){ echo $edit[$I]['amount'];}?>" type="text" class="form-control" name="amount[]" id="amount[]" placeholder="จำนวนวัสดุที่จ่ายออก" onkeydown="return nextbox(event, 'min')">
                            </div> 
                            
                        </div>
                  <input type="hidden" name="bo_id[]" id="bo_id[]" value="<?=$edit[$I]['bo_id']?>">      
                      <?php  $I++;}?>
                    </div>                   
                </div>
              </div>
              <?php if(isset($method)){
    if($method=='edit'){?>
    <input type="hidden" name="method" id="method" value="add_pay_borrow">
    <input type="hidden" name="bo_id" id="bo_id" value="<?=$bo_id?>">
   <input class="btn btn-primary" type="submit" name="submit" id="Submit" value="จ่ายวัสดุ">
              <?php }}?> 
           </div>            
    </div>
</form>
        <?php }} ?>
         <br>
    <?php include 'content/list_pay_borrow.php';?>
</section>