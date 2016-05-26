<?php @session_start(); 
if (empty($_SESSION['user_s'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'/>";
    exit();
}
?>
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
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  </head>

    <?php
    $po_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
/*if ($_SESSION['Status']=='USER') {
    $empno = $_SESSION['user_s'];
}   */ 
require '../class/db_mng.php';
$myconn=new Db_mng();
$myconn->read="../connection/conn_DB.txt";
$myconn->config();
$db=$myconn->conn_mysqli();
    $sql = "SELECT po.or_no,CONCAT(e.firstname,' ',e.lastname) as fullname,d.depName,po.or_date,
po.or_status,m.mate_name,wd.amount,m.mate_unit,po.po_id
FROM se_pay_order po
INNER JOIN se_withdrawal wd ON wd.po_id=po.po_id
INNER JOIN emppersonal e ON e.empno=po.empno
INNER JOIN department d ON d.depId=po.dep_id
INNER JOIN se_material m ON m.mate_id=wd.mate_id
WHERE po.po_id='$po_id'
ORDER BY wd.wd_id ASC";
    $myconn->db_m($sql);
    $result=$myconn->select();
    $myconn->close_mysqli();
   include_once ('../plugins/funcDateThai.php');
    ?>
    <!--<div class="row">
              <div class="col-lg-12">
                <h1><font color='blue'>  รายละเอียดข้อมูลบุคลากร </font></h1> 
                <ol class="breadcrumb alert-success">
                  <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
                  <li class="active"><a href="pre_person.php"><i class="fa fa-edit"></i> ข้อมูลพื้นฐาน</a></li>
                  <li class="active"><i class="fa fa-edit"></i> รายละเอียดข้อมูลบุคลากร</li>
                </ol>
              </div>
          </div>-->
    <body class="hold-transition skin-green fixed sidebar-mini">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">ข้อมูลวัสดุ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12">
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"><img src='../images/icon_set2/dolly.ico' width='25'> ข้อมูลทั่วไป</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="3">เลขที่ทะเบียนเอกสาร :&nbsp;<b><?= $result[0]['or_no']?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">วันที่ขอเบิก :&nbsp;<b><?= DateThai2($result[0]['or_date'])?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">ผู้ขอเบิก :&nbsp;<b><?= $result[0]['fullname']?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">หน่วยงาน :&nbsp;<b><?= $result[0]['depName']?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">สถานะการเบิก :&nbsp;<b><?php if($result[0]['or_status']=='Y'){
                                        echo 'จ่ายแล้ว';}  else {echo 'ยังไม่จ่าย';} ?></b></td>
                                    </tr>
                                    <?php $c=1; for($i=0;$i<count($result);$i++){ ?>
                                    <tr>
                                        <td><b><?= $c?>.</b></td>
                                        <td><b><?= $result[$i]['mate_name']?></b></td>
                                        <td>จำนวน <b><?= $result[$i]['amount']?></b> <?= $result[$i]['mate_unit']?></td>
                                    </tr>
                                    <?php $c++; }?>
                                </table>
                    
                            </div>
                        </div>
                            <?php if($result[0]['or_status']=='N' and empty($_GET['method'])){?>
                            <form name='form1' class="navbar-form navbar-left"  action='detial_withdrawal_order.php' method='get' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
                                <div class="input-group input-group">
                                    <input type="text" class="form-control" name="amount" placeholder="จำนวนรายการที่ต้องการเพิ่ม" size="1" required="">
                                <input type="hidden" name="id" value="<?= $po_id?>">
                                <input type="hidden" name="method" value="1">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">เพิ่มรายการ</button>
                    </span>
                  </div>
                            </form>
                                <?php }
                                if($result[0]['or_status']=='N' and !empty($_GET['method'])){?>
                            <form class="" role="form" action='../process/prc_data.php' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
                        <?php     $amount=filter_input(INPUT_GET, 'amount', FILTER_SANITIZE_NUMBER_INT);
                                  echo "<table border='0' width='100%'> "; 
                                  $I=0;
                                  for($i=1;$i<=$amount;$i++){?>
                            <tr>                             
                            <td width="10%"><h4><?= $i?>.</h4></td>
                                
                           
                            <td width="50%">    <div class="form-group">
                            <label>ชนิดวัสดุ &nbsp;</label>
<!--<select name="mate_id[]" id="mate_id[]" required  class="form-control"  onkeydown="return nextbox(event, 'mate_name');">-->
    <select name="mate_id[]" id="mate_id[]" required  class="form-control" data-placeholder="Select a State" style="width: 100%;">
    <option value="">เลือกวัสดุ</option> 
        <?php
        $sql="select * from se_material";
        $mydata1=new Db_mng();
                $mydata1->read="../connection/conn_DB.txt";
                $mydata1->config();
                $mydata1->conn_mysqli();
                $mydata1->db_m($sql);
        $result=$mydata1->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        //$mydata1->close_mysqli();
        for($c=0;$c<count($result);$c++){
        echo "<option value='".$result[$c]['mate_id']."'>".$result[$c]['mate_name'] ."</option>";
        
    }
        ?>
            
    </select> </div></td>
    <td> &nbsp; </td>
    <td width="30%"><div class="form-group">
                <label>จำนวน &nbsp;</label>
                <input type="text" class="form-control" name="amount[]" id="amount[]" placeholder="จำนวนวัสดุที่รับเข้า">
        </div>  </td>
                      <?php  $I++; } ?>
                  </table>
                  <center>
                    <input type="hidden" name="method" id="method" value="add_list_withdrawal">
                    <input type="hidden" name="check" id="check" value="plus">
                    <input type="hidden" name="id" id="id" value="<?= $po_id?>">
                    <input type="submit" class="btn btn-success" value="เพิ่ม">
                  </center>
                                <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="control-sidebar-bg"></div>
        <!-- jQuery 2.1.4 -->
     <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
  </body>
</html>
