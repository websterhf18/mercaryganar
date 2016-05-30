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
$upid = mysqli_real_escape_string($con,$_POST['upackage']);
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>General Settings</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
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
                  <li  class="active"> <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-lab icon"> </i> <span class="font-bold">Website Configuration</span> </a>
                    <ul class="nav dk">
                      <li  class="active"> <a href="gensettings.php" class="auto"> <i class="i i-dot"></i> <span>General Settings</span> </a> </li>
                      
                      
                      
                      <li > <a href="pacsettings.php" class="auto"> <i class="i i-dot"></i> <span>Packages Settings</span> </a> </li>
                      
                    </ul>
                  </li>
                  
                  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="i i-grid2 icon"> </i> <span class="font-bold">Blog</span> </a>
                    <ul class="nav dk">
                      <li > <a href="notifications.php" class="auto"><i class="i i-dot"></i> <span>Post Notifications</span> </a> </li>
                      
                    </ul>
                  </li>
				  <li > <a href="#" class="auto"> <span class="pull-right text-muted"> <i class="i i-circle-sm-o text"></i> <i class="i i-circle-sm text-active"></i> </span> <i class="fa fa-info-circle"> </i> <span class="font-bold">Analytics</span> </a>
                    <ul class="nav dk">
                      <li > <a href="users.php" class="auto"><i class="i i-dot"></i> <span>Users</span> </a> </li>
                     <li > <a href="payments.php" class="auto"><i class="i i-dot"></i> <span>Paypal Payment Received </span> </a> </li>
					  <li > <a href="paymentscod.php" class="auto"><i class="i i-dot"></i> <span>C.O.D Orders </span> </a> </li>
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
            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b> Enter 0 to disable the referral level. <b>3.</b> All amounts should be in integer (1) not decimal (1.0).</p>
          </header>
          <section class="scrollable wrapper">
            <div class="row">
              
              <div class="col-sm-12 portlet">
                <section class="panel panel-success portlet-item">
                  <header class="panel-heading"> General Settings </header>
                  <section class="panel panel-default">
                  <header class="panel-heading bg-light">
                    <ul class="nav nav-tabs nav-justified">
                      <li class="active"><a href="#home" data-toggle="tab"> Settings</a></li>
                      <?php 
					  
					  $query="SELECT * FROM  packages where id=$upid"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	
	$pname="$row[name]";
	$pdetail="$row[details]";
	$pprice="$row[price]";
	$pcurid="$row[currency]";
	$pckmpay="$row[mpay]";
	$pcktax="$row[tax]";
	$pcksbonus="$row[sbonus]";
	$pckactive="$row[active]";
	$p1="$row[level1]";
	$p2="$row[level2]";
	$p3="$row[level3]";
	$p4="$row[level4]";
	$p5="$row[level5]";
	$p6="$row[level6]";
	$p7="$row[level7]";
	$p8="$row[level8]";
	$p9="$row[level9]";
	$p10="$row[level10]";
	$p11="$row[level11]";
	$p12="$row[level12]";
	$p13="$row[level13]";
	$p14="$row[level14]";
	$p15="$row[level15]";
	$p16="$row[level16]";
	$p17="$row[level17]";
	$p18="$row[level18]";
	$p19="$row[level19]";
	$p20="$row[level20]";
	$validity="$row[validity]";
	}
					  
					  ?>  
                    </ul>
                  </header>
                  <div class="panel-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="home">
					  
					  
					  <div class="panel-body">
                    <form action="updatepcksettings.php" method="post">
					 <input type="hidden" value="<?php print $upid ?>" name="pckmainid">
					<div class="form-group">
                        <label>Package Active Status | 0 means unactive and 1 means active</label>
                        <input type="text" value="<?php print $pckactive ?>" class="form-control" placeholder="Enter Package Name" name="pckact">
                      </div>
                      <div class="form-group">
                        <label>Package Name</label>
                        <input type="text" value="<?php print $pname ?>" class="form-control" placeholder="Enter Package Name" name="pckname">
                      </div>
                      <div class="form-group">
                        <label>Package Details</label>
                        <input type="textarea" value="<?php print $pdetail ?>" class="form-control" placeholder="Intro of package" name="pckdetail">
                      </div>
					  
					  <div class="form-group">
                        <label>Package Price ( Only Number )</label>
                        <input type="text" value="<?php print $pprice ?>" class="form-control" placeholder="Like 10,20" name="pckprice" >
                      </div>
					  
<div class="form-group">
                        <label>Package Tax( Only Number )</label>
                        <input type="text" value="<?php print $pcktax ?>" class="form-control" placeholder="Like 10,20" name="pcktax" >
                      </div>

<div class="form-group">
                        <label>Minimum Payout For User ( Only Number )</label>
                        <input type="text" value="<?php print $pckmpay ?>" class="form-control" placeholder="User should earn minimum this money to send payment request, Like 50 or 100 and should not be 0" name="pckmpay" >
                      </div>
					  
					   <div class="form-group">
                        <label>Signup Bonus( Only Number )</label>
                        <input type="text" value="<?php print $pcksbonus ?>" class="form-control" placeholder="User will receive bonus amount after signup. Like 10,20 or 0 to disable" name="pcksbonus" >
                      </div>
					  
					  <div class="form-group">
					  <label>
            Select Currency : 
		  <select name="currency">
		  
		  <?php $query="SELECT id,name,code FROM  currency"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$id="$row[id]";
	$curname="$row[name]";
	$curcode="$row[code]";
	
  print "<option value='$curcode'>$curname - $curcode </option>";
  
  }
  ?>
 
