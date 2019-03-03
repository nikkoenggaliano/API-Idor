<?php 
include 'koneksi.php';
if(isset($_GET['status'])){
  if($_GET['status'] == 1){
    echo '<script>alert("Succes!")</script>';
  }else{
    echo '<script>alert("Error!")</script>';
 
  }
}
if(isset($_POST['pw'])){

  function pconv($data){

    if(strlen($data) % 2 != 0){
      return "A".$data;
    }
  return $data;
}

  function pp($data){
    $len = (int) ( (strlen($data) / 2) );
    $left = substr($data, 0, $len); //MD5
    $right = substr($data, $len); //SHA1
    $ret = md5($left).sha1($right);
  return $ret;
}

  $name = mysqli_real_escape_string($conn, $_POST['nm']);
  $uname = mysqli_real_escape_string($conn, $_POST['un']);
  $pwpw = pp(pconv($_POST['pw']));
  $query = "INSERT INTO `user` (`id`, `name`, `username`, `role`, `password`) VALUES (NULL, '".$name."', '".$uname."', 'user', '".$pwpw."');";

  if(mysqli_query($conn, $query)){
    header("location: ?status=1");
    exit;
  }else{
    header("location: ?status=0");
    exit;
  }

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Here</title>
<style type="text/css">
	.login-block{
float:left;
width:100%;
padding : 50px 0;
}

.container{background:#D3D3D3; border-radius: 10px; width: 40%; height: 40%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #0069c0;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#6ec6ff; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #0069c0; color:#fff; font-weight:600;}
</style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<section class="login-block">
    <div class="container">
	<div class="row ">
		<div class="col login-sec">
		    <h2 class="text-center">Regist Your Account</h2>
<form class="login-form" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Your Name</label>
    <input type="text" name="nm" class="form-control" placeholder="">
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" name="un" class="form-control" placeholder="">
    
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" name="pw" class="form-control" placeholder="">
  </div>
  
    <button type="submit" class="btn btn-login float-right">Submit Gas</button>
  </div>
  
</form>
  </div>
    </div>
    </div>
</section>
</body>
</html>