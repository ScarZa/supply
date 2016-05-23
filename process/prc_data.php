<section class="content">
<?php
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
if(isset($_POST['check'])=='plus'){
            require '../class/db_mng.php';
            $mydata=new Db_mng();
            $mydata->read="../connection/conn_DB.txt";
            $mydata->config();
            $mydata->conn_mysqli();    
             }else{
                $mydata=new Db_mng();
                $mydata->read="connection/conn_DB.txt";
                $mydata->config();
                $mydata->conn_mysqli();
             }
    if(null !==(filter_input(INPUT_POST, 'method'))){
        $method=filter_input(INPUT_POST, 'method');
        if($method=='add_comp'){
        $data=array($_POST['comp_name'],$_POST['comp_vax'],$_POST['comp_address'],$_POST['comp_tell'],$_POST['comp_mobile'],$_POST['comp_fax']);
        $table="se_company";
        $check_comp=$mydata->insert($table, $data);
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_company' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_company'>";
        }
    }elseif($method=='edit_comp'){
        $data=array($_POST['comp_name'],$_POST['comp_vax'],$_POST['comp_address'],$_POST['comp_tell'],$_POST['comp_mobile'],$_POST['comp_fax']);
        $table="se_company";
        $edit_id=filter_input(INPUT_POST, 'edit_id');
        $where="comp_id='$edit_id'";
        $check_comp=$mydata->update($table, $data, $where,'');//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_company&id=$edit_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_company'>";
        }
    }if($method=='add_mate_type'){
        $data=array($_POST['type_name']);
        $table="se_material_type";
        $check_comp=$mydata->insert($table, $data);
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_mate_type' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_mate_type'>";
        }
    }elseif($method=='edit_mate_type'){
        $data=array($_POST['type_name']);
        $table="se_material_type";
        $edit_id=filter_input(INPUT_POST, 'edit_id');
        $where="mate_type_id='$edit_id'";
        $check_comp=$mydata->update($table, $data, $where,'');//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_mate_type&id=$edit_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_mate_type'>";
        }
    }  elseif($method=='add_mate'){
        $data=array($_POST['mate_name'],$_POST['mate_unit'],$_POST['mate_type_id'],$_POST['receive'],NULL,$_POST['min'],$_POST['max']);
        $table="se_material";
        $check_comp=$mydata->insert($table, $data);
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_material' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_material'>";
        }
    }elseif($method=='edit_mate'){
        $data=array($_POST['mate_name'],$_POST['mate_unit'],$_POST['mate_type_id'],$_POST['min'],$_POST['max']);
        $table="se_material";
        $field=array("mate_name","mate_unit","mate_type_id","min","max");
        $edit_id=filter_input(INPUT_POST, 'edit_id');
        $where="mate_id='$edit_id'";
        $check_comp=$mydata->update($table, $data, $where,$field);//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย
        $mydata->close_mysqli();
        if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_material&id=$edit_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_material'>";
        }
    }elseif($method=='add_import_order'){
        $data=array($_POST['ref_id'],$_POST['comp_id'],$_POST['order_date'],$_POST['order_mathod'],$_POST['order_amount'],$_SESSION['user_s'],$_POST['total_amount']);
        $table="se_order";
        $check_comp=$mydata->insert($table, $data);
         if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_import_order' >กลับ</a>";
    } else {
        $sql="select order_id,total_amount from se_order order by order_id desc limit 1";
        $mydata->db_m($sql);
        $select_order=$mydata->select();
        $mydata->close_mysqli();
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_list_order&id=".$select_order[0]['order_id']."&amount=".$select_order[0]['total_amount']."'>";
    }
        }elseif($method=='edit_import_order'){
           $total_amount= $_POST['total_amount'];
        $order_id= filter_input(INPUT_POST, 'edit_id');
        $data=array($_POST['ref_id'],$_POST['comp_id'],$_POST['order_date'],$_POST['order_mathod'],$_POST['order_amount'],$_SESSION['user_s'],$total_amount);
        $table="se_order";
        $where="order_id='$order_id'";
        $check_comp=$mydata->update($table, $data, $where, '');
         if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_import_order' >กลับ</a>";
    } else {
         echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_list_order&method=edit&id=".$order_id."&amount=".$total_amount."'>";
    }
        }elseif($method=='add_list_order'){
            for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i];
