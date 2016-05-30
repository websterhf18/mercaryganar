<?php
include_once ("z_db.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
        print "
				<script language='javascript'>
					window.location = 'index.php';
				</script>
			";
}
$payto=$_SESSION['username'];



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']) && (($_POST['todo'])=="paymentpost"))
{

$username=mysqli_real_escape_string($con,$_SESSION['username']);

$status = "OK"; //initial status
$msg="";



$rr=mysqli_query($con,"SELECT Id FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$uid = $r[0];

$rr=mysqli_query($con,"SELECT pcktaken FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$pc = $r[0];

$rr=mysqli_query($con,"SELECT mpay FROM packages WHERE id='$pc'");
$r = mysqli_fetch_row($rr);
$mpay = $r[0];

$rr=mysqli_query($con,"SELECT tamount FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$nr = $r[0];

if($nr<$mpay){
$msg=$msg."You are not eligible for payment!!!! Contact support for more info.<BR>";
$status= "NOTOK";
}

if($status=="OK")
{
$res11=mysqli_query($con,"update affiliateuser set tamount=0 where username='$username'");
$res1=mysqli_query($con,"INSERT INTO payments (userid, payment_amount, createdtime) VALUES ('$uid', '$nr', NOW())");

if($res1)
{
$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your Payment Request Has Been Sent! Payment Will be Processed After Successful Verification On Time.</div>"; //printing error if found in validation

}
else
{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help. </div>"; //printing error if found in validation
				
	 
}


} 
else {
        
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>".$msg."</div>"; //printing error if found in validation
				
	 
	 
}

}


?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>Pantalla de inicio</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
<link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css" />
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
</head>
<body class="" >
<section class="vbox">
  <header class="bg-success header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header aside-md dk" style="background-color: #FFFFFF;"> 
      <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> 
        <i class="fa fa-bars"></i> 
      </a> 
      <a href="dashboard.php" class="navbar-brand">
        <img src="images/logo-dash.png" class="m-r-sm" style="max-height:50px;">
      </a> 
      <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"> <i class="fa fa-cog"></i> </a> </div>
  
    
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
      
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> <img src="images/a0.jpg"> </span> <?php
		  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        print $row[0];
    }

}

   
	   
	   ?><b class="caret"></b> </a>
        <ul class="dropdown-menu animated fadeInRight">
          <span class="arrow top"></span>
          
          <li> <a href="profile.php">Perfil</a> </li>
          <li> <a href="notifications.php"> Notificaciones </a> </li>
          <li> <a href="contact.php">Ayuda</a> </li>
          <li class="divider"></li>
          <li> <a href="logout.php" data-toggle="ajaxModal" >Cerrar sesion</a> </li>
        </ul>
      </li>
    </ul>
  </header>
  <section>
    <section class="hbox stretch">
      <!-- .aside -->
      <aside class="bg-light aside-md hidden-print" id="nav">
        <section class="vbox">
          <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-color="#333333">
              <!-- nav -->
              <nav class="nav-primary hidden-xs">
                <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Menu</div>
                <ul class="nav nav-main" data-ride="collapse">
                  <li class="active"> <a href="dashboard.php" class="auto"> <i class="i i-statistics icon"> </i> <span class="font-bold">Inicio</span> </a> </li>
                  
                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-lab icon"> </i> <span class="font-bold">Perfil</span> </a>
                    <ul class="nav dk">
                      <li > <a href="downline.php" class="auto"> <i class="i i-dot"></i> <span>Referidos/Ganancias</span> </a> </li>
                      
                      
                      
                      <li > <a href="invoice.php" class="auto"> <i class="i i-dot"></i> <span>Facturas/Estado de cuenta</span> </a> </li>
                      <li> <a href="paymentshistory.php" class="auto"> <i class="i i-dot"></i> <span>Historial de pagos</span> </a> </li>
                    </ul>
                  </li>
                  
                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-grid2 icon"> </i> <span class="font-bold">Ayuda</span> </a>
                    <ul class="nav dk">
                      <li > <a href="notifications.php" class="auto"><i class="i i-dot"></i> <span>Notificaciones</span> </a> </li>
                      <li > <a href="contact.php" class="auto"> <i class="i i-dot"></i> <span>Contacto</span> </a> </li>
                    </ul>
                  </li>
                </ul>
                <div class="line dk hidden-nav-xs"></div>
                
                
              </nav>
              <!-- / nav -->
            </div>
          </section>
          <footer class="footer hidden-xs no-padder text-center-nav-xs"> <a href="logout.php" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs"> <i class="i i-logout"></i> </a> <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"> <i class="i i-circleleft text"></i> <i class="i i-circleright text-active"></i> </a> </footer>
        </section>
      </aside>
      <!-- /.aside -->
      <section id="content">
        <section class="hbox stretch">
          <section>
            <section class="vbox">
              <section class="scrollable padder">
                <section class="row m-b-md">
                  <div class="col-sm-6">
				  
                    <h3 class="m-b-xs text-black">Inicio</h3>
                    <small>Bienvenido, <?php
		  $sql2="SELECT fname,country,pcktaken FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
      if ($result2 = mysqli_query($con, $sql2)) {

    /* fetch associative array */
    while ($row2 = mysqli_fetch_row($result2)) {
        //print $row2[0];
    $coun=$row2[1];
    $pcktaken=$row2[2];
     $sql2="SELECT name FROM packages WHERE id=$pcktaken";
     if ($result2 = mysqli_query($con, $sql2)) {
      while ($row2 = mysqli_fetch_row($result2)) {
     
     $pkname=$row2[0];
     }
     }
    
    }

}
      $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['username']."'";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        print $row[0];

    }

}
if($_SERVER['REQUEST_METHOD'] == 'POST')
						{
						print $errormsg;
						}
   
	   
	   ?>, <i class="fa fa-map-marker fa-lg text-primary"></i> <?php print $coun ?></small> </div>
	   
                  <div class="col-sm-6 text-right text-left-xs m-t-md">
				  
                    
                    <a href="#" class="btn btn-icon b-2x btn-default btn-rounded hover"><i class="i i-bars3 hover-rotate"></i></a> <a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a> </div>
                </section>
                <div class="row">
				<div class="col-sm-12">
				
                      <div class="panel b-a">
                        <div class="row m-n">
                        
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                                <i class="i i-users2 i-sm text-white"></i>
                              </span>
                              <span class="clear">
							  <?php
							  $sqlquery="SELECT username,country,doj,pcktaken FROM affiliateuser where referedby='".$_SESSION['username']."' ORDER BY Id DESC LIMIT 1"; //fetching website from databse
