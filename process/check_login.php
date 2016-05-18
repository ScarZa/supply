<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบพัสดุโรงพยาบาล</title>
    <LINK REL="SHORTCUT ICON" HREF="images/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script language="JavaScript" type="text/javascript"> 
var StayAlive = 1; // เวลาเป็นวินาทีที่ต้องการให้ WIndows เปิดออก 
function KillMe()
{ 
setTimeout("self.close()",StayAlive * 1000); 
} 
</script>
  </head>
  <body class="hold-transition skin-green fixed sidebar-mini" onLoad="KillMe();self.focus();window.opener.location.reload();">
     <section class="content">
<?php
require '../connection/connect.php';
$user_account = md5(trim(filter_input(INPUT_POST, 'user_account',FILTER_SANITIZE_ENCODED)));
$user_pwd = md5(trim(filter_input(INPUT_POST, 'user_pwd',FILTER_SANITIZE_ENCODED)));
//include 'connection/connect.php';
// using PDO

echo	 "<p>&nbsp;</p>	"; 
echo	 "<p>&nbsp;</p>	";
echo "<div class='bs-example'>
	  <div class='progress progress-striped active'>
	  <div class='progress-bar' style='width: 100%'></div>
</div>";
echo "<div class='alert alert-dismissable alert-success'>
	  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	  <a class='alert-link' target='_blank' href='#'><center>กำลังดำเนินการ</center></a> 
</div>";
$sql="select CONCAT(e1.firstname,' ',e1.lastname) as fullname, ss.ss_Name as id, ss.ss_Status as Status, ss.ss_process as process, e1.depid as dep
from ss_member ss 
INNER JOIN emppersonal e1 on e1.empno=ss.ss_Name
where (ss.ss_process='0' or ss.ss_process='5') and (ss.ss_Username= :user_account && ss.ss_Password= :user_pwd)";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_account' => $user_account, ':user_pwd' => $user_pwd));
$result = $sth->fetch(PDO::FETCH_ASSOC);
$process=$result['process'];
if (empty($result)) {

$sql = "select m1.Name as id,concat(e1.firstname,' ',e1.lastname) as fullname,e1.depid as dep,m1.Status as Status from member m1 
           inner join emppersonal e1 on m1.Name=e1.empno
           inner join department d1 on e1.depid=d1.depId
           inner join posid p1 on e1.posid=p1.posId
           where m1.Username = :user_account AND m1.Password = :user_pwd";
$sth = $dbh->prepare($sql);
$sth->execute(array(':user_account' => $user_account, ':user_pwd' => $user_pwd));
$result = $sth->fetch(PDO::FETCH_ASSOC);
$status_usere='USER';
$process='0';
}
if ($result) {
    $_SESSION['user_s'] = $result['id'];
    $_SESSION['fullname_s'] = $result['fullname'];
    $_SESSION['dep_s'] = $result['dep'];
    //$_SESSION['main_dep'] = $result['main_dep'];
    $_SESSION['Status_s'] = $result['Status'];
    $_SESSION['process_s'] = $process;

    // require'myfunction/savelog.php';
    //	  echo "<input type='hidden' name='acc_id' value='$acc_username'> ";

    
}else{
	echo "<script>alert('ชื่อหรือรหัสผ่านผิด กรุณาตรวจสอบอีกครั้ง!')</script>";
    echo "<meta http-equiv='refresh' content='0;url=../login_page.php'>";
    exit();
}?>
        </section>
