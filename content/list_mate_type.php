<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/contacts.ico' width='25'> ตารางประเภทวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

 
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="10%">ลำดับ</th>
                                <th align="center" width="50%">ชื่อประเภทวัสดุ</th>
                                <th align="center" width="20%">แก้ไข</th>
                                <th align="center" width="20%">ลบ</th>
                            </tr>
                       </thead>
                       <tbody>
                            <?php
$sql="SELECT * FROM se_material_type ORDER BY mate_type_id ";
$mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $mydata->close_mysqli();
    $c=1;
    for($i=0;$i<count($result);$i++){
?>
    <tr>
                                <td align="center"><?=$c?></td>
                                <td align="center"><?=$result[$i]['type_name'];?></td>
                                <td align="center"><a href="index.php?page=content/add_mate_type&method=edit&id=<?=$result[$i]['mate_type_id'];?>"><img src='images/icon_set1/document_edit.ico' width='25'></a></td>
                                <td align="center"><a href='index.php?page=process/prc_data&method=delete_mate_type&del_id=<?=$result[$i]['mate_type_id'];?>' onClick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><img src='images/icon_set1/document_delete.ico' width='25'></a></td>
        </tr>
    <?php $c++;} ?>
                         </tbody>
                         <tfoot>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="10%">ลำดับ</th>
                                <th align="center" width="50%">ชื่อประเภทวัสดุ</th>
                                <th align="center" width="20%">แก้ไข</th>
                                <th align="center" width="20%">ลบ</th>
                      </tr>
                    </tfoot>
                        </table>
                </div>
              </div>
          </div>
</div>
