<section class="content-header">
              <?php if(isset($_REQUEST['method'])){
              if($_REQUEST['method']=='edit'){?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  แก้ไขรายการขอเบิก </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=content/add_import_order"><i class="fa fa-edit"></i> ข้อมูลนำเข้า</a></li>
              <li class="active"><i class="fa fa-edit"></i> แก้ไขข้อมูลขอเบิก</li>
              <?php }}else{?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  เพิ่มข้อมูลขอเบิก </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลขอเบิก</li>
              <?php }?>
            </ol>
        </section>
    <section class="content">
<?php
        $po_id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql="select CONCAT(e.firstname,' ',e.lastname) as fullname,po.or_date,d.depName,po.or_no from se_pay_order po
            inner join emppersonal e ON e.empno=po.empno
            inner join department d ON d.depId=po.dep_id
            where po.po_id='$po_id'";
        $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $detial_order=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    
    include 'plugins/funcDateThai.php';
    ?><table border="0">
        <tr>
            <td>เลขทะเบียนเอกสาร : </td><td><u> <?= $detial_order[0]['or_no']?></u></td>
        </tr>
        <tr>
        <td>วันที่บันทึก : </td><td><u> <?= DateThai2($detial_order[0]['or_date'])?></u></td>
        </tr>
        <tr>
        <td>ผู้บันทึก : </td><td><u> <?= $detial_order[0]['fullname']?></u></td>
        </tr>
        <tr>
        <td>หน่วยงาน : </td><td><u> <?= $detial_order[0]['depName']?></u></td>
   </tr>
    </table>
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <div class="row">
          <div class="col-lg-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ข้อมูลรายขอเบิก</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <?php
                        if(null !==(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING))){
    $method=filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    if($method=='edit'){
                        $sql="select * from se_list_order where order_id='$order_id'";
                        $mydata->db_m($sql);
                        $edit=$mydata->select();
                        }}                        
                        $amount=filter_input(INPUT_GET, 'amount', FILTER_SANITIZE_NUMBER_INT);
                        $I=0;
                        for($c=1;$c<=  $amount;$c++){?>
                        <div class="col-lg-12">
                            <div class="col-lg-1 col-xs-1" align="right">
                                <h4><?= $c?>.</h4>
                            </div>
                            <div class="col-lg-3 col-xs-12">
                                <div class="form-group">
                            <label>ชนิดวัสดุ &nbsp;</label>
<!--<select name="mate_id[]" id="mate_id[]" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">-->
    <select name="mate_id[]" id="mate_id[]" required  class="form-control select2" style="width: 100%;">
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
                <input value="<?php if(isset($method)){ echo $edit[$I]['amount'];}?>" type="text" class="form-control" name="amount[]" id="amount[]" placeholder="จำนวนวัสดุที่รับเข้า" onkeydown="return nextbox(event, 'min')">
                            </div>  
                        </div>
                  <input type="hidden" name="lo_id[]" id="lo_id[]" value="<?=$edit[$I]['lo_id']?>">      
                      <?php  $I++;}?>
                    </div>                   
                </div>
              </div>
              <?php if(isset($method)){
    if($method=='edit'){?>
    <input type="hidden" name="method" id="method" value="edit_list_order">
    <input type="hidden" name="id" id="id" value="<?=$order_id?>">
   <input class="btn btn-warning" type="submit" name="submit" id="Submit" value="แก้ไข">
    <?php }}else{?> 
              <input type="hidden" name="method" id="method" value="add_list_withdrawal">
              <input type="hidden" name="id" id="id" value="<?= $po_id?>">
              <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
    <?php }?>
          </div>            
    </div>
</form>