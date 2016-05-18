<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ตารางวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                            <?php
$sql="SELECT r.reference_no,c.comp_name,o.order_date,o.order_amount,o.total_amount,o.order_id,o.order_id,o.order_id from se_order o
        left outer join se_reference r on r.ref_id=o.ref_id
        inner join se_company c on c.comp_id=o.comp_id
        order by o.order_date desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("ใบรายการ","ชื่อร้านค้า","วันที่ลงบันทึก","จำนวนเงิน","จำนวนรายการ","รายละเอียด","แก้ไข","ลบ");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
$mydata=new Table($column);
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $mydata->create_TB_mng('import_order');//ใส่ process ที่ต้องการสร้าง
    $mydata->close_mysqli();
    ?>
                </div>
              </div>
          </div>
</div>
