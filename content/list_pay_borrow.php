<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ตารางจ่ายวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                            <?php
                            if(isset($_REQUEST['method'])=='report'){
$sql="SELECT bo.bo_no,CONCAT(e.firstname,' ',lastname) as fullname,bo.bo_date,d.depName,bo.bo_status,bo.bo_id from se_borrow_order bo
        inner join emppersonal e ON e.empno=bo.empno
	INNER JOIN department d ON d.depId=bo.dep_id
        order by bo.bo_id desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("เลขที่ทะเบียนยืม","ชื่อผู้ขอยืม","วันที่บันทึก","หน่วยงาน","สถานะการยืม","รายละเอียด");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
 $process="pay_borrow";                                
                            }else{
$sql="SELECT bo.bo_no,CONCAT(e.firstname,' ',lastname) as fullname,bo.bo_date,d.depName,bo.bo_status,bo.bo_id,bo.bo_id,bo.bo_id from se_borrow_order bo
        inner join emppersonal e ON e.empno=bo.empno
	INNER JOIN department d ON d.depId=bo.dep_id
        where bo.bo_status='N'
        order by bo.bo_id desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("เลขที่ทะเบียนยืม","ชื่อผู้ขอยืม","วันที่บันทึก","หน่วยงาน","สถานะการยืม","รายละเอียด","จ่ายวัสดุ","ลบ");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
 $process="pay_borrow";
                            }
$mydata=new Table($column);
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
if(isset($_REQUEST['method'])=='report'){
    $mydata->create_TB_Detial($process);  
}  else {
    $mydata->create_TB_mng($process);   
}   
    $mydata->close_mysqli();
    ?>
                </div>
              </div>
          </div>
</div>
