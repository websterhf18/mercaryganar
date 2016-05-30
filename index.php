<?php
include_once("z_db.php");
$sql="SELECT maintain FROM  settings WHERE sno=0";
		  if ($result = mysqli_query($con, $sql)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        $main= $row[0];
    }
	if($main==1 || $main==3)
	{
	print "
				<script language='javascript'>
					window.location = 'maintain.php';
				</script>
			";
	}

}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']))
{
$status = "OK"; //initial status
$msg="";
	$username=mysqli_real_escape_string($con,$_POST['username']); //fetching details through post method
     $password = mysqli_real_escape_string($con,$_POST['password']);

if ( strlen($username) < 6 ){
$msg=$msg."Su nombre de usuario debe tener mas de 5 caracteres<BR>";
$status= "NOTOK";}

if ( strlen($password) < 6 ){ //checking if password is greater then 8 or not
$msg=$msg."Su contraseña debe tener mas de 5 caracteres<BR>";
$status= "NOTOK";}

if($status=="OK"){

// Retrieve username and password from database according to user's input, preventing sql injection
$query ="SELECT * FROM affiliateuser WHERE (username = '" . mysqli_real_escape_string($con,$_POST['username']) . "') AND (password = '" . mysqli_real_escape_string($con,$_POST['password']) . "') AND (active = '" . mysqli_real_escape_string($con,"1") . "') AND (level = '" . mysqli_real_escape_string($con,"2") . "')";
if ($stmt = mysqli_prepare($con, $query)) {

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* store result */
    mysqli_stmt_store_result($stmt);

    $num=mysqli_stmt_num_rows($stmt);

    /* close statement */
    mysqli_stmt_close($stmt);
}
//mysqli_close($con);
// Check username and password match

if (($num) == 1) {

$sqlquery11="SELECT expiry FROM affiliateuser where username = '$username'"; //fetching expiry date of username from table
$rec211=mysqli_query($con,$sqlquery11);
$row211 = mysqli_fetch_row($rec211);
$expirydate=$row211[0]; //assigning expiry date

$curdate=date("Y-m-d");
if($curdate > $expirydate)
{
	$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Verifique los siguientes errores : </br></strong>Hola usuario, Tu cuenta ha sido desactivada, Dirigete a la seccion de renovar cuenta.</div>"; //printing error if found in validation
				
   $statusflag= "NOTOK";
}
else{

session_start();
        // Set username session variable
        $_SESSION['username'] = $username;
		
        // Jump to secured page
		print "
				<script language='javascript'>
					window.location = 'dashboard.php?page=dashboard%location=index.php';
				</script>"; 
}

}



else{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Verifique los siguientes errores : </br></strong>El nombre de usuario y contraseña no coinciden o tu cuenta esta inactiva.</div>"; //printing error if found in validation
				
}} 
else {
        
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Verifique los siguientes errores : </br></strong>".$msg."</div>"; //printing error if found in validation
				
	 
}
}


?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8" />
<title>GanarMercando</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
<style type="text/css">html {
    overflow-y: scroll;
background: url(images/login2.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>        
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
  <div class="container aside-xl"> <a class="navbar-brand block" href="index.php"><img src="images/icon.png" width="50%"/></a>
    <section class="m-b-lg">
      <header class="wrapper text-center"> <strong style="color:#ffffff;">Ingresa tus datos</strong> </header>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
        <div class="list-group">
		<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
						{
						print $errormsg;
						}
						?>
          <div class="list-group-item">
            <input type="text" placeholder="Nombre de usuario" class="form-control no-border" name="username" required>
          </div>
          <div class="list-group-item">
            <input type="password" placeholder="Contraseña" class="form-control no-border" name="password" required>
          </div>
        </div>
        <button type="submit" class="btn btn-lg btn-success btn-block">Ingresar</button>
        <div class="text-center m-t m-b"><a href="forgotpassword.php"><small style="color:#ffffff;">Olvidaste tu contraseña?</small></a> | <a href="renewaccount.php"><small style="color:#ffffff;">Tu cuenta esta vencida? Renueva aqui</small></a></div>
        <div class="line line-dashed"></div>
        <p class="text-center m-t m-b"><a href="#"><small style="color:#ffffff;">No tienes una cuenta?</small></a></p>
        <a href="signup.php" class="btn btn-lg btn-default btn-block">Crear cuenta</a>
      </form>
    </section>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder">
    <p> <small style="color:#ffffff;"><?php $query="SELECT footer from settings where sno=0"; 
 
 
 $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))
{
	$footer="$row[footer]";
	print $footer;
	}
  ?></small> </p>
  </div>
</footer>
<!-- / footer -->
<!-- Bootstrap -->
<!-- App -->
<script src="js/app.v1.js"></script>
<script src="js/app.plugin.js"></script>
</body>
</html>