$sql="select receive from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_res=$mydata->select();
$receive=$select_res[0]['receive']+$up_amount;
        
        $data=array($receive);
        $table="se_material";
        $field=array("receive");
        $where="mate_id='$mate_id'";
        $check_mate=$mydata->update($table, $data, $where,$field);//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย    

$sql="select receive,pay from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_res_pay=$mydata->select();

$order[$i]=$_POST['id'];
echo $price[$i]=$_POST['price'][$i];

$order_id=$order[$i];
$price_in=$price[$i];
$total=$select_res_pay[0]['receive']-$select_res_pay[0]['pay'];

        $data=array($order_id,$mate_id,$price_in,$up_amount,$total);
        $table="se_list_order";
        $check_list=$mydata->insert($table, $data);
        } 
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_list_order&id=$order_id&amount=$up_amount' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_import_order'>";
    }
        }elseif($method=='edit_list_order'){
            for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i];
$sql="select receive from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_res=$mydata->select();//เรียกค่านำเข้าออกมา
$lo[$i]=$_POST['lo_id'][$i];
$lo_id=$lo[$i];
$sql="select amount from se_list_order where lo_id='$lo_id]'";
$mydata->db_m($sql);
$lo_check=$mydata->select();//เรียกจำนวนที่เคยนำเข้าออกมา
$res=$select_res[0]['receive']-$lo_check[0]['amount'];
$receive=$res+$up_amount;
        
        $data=array($receive);
        $table="se_material";
        $field=array("receive");
        $where="mate_id='$mate_id'";
        $check_mate=$mydata->update($table, $data, $where,$field);//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย    

$sql="select receive,pay from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_res_pay=$mydata->select();

$order[$i]=$_POST['id'];
$price[$i]=$_POST['price'][$i];

$order_id=$order[$i];
$price_in=$price[$i];
$total=$select_res_pay[0]['receive']-$select_res_pay[0]['pay'];

        $data=array($order_id,$mate_id,$price_in,$up_amount,$total);
        $table="se_list_order";
        $where="lo_id='$lo_id'";
        $field=array("order_id","mate_id","price","amount","total");
        $check_list=$mydata->update($table, $data, $where, $field);
        } 
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_list_order&id=$order_id&amount=$up_amount' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_import_order'>";
    }
        }elseif($method=='add_withdrawal_order'){
        $data=array($_POST['or_date'],$_POST['empno'],$_POST['dep_id'],$_POST['or_no'],'N');
        $table="se_pay_order";
        $check_comp=$mydata->insert($table, $data);
         if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_withdrawal_order' >กลับ</a>";
    } else {
        $sql="select po_id from se_pay_order order by po_id desc limit 1";
        $wd_amount=$_POST['withdrawal'];
        $mydata->db_m($sql);
        $select_order=$mydata->select();
        $mydata->close_mysqli();
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_list_withdrawal&id=".$select_order[0]['po_id']."&amount=".$wd_amount."'>";
    }
        }elseif($method=='add_list_withdrawal'){
                         for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i];
$op[$i]=$_POST['id'];
$op_id=$op[$i];

        $data=array($op_id,$mate_id,$up_amount);
        $table="se_withdrawal";
        $check_list=$mydata->insert($table, $data);
        } 
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_list_withdrawal&id=$op_id&amount=$up_amount' >กลับ</a>";
    } else {
        if(isset($_POST['check'])=='plus'){
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=../content/detial_withdrawal_order.php?id=$op_id'>";    
        }else{
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_withdrawal_order'>";
        }
    }
        }elseif($method=='add_pay_order'){
            $po_id=$_POST['po_id'];
            $table="se_pay_order";
            $data=array($_POST['or_no'],"Y");
            $field=array("or_no","or_status");
            $where="po_id='$po_id'";
            $mydata->update($table, $data, $where,$field);
            $pay_date=$_POST['pay_date'];
            for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i];
$sql="select pay from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_pay=$mydata->select();
$pay=$select_pay[0]['pay']+$up_amount;
        
        $data=array($pay);
        $table="se_material";
        $field=array("pay");
        $where="mate_id='$mate_id'";
        $check_mate=$mydata->update($table, $data, $where,$field);//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย    

$sql="select receive,pay from se_material where mate_id='$mate_id'";
$mydata->db_m($sql);
$select_res_pay=$mydata->select();

$po[$i]=$_POST['po_id'];
$po_id=$po[$i];
$total=$select_res_pay[0]['receive']-$select_res_pay[0]['pay'];

