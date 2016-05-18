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
require '../class/db_mng.php';
 $mydata=new Db_mng();
                $mydata->read="../connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
    if(null !==(filter_input(INPUT_POST, 'method'))){
        $method=filter_input(INPUT_POST, 'method');
        
        if($method=='add_ref'){
            $data=array($_POST['reference']);
            $table="se_reference";
            $check_ref=$mydata->insert($table, $data);
            $mydata->close_mysqli();
        } 
        if(!$check_ref){
        echo "<script>alert('การบันทึกไม่สำเร็จ!!!')</script>";
    echo "<meta http-equiv='refresh' content='0;url=../content/add_reference.php'>";
    exit();
    }else{}
    }?>
        </section>