$rec2=mysqli_query($con,$sqlquery);
$row2 = mysqli_fetch_row($rec2);
$referusername=$row2[0];
$refcountry=$row2[1];
$refdate=$row2[2];
$refpckid=$row2[3];
$sqlquery11="SELECT name FROM packages where id = $refpckid"; //fetching no of days validity from package table from databse
$rec211=mysqli_query($con,$sqlquery11);
@$row211 = mysqli_fetch_row($rec211);
$refpckname=$row211[0]; //assigning we
							  
							  ?>
                                <span class="h3 block m-t-xs text-success"><?php print $referusername; ?></span>
                                <small class="text-muted text-u-c">Ultimo referido</small>
                              </span>
                            </a>
                          </div>
						    <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                                <i class="i i-plus2 i-1x text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-danger"><?php print $refpckname; ?></span>
                                <small class="text-muted text-u-c">Paquete comprado</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                <i class="i i-location i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-info"><?php print $refcountry; ?><span class="text-sm"></span></span>
                                <small class="text-muted text-u-c">Pais</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                <i class="i i-alarm i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-primary"><?php print $refdate; ?></span>
                                <small class="text-muted text-u-c">Fecha</small>
                              </span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
					
				<div class="col-lg-12">
                <section class="panel panel-default">
                  <div class="panel-body">
                    <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken,tamount FROM  affiliateuser where username = '".$_SESSION['username']."'"; 
 
 
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
 <?php $query="SELECT * FROM  packages where id=$pck"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
 $pname="$row[name]";
 $pdetails="$row[details]";
 $pprice="$row[price]";
 $pcur="$row[currency]";
 $ptax="$row[tax]";
 $mpay="$row[mpay]";
 }
 @$left=$mpay-$ear; 
