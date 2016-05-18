<section class="content-header">
              <?php if(isset($_REQUEST['method'])){
              if($_REQUEST['method']=='edit'){?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  แก้ไขรายการนำเข้า </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=content/add_import_order"><i class="fa fa-edit"></i> ข้อมูลนำเข้า</a></li>
              <li class="active"><i class="fa fa-edit"></i> แก้ไขข้อมูลนำเข้า</li>
              <?php }}else{?>
            <h1><img src='images/icon_set2/dolly.ico' width='40'><font color='blue'>  เพิ่มข้อมูลนำเข้า </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เพิ่มข้อมูลนำเข้า</li>
              <?php }?>
            </ol>
        </section>
    <section class="content">
<?php
        $order_id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql="select r.reference_no,c.comp_name,o.order_date,m.mon_name,o.total_amount,o.order_amount from se_order o
            inner join se_reference r on r.ref_id=o.ref_id
            inner join se_company c on c.comp_id=o.comp_id
            inner join se_money_type m on m.mon_id=o.order_method
            where o.order_id='$order_id'";
        $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $detial_order=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    
    include 'plugins/funcDateThai.php';
    ?><table border="0">
        <tr>
            <td>เลขที่ พจล. :</td>
            <td> <?= $detial_order[0]['reference_no']?></td>
        </tr>
        <tr>
            <td>ชื่อร้าน :</td>
            <td> <?= $detial_order[0]['comp_name']?></td>
        </tr>
        <tr>
            <td>วันที่บันทึก :</td>
            <td> <?= DateThai2($detial_order[0]['order_date'])?></td>
        </tr>
        <tr>
            <td>ซื้อมาโดยวิธี :</td>
            <td> <?= $detial_order[0]['mon_name']?></td>
        </tr>
        <tr>
            <td>จำนวน :</td>
            <td> <?= $detial_order[0]['total_amount']?></td>
        </tr>
        <tr>
            <td>รวมราคา :</td>
            <td> <?= $detial_order[0]['order_amount']?></td>
        </tr>
    </table>
    <br>
<form class="" role="form" action='index.php?page=process/prc_data' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
    <div class="row">
          <div class="col-lg-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ข้อมูลรายการนำเข้า</h3>
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
                <label>ราคา/หน่วย &nbsp;</label>
                <input value="<?php if(isset($method)){ echo $edit[$I]['price'];}?>" type="text" class="form-control" name="price[]" id="price[]" placeholder="ราคาต่อ 1 หน่วย" onkeydown="return nextbox(event, 'min')">
             	</div>      
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
              <input type="hidden" name="method" id="method" value="add_list_order">
              <input type="hidden" name="id" id="id" value="<?= $order_id?>">
              <input class="btn btn-success" type="submit" name="submit" id="Submit" value="บันทึก">
    <?php }?>
          </div>            
    </div>
</form>