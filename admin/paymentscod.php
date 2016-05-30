<?php
include_once ("z_db.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminidusername'])) {
        print "
				<script language='javascript'>
					window.location = 'index.php';
				</script>
			";
}
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>C.O.D Payments</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
<div id="google_translate_element" align="right"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
</head>
<body class="">
<section class="vbox">
  <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header aside-md dk"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="dashboard.php" class="navbar-brand"><img src="images/logo.png" class="m-r-sm">Skyey</a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"> <i class="fa fa-cog"></i> </a> </div>
  
    
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
      
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> <img src="images/a0.jpg"> </span> <?php
		  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        print $row[0];
    }

}

   
	   
	   ?> <b class="caret"></b> </a>
       <ul class="dropdown-menu animated fadeInRight">
          <span class="arrow top"></span>
          <li> <a href="profile.php">Profile</a> </li>
          <li class="divider"></li>
          <li> <a href="logout.php" data-toggle="ajaxModal" >Logout</a> </li>
        </ul>
      </li>
    </ul>
  </header>
  <section>
    <section class="hbox stretch">
      <!-- .aside -->
      <aside class="bg-black aside-md hidden-print" id="nav">
        <section class="vbox">
          <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-color="#333333">
              <div class="clearfix wrapper dk nav-user hidden-xs">
                <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb avatar pull-left m-r"> <img src="images/a0.jpg"> <i class="on md b-black"></i> </span> <span class="hidden-nav-xs clear"> <span class="block m-t-xs"> <strong class="font-bold text-lt"><?php
		  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        print $row[0];
    }

}

   
	   
	   ?></strong> <b class="caret"></b> </span> <span class="text-muted text-xs block">Art Director</span> </span> </a>
                  <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <span class="arrow top hidden-nav-xs"></span>
                    <li> <a href="profile.php">Profile</a> </li>
                    <li class="divider"></li>
                    <li> <a href="logout.php" data-toggle="ajaxModal" >Logout</a> </li>
                  </ul>
                </div>
              </div>
              <!-- nav -->
              <nav class="nav-primary hidden-xs">
                <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div>
                <ul class="nav nav-main" data-ride="collapse">
                  <li> <a href="#" class="auto"> <i class="i i-statistics icon"> </i> <span class="font-bold">Account</span> </a> 
				  <ul class="nav dk">
                      <li> <a href="dashboard.php" class="auto"><i class="i i-dot"></i> <span>Dashboard</span> </a> </li>
                      
                    </ul>
				  </li>
                  
                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-lab icon"> </i> <span class="font-bold">Website Configuration</span> </a>
                    <ul class="nav dk">
                      <li > <a href="gensettings.php" class="auto"> <i class="i i-dot"></i> <span>General Settings</span> </a> </li>
					  <li> <a href="emailsettings.php" class="auto"> <i class="i i-dot"></i> <span>E-Mail Settings</span> </a> </li>
                      
                      
                      
                      <li > <a href="pacsettings.php" class="auto"> <i class="i i-dot"></i> <span>Packages Settings</span> </a> </li>
                      
                    </ul>
                  </li>
                  
                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-grid2 icon"> </i> <span class="font-bold">Blog</span> </a>
                    <ul class="nav dk">
                      <li > <a href="notifications.php" class="auto"><i class="i i-dot"></i> <span>Post Notifications</span> </a> </li>
                      
                    </ul>
                  </li>
				  <li class="active"  > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="fa fa-info-circle"> </i> <span class="font-bold">Analytics</span> </a>
                    <ul class="nav dk">
                      <li > <a href="users.php" class="auto"><i class="i i-dot"></i> <span>Users</span> </a> </li>
                      <li > <a href="payments.php" class="auto"><i class="i i-dot"></i> <span>Paypal Payment Received </span> </a> </li>
					  <li class="active" > <a href="paymentscod.php" class="auto"><i class="i i-dot"></i> <span>C.O.D Orders </span> </a> </li>
					  <li > <a href="payrequest.php" class="auto"><i class="i i-dot"></i> <span>User's Payment Requests </span> </a> </li>
					  <li > <a href="renewpaymentscod.php" class="auto"><i class="i i-dot"></i> <span>Account Renew Requests </span> </a> </li>
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
        <section class="vbox">
          <header class="header bg-white b-b b-light">
            <p><strong>Important Instructions </strong> <b>1.</b> Please verify your payments in Paypal account before activating the user's account.<b> 2. </b> Records are shown from newest to oldest.</p>
          </header>
          <section class="scrollable wrapper">
            <div class="row">
              
              <div class="col-sm-12 portlet">
                <section class="panel panel-success portlet-item">
                  <header class="panel-heading"> Paypal Payments Received </header>
                  <section class="panel panel-default">
                  <header class="panel-heading bg-light">
                    <ul class="nav nav-tabs nav-justified">
                      <li class="active"><a href="#home" data-toggle="tab">Payment Details</a></li>
                       
                    </ul>
                  </header>
                  <div class="panel-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="home">
					  
					  
					  <div class="panel-body">
                    
					  

            
        
             
              <div class="table-responsive">
                <table class="table table-striped m-b-none" data-ride="datatables">
                  <thead>
                    <tr>
                     
                      <th width="10%">Payment Id</th>
					  <th width="15%">Paypal Transaction Id</th>
                      <th width="15%"> Total Payment Received</th>
                      <th width="15%">Payment Date</th>
					  <th width="8%">Payment By (Username)</th>
					  <th width="15%">Package Taken</th>
					  <th width="15%">Status</th>
					  <th width="50%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				   $q="SELECT * FROM  paypalpayments where cod=1 ORDER BY id DESC"; 
 
 
 $r123 = mysqli_query($con,$q);

