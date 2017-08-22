<?php
//connect db
require_once "condb.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Google chart query table advance By Apd Softs</title>

<link href="bootstrap.min.css" rel=stylesheet />

<script src="jquery-2.0.3.min.js"></script>

<!--chart google api-->
<script src=https://www.gstatic.com/charts/loader.js></script>

</head>
<body>

<div class="row">

<div class="col-lg-12">

<h3 align="center">Google chart query table advance By <a href="https://www.facebook.com/ApdSofts/" target="_blank">Apd Softs</a></h3>

<form method="post" action="">

<div class="alert bg-info">

Table query: 
<select name="table" required onchange="window.location='?table='+this.value;">
<option value="">Select table</option>
<?php 
$sql = $conn->query("select TABLE_NAME
       FROM information_schema.TABLES
       WHERE TABLE_SCHEMA = '$db'");
while ($tables = $sql->fetch_assoc()){
foreach($tables as $tmp)
{
?>
<option value="<?php echo $tmp;?>"<?php if($_REQUEST['table']==$tmp){echo 'selected';}?>><?php echo $tmp;?></option>	
<?php } }?>
</select>

Column query: 
<select name="column" required>
<option value="">Select column</option>
<?php 
$sql = $conn->query("select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$_REQUEST[table]'");
while ($tables = $sql->fetch_assoc()){
foreach($tables as $tmp)
{
?>
<option value="<?php echo $tmp;?>" <?php if($_REQUEST['column']==$tmp){echo 'selected';}?>><?php echo $tmp;?></option>	
<?php } }?>
</select>

<?php $a = array('count','sum');?>

Type: 
<select name="type" required>
<option value="">Select type</option>
<?php foreach($a as $i => $value){?>
<option value="<?php echo $a[$i];?>"<?php if($_REQUEST['type']==$a[$i]){echo 'selected';}?>><?php echo $a[$i];?></option>
<?php } ?>
</select>

<br><hr>

Title Chart: <input type="text" name="title" value="<?php echo $_POST[title];?>" required size="30">	
Grand name: <input type="text" name="grand" value="<?php echo $_POST[grand];?>" required size="30">
Year: 
<select name="year" required>
<option value="">Select year</option>
<?php for($i=2025;$i>=2010;$i--){?>
<option value="<?php echo $i;?>"<?php if($_REQUEST['year']==$i){echo 'selected';}?>><?php echo $i;?></option>
<?php } ?>
</select>

<?php
if($_REQUEST['table']){
//ส่งค่า วันที่ที่อยู่ในตารางนั้น เอาเฉพาะ type ที่เป็น date ไป query 
$sql = $conn->query("select COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
  WHERE TABLE_SCHEMA = '$db' AND table_name = '$_REQUEST[table]' AND data_type = 'date'");
$row = $sql->num_rows;
if($row>0){
$tables = $sql->fetch_assoc();
foreach($tables as $tmp)
{
?>
<input type="hidden" name="date_create" value="<?php echo $tmp;?>">

<?php }} else {echo "<script>alert('No column data_type (date) !');history.back();</script>";}

}

 ?>

<input type="submit" name="submit" class="btn btn-success" value="Submit">

</div>

</form>

</div>

<?php
//show chart after query 
require_once "chart_api.php";
?>

</div>
</div>

<hr>

<div class="col-lg-12" align="right">Develop by <a href="https://www.facebook.com/ApdSofts/" target="_blank">Apd Softs.</a></div>


</body>

</html>
