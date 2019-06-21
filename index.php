<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.col-md-3{
			max-height: 500px;
			background: #00000063;
			width: 95%;
			border-radius: 5px;
			overflow: hidden;
		}
		.col-md-9{
			background: #00000063;
			border-radius: 5px;
			width: 100%;
		}
		#row1 .col-md-9 {
			background: none;
		}
		.row {

			display: grid;
			grid-template-columns: 1fr 4fr ;
		}
		#cx {

			display: grid;
			grid-template-columns: repeat(6, 1fr);
			text-align: center;
			padding-top: 5px;
		}
		body{
			height: 100%; 

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		#row2{
			min-height: 100px;
		}
		#row1{
			margin-bottom: 15px;
			min-height: 500px;
			max-height: 500px;
		}
		.container{
			max-height: 760px;
			min-width: 760px
		}
		.sl{
			margin: 0 15%;
		}
		.scmt{
			padding: 7px;
			border-bottom: 1px solid white;
		}
		#cmt{
			margin: 5px 0px 0px 10px;
			padding: 5px;
		}
		iframe{
			border-radius:5px;
		}
	</style>
	<title>CODE LIVESTREAM</title>
</head>
<body>
	<div class="container">     
		<div class="row" id="row1">
			<div class="col-md-3" >
				
			</div>
			<div class="col-md-9" >
				
			</div>
		</div>
		<div class="row" id="row2">
			<div class="col-md-3" >
				<div class="cmt" style="display: grid;grid-template-columns: 1fr 1fr ;" > 
					<div class="cmt1"><input type="text" id="cmt" ></div>
					<img src="./img/send.png" alt="" height="30px" style="cursor: pointer;margin: 5px 0 0 7px;" onclick="comment()">
				</div>
				<a href="./change.php" target="_blank"><button style="text-align: center; margin: 10px; cursor: pointer;">thay đổi</button></a>
			</div>
			<div class="col-md-9" >
				<div id="cx">
					<label>
						<img src="./img/LIKE.7b593078.gif" height="60px">
						<div id="like" class="sl"></div>
					</label>
					<label>
						<img src="./img/LOVE.801526e1.gif" height="60px">
						<div id="love" class="sl"></div>
					</label>
					<label>
						<img src="./img/HAHA.7c8dac3b.gif" height="60px">
						<div id="haha" class="sl"></div>
					</label>
					<label>
						<img src="./img/WOW.9baf7e7f.gif" height="60px"  >
						<div id="wow" class="sl"></div>
					</label>
					<label>
						<img src="./img/SAD.447909ad.gif" height="60px" >
						<div id="sad" class="sl"></div>
					</label>
					<label>
						<img src="./img/ANGRY.16f6c102.gif" height="60px">
						<div id="angry" class="sl"></div>
					</label>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		var token="";
		var id="";
		var link="";
		$.ajax({
			url:"./data.json",
			type:"GET",
			dataType:"JSON",
			success:(data)=>{
				var link=data[0].link;
				token=data[0].token;
				id=data[0].id;
				bg=data[0].bg;
				$("body").css('background-image','url("'+bg+'")');
				$(" #row1 .col-md-9").empty().html('<iframe width="98%" height="98%"src="https://www.youtube.com/embed/'+link+'"></iframe>');
				getlive(token,id);

			}
		})
		var id_f="";
		function getlive(token,id){
			setInterval(function(

				){
				$.ajax({
					url:"https://graph.facebook.com/"+id+"/comments?limit=5000&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						
						if(id_f!=data.data[data.data.length-1].id){
							$("#row1 .col-md-3").empty().html("");
							for(var i=data.data.length-1;i>0;i--){

								var name=data.data[i].from.name;
								var comment=data.data[i].message;
								$("#row1 .col-md-3").append('<div class="scmt"><strong style="color:red">'+name+': </strong><p style="display: contents;color: white; font-size:14pt">'+comment+'</p></div>');
							}
						}
						id_f=data.data[data.data.length-1].id;
					}
				})
				var rc=[];
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(LIKE).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var like= data.reactions.summary.total_count;
						$("#like").empty().html('<strong style="color: #71ff71;">'+like+'</strong>');
						
					}
				})
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(LOVE).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var love= data.reactions.summary.total_count;
						$("#love").empty().html('<strong style="color: #71ff71;">'+love+'</strong>');
						
					}
				})
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(HAHA).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var haha= data.reactions.summary.total_count;
						$("#haha").empty().html('<strong style="color: #71ff71;">'+haha+'</strong>');
						
					}
				})
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(WOW).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var wow= data.reactions.summary.total_count;
						$("#wow").empty().html('<strong style="color: #71ff71;">'+wow+'</strong>');
						
					}
				})
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(SAD).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var sad= data.reactions.summary.total_count;
						$("#sad").empty().html('<strong style="color: #71ff71;">'+sad+'</strong>');
						
					}
				})
				$.ajax({
					url:"https://graph.facebook.com/"+id+"?fields=reactions.type(ANGRY).limit(0).summary(1)&access_token="+token,
					type:"GET",
					dataType:"JSON",
					success:(data)=>{
						var angry= data.reactions.summary.total_count;
						$("#angry").empty().html('<strong style="color: #71ff71;">'+angry+'</strong>');
					}
				})

			}, 3000);

		}
		function comment(){
			var mess=$("#cmt").val();
			$.ajax({
				url:"https://graph.facebook.com/"+id+"/comments?message="+mess+"&method=POST&access_token="+token,
				success:(data)=>{
					$(".cmt1").empty().html('<input type="text" id="cmt" >');
				}
				
			})
		}
	</script>
</body>
</html>