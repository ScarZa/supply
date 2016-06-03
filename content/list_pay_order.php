<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ตารางจ่ายวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                            <?php
                            if(isset($_REQUEST['method'])=='report'){
$sql="SELECT po.or_no,CONCAT(e.firstname,' ',lastname) as fullname,po.or_date,d.depName,
CASE po.or_status
WHEN 'N' THEN 'ยังไม่จ่าย'
WHEN 'Y' THEN 'จ่ายแล้ว'
ELSE 'Unknown'
END AS status
,po.po_id from se_pay_order po
inner join emppersonal e ON e.empno=po.empno
INNER JOIN department d ON d.depId=po.dep_id
order by po.po_id desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("เลขที่ทะเบียนเอกสาร","ชื่อผู้ขอเบิก","วันที่บันทึก","หน่วยงาน","สถานะการเบิก","รายละเอียด");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
 $process="pay_order";                                
                            }else{
$sql="SELECT po.or_no,CONCAT(e.firstname,' ',lastname) as fullname,po.or_date,d.depName,
    CASE po.or_status
WHEN 'N' THEN 'ยังไม่จ่าย'
WHEN 'Y' THEN 'จ่ายแล้ว'
ELSE 'Unknown'
END AS status
    ,po.po_id,po.po_id,po.po_id from se_pay_order po
        inner join emppersonal e ON e.empno=po.empno
	INNER JOIN department d ON d.depId=po.dep_id
        where po.or_status='N'
        order by po.po_id desc";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("เลขที่ทะเบียนเอกสาร","ชื่อผู้ขอเบิก","วันที่บันทึก","หน่วยงาน","สถานะการเบิก","รายละเอียด","จ่ายวัสดุ","ลบ");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
 $process="pay_order";
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
