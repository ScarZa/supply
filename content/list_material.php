<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/dolly.ico' width='25'> ตารางวัสดุ</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

 
                        <!--<table id="example1" class="table table-bordered table-striped">
                            <thead>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="5%">ลำดับ</th>
                                <th align="center" width="16%">ชื่อวัสดุ</th>
                                <th align="center" width="10%">ประเภทวัสดุ</th>
                                <th align="center" width="25%">หน่วยนับ</th>
                                <th align="center" width="10%">จำนวนต่ำสุด</th>
                                <th align="center" width="10%">จำนวนสูงสุด</th>
                                <th align="center" width="7%">แก้ไข</th>
                                <th align="center" width="7%">ลบ</th>
                            </tr>
                       </thead>
                       <tbody>-->
                            <?php
$sql="SELECT m.mate_name,mt.type_name,m.mate_unit,m.min,m.max,m.mate_id,m.mate_id,m.mate_id FROM se_material m inner join se_material_type mt on mt.mate_type_id=m.mate_type_id ORDER BY m.mate_type_id ";
//หากเป็น TB_mng ต้องเพิ่ม id ต่อทาย 2 id เข้าไปด้วย 
$column=array("ชื่อวัสดุ","ประเภทวัสดุ","หน่วยนับ","จำนวนต่ำสุด","จำนวนสูงสุด","รายละเอียด","แก้ไข","ลบ");//หากเป็น TB_mng ต้องเพิ่ม แก้ไข,ลบเข้าไปด้วย 
$mydata=new Table($column);
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
                $mydata->db_m($sql);
    
    $result=$mydata->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    $mydata->create_TB_mng('material');//ใส่ process ที่ต้องการสร้าง
    $mydata->close_mysqli();
    
    /*$c=1;
    for($i=0;$i<count($result);$i++){
?>
    <tr>
                                <td align="center"><?=$c?></td>
                                <td><a href="#" onClick="window.open('content/detial_material.php?id=<?=$result[$i]['mate_id']?>','','width=450,height=300'); return false;" title="Code PHP Popup"><?=$result[$i]['mate_name'];?></a></td>
                                <td><a href="#" onClick="window.open('content/detial_material.php?id=<?=$result[$i]['mate_id']?>','','width=450,height=300'); return false;" title="Code PHP Popup"><?=$result[$i]['type_name']?></a></td>
                                <td align="center"><?=$result[$i]['mate_unit'];?></td>
                                <td align="center"><?=$result[$i]['min'];?></td>
                                <td align="center"><?=$result[$i]['max'];?></td>
                                <td align="center"><a href="index.php?page=content/add_material&method=edit&id=<?=$result[$i]['mate_id'];?>"><img src='images/file_edit.ico' width='25'></a></td>
                                <td align="center"><a href='index.php?page=process/prc_data&method=delete_material&del_id=<?=$result[$i]['mate_id'];?>' onClick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><img src='images/file_delete.ico' width='25'></a></td>
        </tr>
    <?php $c++;} */?>
                        <!-- </tbody>
                         <tfoot>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="5%">ลำดับ</th>
                                <th align="center" width="16%">ชื่อวัสดุ</th>
                                <th align="center" width="10%">ประเภทวัสดุ</th>
                                <th align="center" width="25%">หน่วยนับ</th>
                                <th align="center" width="10%">จำนวนต่ำสุด</th>
                                <th align="center" width="10%">จำนวนสูงสุด</th>
                                <th align="center" width="7%">แก้ไข</th>
                                <th align="center" width="7%">ลบ</th>
                      </tr>
                    </tfoot>
                        </table>-->
                </div>
              </div>
          </div>
</div>