$sql="select wd_id,amount from se_withdrawal where po_id='$po_id' and mate_id='$mate_id'";
$mydata->db_m($sql);
$select_wd=$mydata->select();
$wd_id=$select_wd[0]['wd_id'];
$remain=$select_wd[0]['amount']-$up_amount;

        $data=array($pay_date,$po_id,$wd_id,$mate_id,$up_amount,$total,$remain,$_SESSION['user_s']);
        $table="se_pay";
        $check_list=$mydata->insert($table, $data);
        
        }
        if(!empty($_POST['amount2'])){
        for($i=0;$i<count($_POST['amount2']);$i++){
$mate2[$i]=$_POST['mate_id2'][$i];
$mate2_id=$mate2[$i];
$amount2[$i]=$_POST['amount2'][$i];
$up_amount2=$amount2[$i];
$sql="select pay from se_material where mate_id='$mate2_id'";
$mydata->db_m($sql);
$select_pay2=$mydata->select();
$pay2=$select_pay2[0]['pay']+$up_amount2;
        
        $data=array($pay2);
        $table="se_material";
        $field=array("pay");
        $where="mate_id='$mate2_id'";
        $check_mate=$mydata->update($table, $data, $where,$field);//แบบ parameter ไม่ครบ ให้ใส่ค่าว่างเลย    

$sql="select receive,pay from se_material where mate_id='$mate2_id'";
$mydata->db_m($sql);
$select_res_pay2=$mydata->select();

$bo[$i]=$_POST['bo_id'];
$bo_id=$bo[$i];
$total2=$select_res_pay2[0]['receive']-$select_res_pay2[0]['pay'];

$sql="select amount from se_borrow where bo_id='$bo_id' and mate_id='$mate2_id'";
$mydata->db_m($sql);
$select_bo=$mydata->select();
$remain2=$select_bo[0]['amount']-$up_amount2;

        $data=array($pay_date,$po_id,$wd_id,$mate2_id,$up_amount2,$total2,$remain2,$_SESSION['user_s'],'B');
        $table="se_pay";
        $check_list=$mydata->insert($table, $data);
        } 
        $data=array('A',$po_id);
        $table="se_borrow_order";
        $field=array("bo_status","po_id");
        $where="bo_id='$bo_id'";
        $check_update=$mydata->update($table, $data, $where,$field);
        }
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_pay_order&id=$po_id&amount=$up_amount' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_pay_order'>";
    }
        }elseif($method=='add_borrow_order'){
        $data=array($_POST['bo_date'],date("Y-m-d"),$_POST['empno'],$_POST['dep_id'],$_POST['bo_no'],'N',NULL);
        $table="se_borrow_order";
        $check_comp=$mydata->insert($table, $data);
         if(!$check_comp){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_borrow_order' >กลับ</a>";
    } else {
        $sql="select bo_id from se_borrow_order order by bo_id desc limit 1";
        $bo_amount=$_POST['borrow'];
        $mydata->db_m($sql);
        $select_order=$mydata->select();
        $mydata->close_mysqli();
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_list_borrow&id=".$select_order[0]['bo_id']."&amount=".$bo_amount."'>";
    }
        }elseif($method=='add_list_borrow'){
                         for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i];
