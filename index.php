<?php require 'header.php';?>
<!-- Content Header (Page header) -->
    <?php
    if(isset($_SESSION['user_s'])){
        if(NULL !==(filter_input(INPUT_GET,'page'))){
       $page=filter_input(INPUT_GET,'page');
        require 'class/render.php';
      $render_php=new render($page);
      $render=$render_php->getRenderedPHP();
      echo $render;
    }else{?>
    
               <section class="content-header">
            <div>
              <ol class="breadcrumb">
            <!--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
                  <li class="active"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</li>
          </ol>  
            </div>
     </section>
<section class="content">
       <?php
    echo $_SESSION['user_s']."<br>";
    echo $_SESSION['fullname_s']."<br>";
    echo $_SESSION['dep_s']."<br>";
    echo $_SESSION['Status_s']."<br>";
    echo $_SESSION['process_s'];
    
    //include 'connection/connect.php';
  //require 'class/db_mng.php';
    
    $sql="select * from hospital";
    $myconn->db_m($sql);
       ?>
    
    <!--<form name="form1" action="index.php" method="post">
        <input name="name" type="text" placeholder="ชื่อโรง'บาล">
        <input name="url" type="text" placeholder="URL">
        <input type="hidden" name="method" value="insert">
        <input name="submit" type="submit">
    </form>
    <form name="form1" action="index.php" method="post">
        <select name="name" id="name">
        <?php/*
        $result=$myconn->select();//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
        for($i=0;$i<count($result);$i++){
        echo "<option value='".$result[$i]['hospital']."'>".$result[$i]['name'] ."</option>";
        
    }*/
        ?>
            
        </select>
        <input type="hidden" name="method" value="delete">
        <input name="delete" type="submit" value="ลบ">
    </form>-->
         <?php /*
         if(isset($_POST['width']) and isset($_POST['hight'])){
             require 'class/test_rect.php';
             $w=$_POST['width'];
             $h=$_POST['hight'];
             $myRec = new Rectangle($w,$h);?>
        
    <p>ความยาว: <?= $myRec->width?><br>
    ความสูง: <?= $myRec->hight?></p>
    <p>พื้นที่: <?= $myRec->area()?><br>
        เส้นรอบรูป: <?= $myRec->perimeter()?></p>
    <?php  } 
    
    
    if(!empty($_POST['method'])){
        if($_POST['method']=='insert'){
        $data=array($_POST['name'],$_POST['url']);
        $table="hospital";
        $where="hospital='1'";
        $field=array("name","url");
        $myconn->update($table, $data, $where, $field);
    }elseif ($_POST['method']=='delete') {
        $table="hospital";
        echo $where="hospital='".$_POST['name']."'";
        $myconn->delete($table, $where);    
        }
    }
    echo "<br>";
    $sql="select * from hospital";
    $myconn->db_m($sql);
    
    $result=$myconn->select($sql);//เรียกใช้ค่าจาก function ต้องใช้ตัวแปรรับ
    for($i=0;$i<count($result);$i++){
        echo $result[$i]['name'].' '.$result[$i]['url']."<br>";
        
    }*/
         ?>
    
</section>
    <?php }}else{?>
        

        <!-- Main content -->
<section class="content">
   <?php if($db==false){
        $check =  md5(trim('check'));
    ?>
<center>
    <h3>ยังไม่ได้ตั้งค่า Config <br>กรุณาตั้งค่า Config เพื่อเชื่อมต่อฐานข้อมูล</h3>
    <a href="#" class="btn btn-danger" onClick="return popup('set_conn_db.php?method=<?= $check?>', popup, 400, 515);" title="Config Database">Config Database</a>
    
</center> 
     <?php }?>
 NO LOGIN.           
            
</section>
    <?php }?>


<?php require 'footer.php';?>