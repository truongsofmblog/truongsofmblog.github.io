<?php
$file=file_get_contents("./data.json");
$data=json_decode($file,true);
$t=$data[0]["token"];
$i=$data[0]["id"];
$l=$data[0]["link"];
$bg=$data[0]["bg"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>THAY ĐỔI CẤU HÌNH</title>
</head>
<body>
	<div class="container">
		<h2>facebook</h2>
		<form action="" method="POST">
			<div class="form-group">
				<label for="email">Token:</label>
				<input type="text" class="form-control" id="email" value="<?php echo $t;?>" name="token">
			</div>
			<div class="form-group">
				<label for="pwd">IDFB:</label>
				<input type="text" class="form-control" id="pwd" value="<?php echo $i;?>" name="idfb">
			</div>
			<div class="form-group">
				<label for="pwd">LINK VIDEO:</label>
				<input type="text" class="form-control" id="pwd" value="<?php echo "https://www.youtube.com/watch?v=".$l;?>" name="idytb">
			</div>
			<div class="form-group">
				<label for="pwd">Link image:</label>
				<input type="text" class="form-control" id="pwd" value="<?php echo $bg;?>" name="bg">
			</div>
			<button type="submit" name="submit" class="btn btn-primary">LIVE STREAM</button>
		</form>
	</div>
	<?php
	$ar=[];
	if (isset($_POST["submit"])) {
		$bg=$_POST["bg"];
		$token= $_POST["token"];
		$id=$_POST["idfb"];
		$link= $_POST["idytb"];
		$link=strstr($link, "=");
		$link=str_replace("=", "", $link);
		$ar[0]=["token"=>$token,"id"=>$id,"link"=>$link,"bg"=>$bg];
		file_put_contents("./data.json", json_encode($ar));
		echo "<script> location.replace('./index.php');</script>";
	}

	?>
</body>
</html>