<?php session_start(); 
require 'class/table_create.php';?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบพัสดุโรงพยาบาล</title>
    <LINK REL="SHORTCUT ICON" HREF="<?=$resultHos[0]['url']?>/hrd/images/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <!--<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="plugins/excellentexport.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
		function popup(url,name,windowWidth,windowHeight){    
				myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
				mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
				properties = "width="+windowWidth+",height="+windowHeight;
				properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
				window.open(url,name,properties);
	}
</script>

  </head>
  <body class="hold-transition skin-red-light fixed sidebar-collapse sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>UPPLY</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SUPPLY-</b>System v.1.0</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if(empty($_SESSION['user_s'])){?>
                <li class="dropdown messages-menu">
                    
                        <a href="#" onClick="return popup('login_page.php', popup, 300, 330);" title="เข้าสู่ระบบพัสดุ">
                            <img src="images/key-y.ico" width="18"> เข้าสู่ระบบ
                  </a>
                   
                </li>
                <?php }else{
                    
                    $myconn=new Db_mng();
                    $myconn->read="connection/conn_DB.txt";
                    $myconn->config();
                    $db=$myconn->conn_mysqli();
                    
                    if(!$db){
     die ('Connect Failed! :'.mysqli_connect_error ());
     exit;
}
                                    $user_id = $_SESSION['user_s'];
                                    if (!empty($user_id)) {
                                        
                                        $sql = "select em.photo,po.posname ,d1.depName from emppersonal em 
                                                        INNER JOIN posid po on em.posid=po.posId
                                                        INNER JOIN department d1 on em.depid=d1.depId
                                                        WHERE empno='$user_id'";
                                      $myconn->db_m($sql);
                                      $result=$myconn->select();
                                      //$myconn->close_mysqli();
                                      
                                      $empno_photo=$result[0]['photo'];
                                      $posname=$result[0]['posname'];
                                      $depname=$result[0]['depName'];
                                      
                                        if (empty($empno_photo)) {
                                    $photo = 'person.png';
                                    $fold = $resultHos[0]['url']."/hrd/images/";
                                    //$fold = "images/";
                                } else {
                                    $photo = $empno_photo;
                                    $fold = $resultHos[0]['url']."/hrd/photo/";
                                    //$fold = "photo/";
                                }
                                        //$db->close();
                                    }
                                    
                    ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $fold.$photo?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $_SESSION['fullname_s']?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $fold.$photo?>" class="img-circle" alt="User Image">
                    <p>
                      <?= $posname?>
                      <small><?= $depname?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <?php if($_SESSION['Status_s']=='ADMIN' or ($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5')){?>
                    <div class="pull-left">
                        <a href="index.php?page=content/add_User&ss_id=<?= $_SESSION['user_s']?>" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                      </div><?php }?>
                    <div class="pull-right">
                        <a href="index.php?page=process/logout" class="btn btn-default btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <?php if(!empty($_SESSION['Status_s'])){
          if($_SESSION['Status_s']=='ADMIN'){?>
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
              <?php }}}?>
            </ul>
          </div>
        </nav>
      </header>
        <?php                
                //require 'class/db_mng.php';
                $myread=new Db_mng();
                $myread->read="connection/conn_DB.txt";
                $reader=$myread->config();
                $db=$myread->conn_mysqli();
                //print_r($db);
    if($db){
//===ชื่อโรงพยาบาล
            
                    $sql = "select * from  hospital order by hospital limit 1";
                    $myread->db_m($sql);
                    $resultHos=$myread->select();
                    $myread->close_mysqli();
     }                     
                    if (!empty($resultHos[0]['logo'])) {
                                    $pic = $resultHos[0]['logo'];
                                    $fol = $resultHos[0]['url']."/hrd/logo/";
                                    //$fol = "logo/";
                                } else {
                                    $pic = 'agency.ico';
                                    $fol = $resultHos[0]['url']."/hrd/images/";
                                    //$fol = "images/";
                                }
                    
                                //$db->close();
                    ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $fol.$pic?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?= $resultHos[0]['name2']?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> ระบบพัสดุ</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>
            <li class=""><a href="index.php">
                    <img src="images/gohome.ico" width="20"> <span>หน้าหลัก</span></a>
            </li>
            <?php if(isset($_SESSION['user_s'])){ ?>
            <li class="treeview">
              <a href="#">
                  <img src="images/icon_set1/load_upload.ico" width="20">
                <span>ระบบการเบิกวัสดุ</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                  <a href="#"><i class="fa fa-circle-o text-orange"></i> การเบิกวัสดุ <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                <li><a href="index.php?page=content/add_withdrawal_order"><i class="fa fa-circle-o text-red"></i> เบิกวัสดุ</a></li>
                <?php if($_SESSION['Status_s']=='ADMIN' or ($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5')){?>
                <li><a href="index.php?page=content/add_pay_order"><i class="fa fa-circle-o text-red"></i> จ่ายวัสดุ</a></li>
                </ul>
                </li>
                <?php }?>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-orange"></i> การยืมวัสดุ <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="index.php?page=content/add_borrow_order"><i class="fa fa-circle-o text-yellow"></i> ยืมวัสดุ</a></li>
                    <?php if($_SESSION['Status_s']=='ADMIN' or ($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5')){?>
                    <li><a href="index.php?page=content/add_pay_borrow"><i class="fa fa-circle-o text-yellow"></i> จ่ายวัสดุ</a></li>
                    <?php }?>
                    </ul>
                </li>
                <?php if($_SESSION['Status_s']=='ADMIN' or ($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5')){?>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-orange"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="index.php?page=content/add_pay_order&method=report"><i class="fa fa-circle-o text-yellow"></i> รายการขอเบิก-จ่าย</a></li>
                    <li><a href="index.php?page=content/add_pay_borrow&method=report"><i class="fa fa-circle-o text-yellow"></i> รายการขอยืม-จ่าย</a></li>
                  </ul>
                </li>
                <?php }?>
              </ul>
            </li>
             <?php if($_SESSION['Status_s']=='ADMIN' or ($_SESSION['Status_s']=='SUSER' and $_SESSION['process_s']=='5')){?>
                        <li class="treeview">
              <a href="#">
                  <img src="images/icon_set1/load_download.ico" width="20">
                <span>ระบบรับเข้าวัสดุ</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" onClick="return popup('content/add_reference.php', popup, 300, 330);" title="เข้าสู่ระบบพัสดุ"><i class="fa fa-circle-o text-green"></i> บันทึกเลข พจล.</a></li>  
                <li><a href="index.php?page=content/add_import_order"><i class="fa fa-circle-o text-green"></i> นำเข้าวัสดุ</a></li>
                <!--<li>
                  <a href="#"><i class="fa fa-circle-o text-blue"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="index.php?page=personal/statistics_person"><i class="fa fa-circle-o text-aqua"></i> สถิติบุคลากร</a></li>
                    <li><a href="#" onClick="window.open('personal/detial_type.php','','width=400,height=350'); return false;" title="สถิติประเภทพนักงาน"><i class="fa fa-circle-o text-aqua"></i> สถิติประเภทพนักงาน</a></li>
                    <li><a href="#" onClick="window.open('personal/detial_position.php','','width=600,height=680'); return false;" title="สถิติตำแหน่งพนักงาน"><i class="fa fa-circle-o text-aqua"></i> สถิติตำแหน่งพนักงาน</a></li>
                    </ul>
            </li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                  <img src="images/icon_set1/disc.ico" width="20">
                <span>ข้อมูลต่างๆ</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="index.php?page=content/add_company"><i class="fa fa-circle-o text-maroon"></i> ข้อมูลร้านค้า</a></li>
                <li><a href="index.php?page=content/add_mate_type"><i class="fa fa-circle-o text-maroon"></i> ข้อมูลประเภทวัสดุ</a></li>
                <li><a href="index.php?page=content/add_material"><i class="fa fa-circle-o text-maroon"></i> ข้อมูลวัสดุ</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-fuchsia"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o text-fuchsia"></i> #</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php }}?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <?php/*
                    function insert_date(&$take_date_conv,&$take_date)
                    {
                        $take_date=explode("/",$take_date_conv);
			 $take_date_year=$take_date[2]-543;
			 $take_date="$take_date_year-$take_date[1]-$take_date[0]";
                    }*/
?>