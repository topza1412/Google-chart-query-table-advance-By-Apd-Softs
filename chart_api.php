
<script type="text/javascript">

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {

    var data = google.visualization.arrayToDataTable([

<?php if($_POST['grand']){?>

//ส่วนของ แกน x แกน y
["Month" ,"<?php echo $_POST[grand];?>"],

<?php } ?>

 <?php
$month = array ('Year '.$year,'January','February','March','April','May','June','July','August','September','October','November','December');

//loop จำนวนเดือนทั้งหมด
foreach ($month as $i => $value) {

//สร้างเดือน
$m = '0'.$i; 

//type = count
if($_POST['type']=='count'){
$sql = $conn->query("select DATE_FORMAT($_POST[date_create],'%m') as m,DATE_FORMAT($_POST[date_create],'%Y') as y,count($_POST[column]) as total from $_POST[table] where DATE_FORMAT($_POST[date_create],'%Y') = '$_POST[year]' group by m = '".$m."',y order by $_POST[column] asc");
}
if($_POST['type']=='sum'){
$sql = $conn->query("select DATE_FORMAT($_POST[date_create],'%m') as m,DATE_FORMAT($_POST[date_create],'%Y') as y,sum($_POST[column]) as total from $_POST[table] where DATE_FORMAT($_POST[date_create],'%Y') = '$_POST[year]' group by m = '".$m."',y order by $_POST[column] asc");
}

$row = $sql->num_rows;

//แสดงข้อมูลที่ query ออกมา
while($show = $sql->fetch_assoc()){
if($m>='01'){

//เข้าเงื่อนไขให้แสดงข้อมูลของแต่ละเดือน
if($i==$show['m']){
  $total = $show[total];
}
else {

  $total = 0;
}


?>

//แสดงข้อมูลกราฟ
['<?php echo $month[$i];?>',<?php echo $total;?>],

<?php } } }?>

]);

    // ตั้งค่าต่างๆ ของกราฟ
    var options = {
          chart: {
            title: "<?php echo $_POST[title].' ('.$_POST[year].')';?>",
            subtitle: "<?php echo $_POST[title];?>",
          },
          /*bars: 'horizontal' // ถ้าต้องการทำเป็นกราฟแนวนอนให้เอาคอมเม้นออก.*/
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, options);

}

</script>


<div class="alert col-lg-12">
<?php if($row>0){?>
<!-- แสดงข้อมูลกราฟ -->
<div style="margin:auto;width:100%;"><div id="chart_div" style="margin:auto;width:1100px;height:500px;"></div></div>
<?php } else {?>
<div class="alert" align="center">
<div class="alert alert-danger">Data Not Found!</div>
</div>
<?php } ?>
</div>
