<div class="row">
          <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><img src='images/icon_set2/Store.ico' width='25'> ตารางร้านค้า</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

 
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="5%">ลำดับ</th>
                                <th align="center" width="16%">ชื่อร้าน</th>
                                <th align="center" width="10%">เลขที่เสียภาษี</th>
                                <th align="center" width="25%">ที่อยู่</th>
                                <th align="center" width="10%">โทรศัพท์</th>
                                <th align="center" width="10%">มือถือ</th>
                                <th align="center" width="10%">FAX</th>
                                <th align="center" width="7%">แก้ไข</th>
                                <th align="center" width="7%">ลบ</th>
                            </tr>
                       </thead>
                       <tbody>
                            <?php
$sql="SELECT * FROM se_company ORDER BY comp_id ";
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
                                <td><a href="#" onClick="window.open('content/detial_company.php?id=<?=$result[$i]['comp_id']?>','','width=450,height=300'); return false;" title="Code PHP Popup"><?=$result[$i]['comp_name'];?></a></td>
                                <td><a href="#" onClick="window.open('content/detial_company.php?id=<?=$result[$i]['comp_id']?>','','width=450,height=300'); return false;" title="Code PHP Popup"><?=$result[$i]['comp_vax']?></a></td>
                                <td align="center"><?=$result[$i]['comp_address'];?></td>
                                <td align="center"><?=$result[$i]['comp_tell'];?></td>
                                <td align="center"><?=$result[$i]['comp_mobile'];?></td>
                                <td align="center"><?=$result[$i]['comp_fax'];?></td>
                                <td align="center"><a href="index.php?page=content/add_company&method=edit&id=<?=$result[$i]['comp_id'];?>"><img src='images/icon_set1/document_edit.ico' width='25'></a></td>
                                <td align="center"><a href='index.php?page=process/prc_data&method=delete_comp&del_id=<?=$result[$i]['comp_id'];?>' onClick="return confirm('กรุณายืนยันการลบอีกครั้ง !!!')"><img src='images/icon_set1/document_delete.ico' width='25'></a></td>
        </tr>
    <?php $c++;} ?>
                         </tbody>
                         <tfoot>
                      <tr align="center" bgcolor="#898888">
                                <th align="center" width="5%">ลำดับ</th>
                                <th align="center" width="16%">ชื่อร้าน</th>
                                <th align="center" width="10%">เลขที่เสียภาษี</th>
                                <th align="center" width="25%">ที่อยู่</th>
                                <th align="center" width="10%">โทรศัพท์</th>
                                <th align="center" width="10%">มือถือ</th>
                                <th align="center" width="10%">FAX</th>
                                <th align="center" width="7%">แก้ไข</th>
                                <th align="center" width="7%">ลบ</th>
                      </tr>
                    </tfoot>
                        </table>
                </div>
              </div>
          </div>
</div>