</select>
</label> 

<div class="form-group">
                        <label>Level 1 ( Only Number )</label>
                        <input type="text" value="<?php print $p1 ?>" class="form-control" placeholder="Like 10,20" name="lev1">
                      </div>
					  <div class="form-group">
                        <label>Level 2 ( Only Number )</label>
                        <input type="text" value="<?php print $p2 ?>" class="form-control" placeholder="Like 10,20" name="lev2">
                      </div>
					  <div class="form-group">
                        <label>Level 3 ( Only Number )</label>
                        <input type="text" value="<?php print $p3 ?>" class="form-control" placeholder="Like 10,20" name="lev3">
                      </div>
					  <div class="form-group">
                        <label>Level 4 ( Only Number )</label>
                        <input type="text" value="<?php print $p4 ?>" class="form-control" placeholder="Like 10,20" name="lev4">
                      </div>
					  <div class="form-group">
                        <label>Level 5 ( Only Number )</label>
                        <input type="text" value="<?php print $p5 ?>" class="form-control" placeholder="Like 10,20" name="lev5">
                      </div>
					  <div class="form-group">
                        <label>Level 6 ( Only Number )</label>
                        <input type="text" value="<?php print $p6 ?>" class="form-control" placeholder="Like 10,20" name="lev6">
                      </div>
					  <div class="form-group">
                        <label>Level 7 ( Only Number )</label>
                        <input type="text" value="<?php print $p7 ?>" class="form-control" placeholder="Like 10,20" name="lev7">
                      </div>
					  <div class="form-group">
                       <label>Level 8 ( Only Number )</label>
                        <input type="text" value="<?php print $p8 ?>" class="form-control" placeholder="Like 10,20" name="lev8">
                      </div>
					  <div class="form-group">
                        <label>Level 9 ( Only Number )</label>
                        <input type="text" value="<?php print $p9 ?>" class="form-control" placeholder="Like 10,20" name="lev9">
                      </div>
					  <div class="form-group">
                        <label>Level 10 ( Only Number )</label>
                        <input type="text" value="<?php print $p10 ?>" class="form-control" placeholder="Like 10,20" name="lev10">
                      </div>
					  <div class="form-group">
                        <label>Level 11 ( Only Number )</label>
                        <input type="text" value="<?php print $p11 ?>" class="form-control" placeholder="Like 10,20" name="lev11">
                      </div>
					  <div class="form-group">
                        <label>Level 12 ( Only Number )</label>
                        <input type="text" value="<?php print $p12 ?>" class="form-control" placeholder="Like 10,20" name="lev12">
                      </div>
					  <div class="form-group">
                        <label>Level 13 ( Only Number )</label>
                        <input type="text" value="<?php print $p13 ?>" class="form-control" placeholder="Like 10,20" name="lev13">
                      </div>
					  <div class="form-group">
                       <label>Level 14 ( Only Number )</label>
                        <input type="text" value="<?php print $p14 ?>" class="form-control" placeholder="Like 10,20" name="lev14">
                      </div>
					  <div class="form-group">
                        <label>Level 15 ( Only Number )</label>
                        <input type="text" value="<?php print $p15 ?>" class="form-control" placeholder="Like 10,20" name="lev15">
                      </div>
					  <div class="form-group">
                       <label>Level 16 ( Only Number )</label>
                        <input type="text" value="<?php print $p16 ?>" class="form-control" placeholder="Like 10,20" name="lev16">
                      </div>
					  <div class="form-group">
                       <label>Level 17 ( Only Number )</label>
                        <input type="text" value="<?php print $p17 ?>" class="form-control" placeholder="Like 10,20" name="lev17">
                      </div>
					  <div class="form-group">
                        <label>Level 18 ( Only Number )</label>
                        <input type="text" value="<?php print $p18 ?>" class="form-control" placeholder="Like 10,20" name="lev18">
                      </div>
					  <div class="form-group">
                       <label>Level 19 ( Only Number )</label>
                        <input type="text" value="<?php print $p19 ?>" class="form-control" placeholder="Like 10,20" name="lev19">
                      </div>
					  
					  <div class="form-group">
                       <label>Level 20 ( Only Number )</label>
                        <input type="text" value="<?php print $p20 ?>" class="form-control" placeholder="Like 10,20" name="lev20">
                      </div>
					  <div class="form-group">
                       <label>Renew Day(s) ( Only Number )</label>
                        <input type="text" value="<?php print $validity ?>" class="form-control" placeholder="Enter '0' for no expiry or enter no of days like 30 (1 month), 60 (2 months), 365 (1 year) - This would be the expiry date for user account" name="renewdays">
                      </div>
					  
					  
					  
					  
					  
</div>
                      
                     <button type="submit" class="btn btn-lg btn-primary btn-block">I Have Filled And Checked All Details. Update/Edit Details For Me Now.</button>
                    </form>
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