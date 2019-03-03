<?php
include 'koneksi.php'; 
if(!isset($_SESSION['id'])){
	header("location: login.php");
	exit;
}

$query = "SELECT * FROM user where id = '".$_SESSION['id']."'";
$exec = mysqli_query($conn, $query);
if($exec){
	$data = mysqli_fetch_array($exec);
	if($data['role'] == 'admin'){
		header("location: wr.php");
		exit;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Idor</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	function Profile(){
		const ses = "<?=$_SESSION['id']?>";
		var rs = $.ajax({
			type : "POST",
			url  : "profile.php",
			data : {data:ses},
			success: function(res){
				var obj =  JSON.parse(res);
				if(obj['respon'] != 200){
					alert("Sorry");
					return false;
				}
				$("#Name").append(obj['username']);
				$("#Sname").append("<b>"+obj['name']+"</b>");
				$("#myModal").modal('show');
			}
		})
	}

	function about(){
		$("#about").modal('show');
	}

	function getsolv(){
		var gt = $.ajax({
			type : "GET",
			url  : "profile.php?solve=true",
			success : function(res){
				
			var obj = JSON.parse(res);
			var data = "";
			$.each(obj, function(key, value) {
    			//$("#Solver").append((key+1)+" "+value+"<br>");
				data += (key+1)+" "+value+"<br>";
			});

			$("#Solver").html('');
			$("#Solver").html(data);

			}
		})
	}

	function segar(){
		$("#Solver").html("");
		$("#Solver").html("<img src='flag.jpg'>");
	}

</script>

</head>
<body>
<section class="pt-5 pb-5 bg-dark inner-header">
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="mt-0 mb-3 text-white">Look Our Menu</h1>
			<div class="breadcrumbs">
				<p class="mb-0 text-white"><a class="text-white" href="javascript:Profile()">Your Profile</a> /  <a class="text-white" href="javascript:about()">Our Service</a>  /  <a class="text-white" href="javascript:getsolv()">Solver</a> /  <a class="text-white" href="javascript:segar()">Penyegar Timeline</a> /  <a class="text-white" href="out.php">Log Out</a> </p>
			</div>
		</div>
	</div>
</div>
</section>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="Name">Hello </h4>
        </div>
        <div class="modal-body">
          <p id="Sname">Our site it's still under developing. But please enjoy our feature Dear our lovely member </p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


 <!-- About -->
  <div class="modal fade" id="about" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="Name">Hello </h4>
        </div>
        <div class="modal-body">
          <p id="Sname">Whould you enjoy our music service?</p>
                             <audio controls>
 	 					<source src="flag.mp3" type="audio/mpeg">
					</audio> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div>
	<center>
		<p id="Solver"></p>
	</center>
</div>
</body>
</html>