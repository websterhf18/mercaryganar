<?php
include_once ("z_db.php");
if (!empty($_POST))
{
//Fetching Details for user, package and payment gateway
$pgateid=mysqli_real_escape_string($con,$_POST['renewgateway']);
$userid=mysqli_real_escape_string($con,$_POST['renewusername']);
$renewpckid=mysqli_real_escape_string($con,$_POST['renewpck']);

$query="SELECT id,fname,email,doj,active,username,address,pcktaken,tamount FROM  affiliateuser where username = '$userid'"; 
$result = mysqli_query($con,$query);
while($row = mysqli_fetch_array($result))
{
 $aid="$row[id]";
 $regdate="$row[doj]";
 $name="$row[fname]";
 $address="$row[address]";
 $acti="$row[active]";
 $pck="$row[pcktaken]";
 $ear="$row[tamount]";
 
 }
 ?> 
 <?php $query="SELECT * FROM  packages where id = $renewpckid"; 
 
$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$pname="$row[name]";
	$pprice="$row[price]";
	$pcur="$row[currency]";
	$ptax="$row[tax]";
	$gatewayid="$row[gateway]";
	$total=$pprice+$ptax;
// "<option value='$id'>$pname | Price - $pcur $total </option>";
  
  }
  
  // Details fetching end


if($pgateid==2)
{

$queryuser="SELECT id FROM  affiliateuser where username = '$userid'"; 
$resultuser = mysqli_query($con,$queryuser);

while($rowuser = mysqli_fetch_array($resultuser))
{
 $uaid="$rowuser[id]";
 }
			$query=mysqli_query($con,"insert into paypalpayments(orderid,transacid,price,currency,date,cod,renew,renacid) values('$uaid','C.O.D','$total','$pcur',NOW(),1,1,$renewpckid)");
			print "
				<script language='javascript'>
					window.location = 'finalthankyoufree.php?username=$userid';
				</script>
			"; 
}
}
else
{
print "
				<script language='javascript'>
					window.location = 'renewaccount.php';
				</script>
			";
}
?>