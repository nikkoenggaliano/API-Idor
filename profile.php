<?php 

include 'koneksi.php';
if(!isset($_SESSION['id']))
	{exit;}


if(isset($_GET['solve'])){
	#$final = "";
	$open = file_get_contents("solver.txt");
	$exp = explode("\n", $open);
	// foreach($exp as $val){
	// 	$final .= $val."\n";
	// }
	echo json_encode($exp);
	// echo $final;
}


if(isset($_POST['data'])){
	$query = "SELECT * from user where id='".$_POST['data']."'";
	$exec = mysqli_query($conn,$query);
	if($exec && mysqli_num_rows($exec) == 1){
		$data = mysqli_fetch_array($exec);
		$res = array(
			"respon" => 200,
			"name" => $data['name'],
			"username" => $data['username'],
			"role" => $data['role'],
			"password" => $data['password']
 		);
 		 echo json_encode($res);

	}else{
		$res = array(
			"respon" => 404
		);
		 echo json_encode($res);
	}
}