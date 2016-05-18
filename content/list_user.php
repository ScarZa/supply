<?php
     $sql="SELECT CONCAT(e1.firstname,' ',e1.lastname) AS fullname,d1.dep_name AS Mdep,d2.depName AS dep,
ssm.ss_Status AS status, ssm.ss_user_name,e1.empno as empno, ssm.ss_UserID as ID , ssm.ss_process
FROM ss_member ssm
INNER JOIN emppersonal e1 ON ssm.ss_Name=e1.empno
INNER JOIN department d2 ON d2.depId=e1.depid
INNER JOIN department_group d1 ON d1.main_dep=d2.main_dep 
where ssm.ss_process='0' or ssm.ss_process='5'
order by fullname "; 
$mydata2=new Db_mng();
                $mydata2->read="connection/conn_DB.txt";
                $mydata2->config();
                $mydata2->conn_mysqli();
                $mydata2->db_m($sql);
        $result=$mydata2->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        $mydata2->close_mysqli();
     ?>

<table id="example1" class="table table-bordered table-striped">
                            <thead> <TR bgcolor='#898888'>
					<th width='5%'><CENTER><p>ลำดับ</p></CENTER></th>
					<th width='15%'><CENTER>ชื่อ - นามสกุล</CENTER></th>
					<th width='15%'><CENTER>ฝ่าย</CENTER></th>
					<th width='15%'><CENTER>ศูนย์/กลุ่มงาน</CENTER></th>
					<th width='15%'><CENTER>ระดับการใช้งาน</CENTER></th>
                                        <th width='15%'><CENTER>ระดับการดูแลระบบ</CENTER></th>
					<th width='10%'><CENTER>ชื่อที่ใช้งาน</CENTER></th>
					<th width='5%'><CENTER>แก้ไข</CENTER></th>
                                        <th width='5%'><CENTER>ลบ</CENTER></th>
 </TR>
  </thead>
                       <tbody>
<?php $I=1;
for($i=0;$i<count($result);$i++){?>  
 					<tr >	    
				    <TD height="20" align="center" ><?= $I?></TD>
					<TD><?=$result[$i]['fullname']; ?></TD>
                                        <TD align="center"><?=$result[$i]['Mdep']; ?></TD>
					<TD align="center"><?=$result[$i]['dep']; ?></TD>
					<TD align="center"><?php if($result[$i]['status']=='ADMIN'){echo 'ผู้ดูแลระบบ'; }
                                        elseif($result[$i]['status']=='SUSER' or $result[$i]['status']=='NUSER'){echo 'ผู้ดูแลระบบย่อย';}
                                        //else{echo 'หัวหน้าฝ่าย';}?></TD>
                                        <TD align="center"><?php if($result[$i]['ss_process']=='0'){echo 'ผู้ดูแลระบบทั้งหมด'; }
                                        elseif($result[$i]['ss_process']=='2'){echo 'ผู้ดูแลระบบห้องประชุม';}
                                        elseif($result[$i]['ss_process']=='3'){echo 'ผู้ดูแลระบบรถยนต์';}
                                        elseif($result[$i]['ss_process']=='4'){echo 'ผู้ดูแลระบบข้อมูลพยาบาล';}
                                        elseif($result[$i]['ss_process']=='5'){echo 'ผู้ดูแลระบบพัสดุ';}?>
                                        </TD>
					<TD align="center"><?=$result[$i]['ss_user_name']; ?></TD>
 					<TD align="center">
				    <a href='index.php?page=content/add_User&method=update&ss_id=<?=$result[$i]['empno']?>&status=<?=$result[$i]['status']?>&ID=<?= $result[$i]['ID']?>' >
                                        <img src="images/icon_set1/document_edit.ico" width="25"></a> 
                                        </td>
                                        <td align="center">
					<a href='index.php?page=process/prcuser&method=delete&ss_id=<?=$result[$i]['empno']?>&ID=<?= $result[$i]['ID']?>'  title="confirm" onclick="if(confirm('ยืนยันการลบ <?= $result[$i]['fullname']?>&nbsp;ออกจากรายการ ')) return true; else return false;">   
					<img src="images/icon_set1/document_delete.ico" width="25"></a>
                                        </td>
					</tr> 
 
  			 
 		 <?php $I++; } ?>
 		 
</tbody>
                         <tfoot>
                      <tr align="center" bgcolor="#898888">
                                <th width='5%'><CENTER><p>ลำดับ</p></CENTER></th>
					<th width='15%'><CENTER>ชื่อ - นามสกุล</CENTER></th>
					<th width='15%'><CENTER>ฝ่าย</CENTER></th>
					<th width='15%'><CENTER>ศูนย์/กลุ่มงาน</CENTER></th>
					<th width='15%'><CENTER>ระดับการใช้งาน</CENTER></th>
                                        <th width='15%'><CENTER>ระดับการดูแลระบบ</CENTER></th>
					<th width='10%'><CENTER>ชื่อที่ใช้งาน</CENTER></th>
					<th width='5%'><CENTER>แก้ไข</CENTER></th>
                                        <th width='5%'><CENTER>ลบ</CENTER></th>
                      </tr>
                    </tfoot>
</table>