$bo[$i]=$_POST['id'];
$bo_id=$bo[$i];

        $data=array($bo_id,$mate_id,$up_amount);
        $table="se_borrow";
        $check_list=$mydata->insert($table, $data);
        } 
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_list_borrow&id=$bo_id&amount=$up_amount' >กลับ</a>";
    } else {
        if(isset($_POST['check'])=='plus'){
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=../content/detial_withdrawal_order.php?id=$bo_id'>";    
        }else{
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_borrow_order'>";
        }
        }}elseif($method=='add_pay_borrow'){
            $bo_id=$_POST['bo_id'];
            $table="se_borrow_order";
            $data=array($_POST['bo_no'],"Y");
            $field=array("bo_no","bo_status");
            $where="bo_id='$bo_id'";
            $mydata->update($table, $data, $where,$field);
            $pay_date=$_POST['pbo_date'];
            for($i=0;$i<count($_POST['amount']);$i++){
$mate[$i]=$_POST['mate_id'][$i];
$mate_id=$mate[$i];
$amount[$i]=$_POST['amount'][$i];
$up_amount=$amount[$i]; 
$receive[$i]=$_POST['receiver'];
$receiver=$receive[$i];

$bo[$i]=$_POST['bo_id'];
$bo_id=$bo[$i];

$sql="select borrow_id,amount from se_borrow where bo_id='$bo_id' and mate_id='$mate_id'";
$mydata->db_m($sql);
$select_borrow=$mydata->select();
$borrow_id=$select_borrow[0]['borrow_id'];

        $data=array($pay_date,date("Y-m-d"),$bo_id,$borrow_id,$mate_id,$up_amount,$_SESSION['user_s'],$receiver);
        $table="se_pay_borrow";
        $check_list=$mydata->insert($table, $data);
        } 
         if(!$check_list){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_borrow_order&id=$bo_id&amount=$up_amount' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_borrow_order'>";
    }
        }elseif($method=='add_user'){
            $username=  trim(md5($_POST['user_account']));
            $pass_word=  trim(md5($_POST['user_pwd']));
        $data=array($username,$pass_word,$_POST['user_account'],$_POST['name'],$_POST['admin'],$_POST['process']);
        $table="ss_member";
        $check_user=$mydata->insert($table, $data);
        $mydata->close_mysqli();
        if(!$check_user){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_User' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_user'>";
        }
    }elseif($method=='update_user'){
        if(!empty($_POST['user_pwd'])){
            $username=  trim(md5($_POST['user_account']));
            $pass_word=  trim(md5($_POST['user_pwd']));
        $data=array($username,$pass_word,$_POST['user_account'],$_POST['name'],$_POST['admin'],$_POST['process']);
        $table="ss_member";
        $where="ss_UserID='".$_POST['ID']."'";
        $check_user=$mydata->update($table, $data, $where, '');
        }else{
            $username=  trim(md5($_POST['user_account']));
        $data=array($username,$_POST['user_account'],$_POST['name'],$_POST['admin'],$_POST['process']);
        $table="ss_member";
        $where="ss_UserID='".$_POST['ID']."'";
        $field=array("ss_Username","ss_user_name","ss_Name","ss_Status","ss_process");
        $check_user=$mydata->update($table, $data, $where, $field);  
        }
        $mydata->close_mysqli();
        if(!$check_user){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_User' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_user'>";
        }
    }
    }elseif(null !==(filter_input(INPUT_GET, 'method'))){
       $method=filter_input(INPUT_GET, 'method');
       if($method=='delete_comp') {
        $table="se_company";
        $delete_id=filter_input(INPUT_GET, 'del_id');
        $where="comp_id='$delete_id'";
        $del=$mydata->delete($table, $where);
        if($del==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_company&id=$delete_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_company'>";
        }
        }elseif($method=='delete_mate_type') {
        $table="se_material_type";
        $delete_id=filter_input(INPUT_GET, 'del_id');
        $where="mate_type_id='$delete_id'";
        $del=$mydata->delete($table, $where);
        if($del==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_mate_type&id=$delete_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_mate_type'>";
        }
        }elseif($method=='delete_material') {
        $table="se_material";
        $delete_id=filter_input(INPUT_GET, 'del_id');
        $where="mate_id='$delete_id'";
        $del=$mydata->delete($table, $where);
        if($del==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_material&id=$delete_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_material'>";
        }
        }elseif($method=='delete_import_order') {
        $table="se_order";
        $delete_id=filter_input(INPUT_GET, 'del_id');
        $where="order_id='$delete_id'";
        $del=$mydata->delete($table, $where);
        
        $table2="se_list_order";
        $where2="order_id='$delete_id'";
        $del_list=$mydata->delete($table2, $where2);
        if(($del and $del_list) ==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_import_order&id=$delete_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_import_order'>";
        }
        }elseif($method=='delete_pay_order') {
        $table="se_pay_order";
        $delete_id=filter_input(INPUT_GET, 'del_id');
        $where="po_id='$delete_id'";
        $del=$mydata->delete($table, $where);
        
        $table2="se_withdrawal";
        $where2="po_id='$delete_id'";
        $del_list=$mydata->delete($table2, $where2);
        if(($del and $del_list) ==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_pay_order&id=$delete_id' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_pay_order'>";
        }
        }elseif($method=='delete_user') {
        $table="ss_member";
        $where="ss_UserID='".$_GET['ID']."'";
        $del=$mydata->delete($table, $where);
        if($del==false){
        echo "<span class='glyphicon glyphicon-remove'></span>";
        echo "<a href='index.php?page=content/add_User&id=".$_GET['ss_id']."' >กลับ</a>";
    } else {
        echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php?page=content/add_User'>";
        }
        }
}
?>
</section>