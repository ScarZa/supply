<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='35'> ตารางใบขอเบิกวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                            <?php
$sql="SELECT po.or_no,CONCAT(e.firstname,' ',lastname) as fullname,po.or_date,d.depName,po.or_status,po.po_id,po.po_id from se_pay_order po
        inner join emppersonal e ON e.empno=po.empno
	INNER JOIN department d ON d.depId=po.dep_id
        where d.depId='".$_SESSION['dep_s']."'
        order by po.po_id desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("เลขที่ทะเบียนเอกสาร","ชื่อผู้ขอเบิก","วันที่บันทึก","หน่วยงาน","สถานะการเบิก","รายละเอียด","พิมพ์");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
$mydata=new Table($column);
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $process="withdrawal_order";
    $mydata->create_TB_PDF($process);
    $mydata->close_mysqli();
    ?>
                </div>
              </div>
          </div>
</div>
