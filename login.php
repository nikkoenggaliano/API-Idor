<?php
include 'koneksi.php'; 
if(isset($_POST['un']) && isset($_POST['pw'])){

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
  $name = mysqli_real_escape_string($conn, $_POST['un']);
  $pwpw = pp(pconv($_POST['pw']));

  $query = "SELECT * FROM `user` where username = '".$name."' and password = '".$pwpw."'";
  $exec = mysqli_query($conn,$query);  

// var_dump($query,$exec);exit;
#var_dump(mysqli_num_rows($exec));exit;
  if(mysqli_num_rows($exec) != 0){
    $data = mysqli_fetch_array($exec);
    $_SESSION['id']   = $data['id'];
    $_SESSION['name'] = $data['name'];
    $_SESSION['role'] = $data['role']; 
    header("location: index.php");
    exit;
  }else{

    header("location: login.php?status=fail");

  }

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Do</title>
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
<?php 
  
  if(isset($_GET['status']) and $_GET['status'] == 'fail'){
    echo '<script>alert("Login gagal! Username atau Password Salah!");</script>';
  }

?>
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
		    <h2 class="text-center">Login Now</h2>
		    <form class="login-form" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" name="un" class="form-control" placeholder="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" name="pw" class="form-control" placeholder="">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <a href="regis.php">Register Here Dog</a>
    </label>
    <button type="submit" class="btn btn-login float-right">Login</button>
  </div>
  
</form>
  </div>
    </div>
    </div>
</section>
</body>
</html>