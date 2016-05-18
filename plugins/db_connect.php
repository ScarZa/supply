<?php
// ฟังก์ชันสำหรับเชื่อมต่อกับฐานข้อมูล
function connect()
{
  // เริ่มต้นส่วนกำหนดการเชิ่อมต่อฐานข้อมูล //  
	 $db_config=array(
		"host"=>"localhost",  // กำหนด host
		"user"=>"root", // กำหนดชื่อ user
		"pass"=>"test",   // กำหนดรหัสผ่าน
		"dbname"=>"test",  // กำหนดชื่อฐานข้อมูล
		"charset"=>"utf8"  // กำหนด charset
	);
  // สิ้นสุุดส่วนกำหนดการเชิ่อมต่อฐานข้อมูล // 	
	$mysqli = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);
	if(mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		exit;
	}
	if(!$mysqli->set_charset($db_config["charset"])) { // เปลี่ยน charset เป้น utf8 พร้อมตรวจสอบการเปลี่ยน
	//    printf("Error loading character set utf8: %sn", $mysqli->error);  // ถ้าเปลี่ยนไม่ได้
	}else{
	//    printf("Current character set: %sn", $mysqli->character_set_name()); // ถ้าเปลี่ยนได้
	}
	return $mysqli;
	//echo $mysqli->character_set_name();  // แสดง charset เอา comment ออก
	//echo 'Success... ' . $mysqli->host_info . "n";
	//$mysqli->close();  
}
//	  ฟังก์ชันสำหรับคิวรี่คำสั่ง sql
function query($sql)
{
	global $mysqli;
	if($mysqli->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชัน select ข้อมูลในฐานข้อมูลมาแสดง
function select($sql)
{
	global $mysqli;	
	$result=array();
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	while($data= $res->fetch_assoc()) {
		$result[]=$data;
	}
	return $result;	
}
//    ฟังก์ชันสำหรับการ insert ข้อมูล
function insert($table,$data)
{
	global $mysqli;		
	$fields=""; $values="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1) { $fields.=", "; $values.=", "; }
		$fields.="$key";
		$values.="'$val'";
		$i++;
	}
	$sql = "INSERT INTO $table ($fields) VALUES ($values)";
	if($mysqli->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับการ update ข้อมูล
function update($table,$data,$where)
{
	global $mysqli;			
	$modifs="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1){ $modifs.=", "; }
		if(is_numeric($val)) { $modifs.=$key.'='.$val; }
		else { $modifs.=$key.' = "'.$val.'"'; }
		$i++;
	}
	$sql = ("UPDATE $table SET $modifs WHERE $where");
	if($mysqli->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับการ delete ข้อมูล
function delete($table, $where)
{
	global $mysqli;			
	$sql = "DELETE FROM $table WHERE $where";
	if($mysqli->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$mysqli->error); return false; }
}
//    ฟังก์ชันสำหรับแสดงรายการฟิลด์ในตาราง
function listfield($table)
{
	global $mysqli;			
	$sql="SELECT * FROM $table LIMIT 1 ";
	$row_title="\$data=array(<br/>";
	$res = $mysqli->query($sql) or die("SQL Error: <br>".$sql."<br>".$mysqli->error);
	$i=1;
	while($data= $res->fetch_field()) {
		$var=$data->name;
		$row_title.="\"$var\"=>\"value$i\",<br/>";
		$i++;
	}	
	$row_title.=");<br/>";
	echo $row_title;
}
?>