@$pro=(($ear/$mpay)*100);
 ?>
 
                  <footer class="panel-footer bg-info text-center">
                    <div class="row pull-out">
                      <div class="col-xs-6">
                        <div class="padder-v"> <span class="m-b-xs h3 block text-white"><?php @print $pcur ?><?php print $ear ?></span> <small class="text-muted">Ganancias</small> </div>
                      </div>
                      <div class="col-xs-6 dk">
					  <?php
$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where referedby = '".$_SESSION['username']."'");
$row = mysqli_fetch_row($result);
$numrows = $row[0];

?>
                        <div class="padder-v"> <span class="m-b-xs h3 block text-white"><?php print $numrows ?></span> <small class="text-muted">Referidos (directos) </small> </div>
                      </div>
                      
                    </div>
                  </footer>
				     <section class="panel panel-default" id="progressbar">
                  <header class="panel-heading">
                    <ul class="nav nav-pills pull-right">
                      
                    </ul>
					<div class="form-group">
					  <input type="hidden" name="todo" value="post">
                        <label>Link para referir un amigo!</label>
                        <input type="text" value="<?php $query121="SELECT * FROM  settings"; $result121 = mysqli_query($con,$query121);
$i=0;
while($row121 = mysqli_fetch_array($result121))
{
	
	
	$wlink="$row121[wlink]";
	
	}
				
					  
		$pathu="/User/signup.php?aff=";		 print $wlink.$pathu.$_SESSION['username'] ?>" class="form-control" placeholder="Your Invite URL" name="inviteurl" >
                      </div>
                    Barra de progreso para siguiente nivel.</header>
                  <ul class="list-group">
                    
                    <li class="list-group-item">
                      <div class="progress progress-sm m-t-sm">
                        <div class="progress-bar bg-primary" data-toggle="tooltip" data-original-title="<?php print $pro ?>%" style="width: <?php print $pro ?>%">
						
						</div>
						
                      </div>
					  
                      
                    </li>
					<br/>
					<h3 align="center"><?php 
					
					
					if($left<=0)
					{
					$congomsg1="Felicitacion haz alcanzado el minimo para el siguiente nivel!!!! Puedes solicitar para que empiezes a Ganar Y Mercar. </br>";
					print $congomsg1;
					$congomsg2="<form action='"; 
					print $congomsg2;
					echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8");
					$congomsg3="' method='post'></br><input type='hidden' name='todo' value='paymentpost'><button type='submit' class='btn btn-success btn-s-xs'>Enviar peticion de pago</button>  </form> ";
					print $congomsg3;
					}
					
					else
					{
					print " Tu necesitas alcanzar <b>$pcur $left</b> para poder alcanzar el siguiente nivel. ";
					}
					
					?></h3>
                    
                  </ul>
                </section>
                </section>
              </div>

                  
                  <div class="col-md-6 col-sm-6">
                    <div class="panel b-a">
						  <?php $query="SELECT * FROM  settings"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
 $fblink="$row[fblink]";
 $twilink="$row[twitterlink]";
 
 }
 ?>
                      <div class="panel-heading no-border bg-primary lt text-center"> <a href="<?php print $fblink ?>"> <i class="fa fa-facebook fa fa-3x m-t m-b text-white"></i> </a> </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="panel b-a">
                      <div class="panel-heading no-border bg-info lter text-center"> <a href="<?php print $twilink ?>"> <i class="fa fa-twitter fa fa-3x m-t m-b text-white"></i> </a> </div>
                    </div>
                  </div>
               
                </div>
                
                
              
            </section>
          </section>

        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
    </section>
  </section>
</section>
<!-- Bootstrap -->
<!-- App -->
<script src="js/app.v1.js"></script>
<script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="js/charts/sparkline/jquery.sparkline.min.js"></script>
<script src="js/charts/flot/jquery.flot.min.js"></script>
<script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/charts/flot/jquery.flot.spline.js"></script>
<script src="js/charts/flot/jquery.flot.pie.min.js"></script>
<script src="js/charts/flot/jquery.flot.resize.js"></script>
<script src="js/charts/flot/jquery.flot.grow.js"></script>
<script src="js/charts/flot/demo.js"></script>
<script src="js/calendar/bootstrap_calendar.js"></script>
<script src="js/calendar/demo.js"></script>
<script src="js/sortable/jquery.sortable.js"></script>
<script src="js/app.plugin.js"></script>
</body>
</html>