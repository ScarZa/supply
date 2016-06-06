<?php
$check=  md5(trim('check'));
if($_REQUEST['method']!=$check){
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Date Picker -->
    <!--<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="plugins/excellentexport.js"></script>
</head>
<body>
    <form role="form" action='process/prcconn_db.php' enctype="multipart/form-data" method='post'>
          <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><img src='images/phonebook.ico' width='25'> ตั้งค่าเพื่อ Connect Database</h3>
                    </div>
                  <div class="panel-body">
                      <div class="form-group"> 
                <label>HOST Name &nbsp;</label>
                <input type="text" class="form-control" name="host_name" id="host_name" placeholder="host name" required>
             	</div>
                      <div class="form-group"> 
                <label>Username &nbsp;</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" required>
             	</div>
                      <div class="form-group"> 
                <label>Password &nbsp;</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password">
             	</div>
                      <div class="form-group"> 
                <label>Database name &nbsp;</label>
                <input type="text" class="form-control" name="db_name" id="db_name" placeholder="database name" required>
                      </div>
                      <div class="form-group"> 
                <label>Port &nbsp;</label>
                <input type="text" class="form-control" name="port" id="port" placeholder="MySql Port" required>
                      </div>
                    <div class="form-group"> 
                        <center>
                        <input type="submit" class="btn btn-success" name="submit" value="ตกลง">
                        </center>
                    </div>
                  </div>
              </div>
          </div>
    </form>
</body>
</html>