while($ro = mysqli_fetch_array($r123))
{
	
	$pid="$ro[id]";
	$poid="$ro[orderid]";
	$ptransac="$ro[transacid]";
	$ppaypalprice="$ro[price]";
	$pcur="$ro[currency]";
	$pdate="$ro[date]";
	
				  
 $query="SELECT * FROM  affiliateuser where Id=$poid "; 
 
 
 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$id="$row[Id]";
	$username="$row[username]";
	$fname="$row[fname]";
	$email="$row[email]";
	$mobile="$row[mobile]";
	$active="$row[active]";
	$doj="$row[doj]";
	$country="$row[country]";
	$ear="$row[tamount]";
	$ref="$row[referedby]";
	$pck="$row[pcktaken]";
	$lprofile="$row[launch]";
	if($active==1)
	{
	$status="Active/Paid";
	}
	else if($active==0)
	{
	$status="UnActive/Unpaid";
	}
	else
	{
	$status="Unknown";
	}
	
	$qu="SELECT * FROM  packages where id = $pck"; 
 
 
 $re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))
{
	$pckid="$r[id]";
	$pckname="$r[name]";
	$pckprice="$r[price]";
	$pcktax="$r[tax]";
	$pckcur="$r[currency]";
	$pcksbonus="$r[sbonus]";
  }
	$total=$pckprice+$pcktax;
  print "<tr>
				  
				  <td>
				  $pid
				  </td>
				  <td>
				  $ptransac
				  </td>
				  <td>
				  $pcur $ppaypalprice
				  </td>
				  <td>
				  $pdate
				  </td>
				  
				  <td>
				  $username
				  </td>
				  
				  <td>
				  <b>$pckname </b> <br/> $total $pckcur<br/> Signup Bonus - $pcksbonus
				  </td>
				  <td>
				  $status
				  </td>
				  
				  
				  <td>
				  <a href='deleteuser.php?username=$username' class='btn btn-default btn-sm'>Delete User</a> <br> 
				  <a href='updateuser.php?username=$username' class='btn btn-default btn-sm'>Edit User</a> <br/>
				  ";
				  
				 if($lprofile==0)
	{
	print "<a href='launchprofile.php?username=$username' class='btn btn-default btn-sm'>Launch Account</a>";
	}	  
				  
	if($active==1)
	{
	print "<a href='deactivateuser.php?username=$username' class='btn btn-default btn-sm'>De-Activate</a>";
	}
	if($active==0)
	{
	print "<a href='activateuser.php?username=$username' class='btn btn-default btn-sm'>Activate</a>";
	}
				  
		print"		  </p>
				  </td>
				  
				  </tr>";
  
  }
  }
  ?>
				  
                  </tbody>
                </table>
              </div>
        
          
                    
                    
                  </div>
					  
					  </div>


                      
                    </div>
                  </div>
                </section>
                </section>
                
              </div>
            </div>
          </section>
        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>
    </section>
  </section>
</section>
<!-- Bootstrap -->
<!-- App -->
<script src="js/app.v1.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/app.plugin.js"></script>
</body>
</html>