<html>
	<head>
		<title>SPACE INVADERS</title>
		<script type="text/javascript">
			var gameScreen;
			var output;
			var ship;
			// declare enemies array
			var enemies = new Array();
			var gameTimer;

			var leftArrowDown = false;
			var rightArrowDown = false;

			const GS_WIDTH = 800;
			const GS_HEIGHT = 600;
			
			// Add bg1 and bg2
			var bg1,bg2;
			const BG_SPEED=4;
			//declare bullets
			var bullets;
			
			// hit detection
			function hittest(a,b){
				var aW = parseInt(a.style.width);
				var aH=parseInt(a.style.height);
				// center points
				var aX=parseInt(a.style.left)+aW/2;
				var aY = parseInt(a.style.top)+aH/2;
				//radius of object
				var aR = (aW +aH)/4;
				
				var bW =parseInt(b.style.width);
				var bH= parseInt(b.style.height);
				// center point of object B
				var bX=parseInt(b.style.left)+bW/2;
				var bY = parseInt(b.style.top)+bH/2;
				
				//avg
				var bR=(bW + bH)/4;
				
				var minDistance = aR + bR;
				var cXs = (aX -bX)*(aX - bX);
				var cYs = (aY - bY)*(aY-bY);
				var distance = Math.sqrt(cXs+cYs);
				
				if(distance < minDistance){
					return true;
				}
				else{
					return false;
				}
				
			}
			function explode(obj){
				var explosion = document.createElement('IMG');
				explosion.src='img/explosion.gif?x='+Date.now();
				explosion.className='gameObject';
				explosion.style.width=obj.style.width;
				explosion.style.height=obj.style.height;
				explosion.style.left=obj.style.left;
				explosion.style.top=obj.style.top;
				gameScreen.appendChild(explosion);
			}
			function init(){
				gameScreen = document.getElementById('gameScreen');
				gameScreen.style.width = GS_WIDTH + 'px';
				gameScreen.style.height = GS_HEIGHT + 'px';
				
				// background implementation
				////cst336/Homework/Homework_4/img/bg.jpg
				bg1 = document.createElement('IMG');
				bg1.className='gameObject';
				bg1.src='img/bg.jpg';
				bg1.style.width ='800px';
				bg1.style.height='1422px';
				bg1.style.left='0px';
				bg1.style.top='0px';
				gameScreen.appendChild(bg1);
				// bg2 implementation
				bg2 = document.createElement('IMG');
				bg2.className='gameObject';
				bg2.src='img/bg.jpg';
				bg2.style.width ='800px';
				bg2.style.height='1422px';
				bg2.style.left='0px';
				bg2.style.top='-1422px';
				gameScreen.appendChild(bg2);
				//bullets implementation
				bullets=document.createElement('DIV');
				bullets.className='gameObject';
				bullets.style.width = gameScreen.style.width;
				bullets.style.height = gameScreen.style.height;
				bullets.style.left='0px';
				bullets.style.top='0px';
				gameScreen.appendChild(bullets);
				
				output = document.getElementById('output');

				ship = document.createElement('IMG');
				ship.src = 'img/ship.gif';
				ship.className = 'gameObject';
				ship.style.width = '68px';
				ship.style.height = '68px';
				ship.style.top = '500px';
				ship.style.left = '366px';

				gameScreen.appendChild(ship);
	
				// enemies implementation
				for(var i=0; i < 10; i++){
					var enemy = new Image();
					enemy.className='gameObject';
					enemy.style.width='64px';
					enemy.style.height='64px';
					enemy.src='img/enemyShip.gif';
					gameScreen.appendChild(enemy);
					placeEnemyShip(enemy);
					enemies[i]=enemy;
				}
				gameTimer = setInterval(gameloop, 50);
			}
			// placement for enemy function
			function placeEnemyShip(e){
				e.speed= Math.floor(Math.random()*10)+6;
				var maxX= GS_WIDTH - parseInt(e.style.width);
				var newX= Math.floor(Math.random()*maxX);
				e.style.left=newX +'px';
				
				var newY= Math.floor(Math.random()*600)-1000;
				e.style.top = newY+'px';
			}
			function gameloop(){
			// continously movement of background implementation
			var bgY = parseInt(bg1.style.top)+BG_SPEED;
			if(bgY>GS_HEIGHT){
				bg1.style.top=-1* parseInt(bg2.style.height)+'px';
			}
			else{
				bg1.style.top=bgY+'px';
			}
			bgY=parseInt(bg2.style.top)+BG_SPEED;
			if(bgY >GS_HEIGHT){
				bg2.style.top=-1 * parseInt(bg2.style.height)+'px';
			}
			else{
				bg2.style.top=bgY +'px';
			}
				if(leftArrowDown){
					var newX = parseInt(ship.style.left);
					if(newX > 0) ship.style.left = newX - 20 + 'px';
					else ship.style.left = '0px';
				}

				if(rightArrowDown){
					var newX = parseInt(ship.style.left);
					var maxX = GS_WIDTH - parseInt(ship.style.width);
					if(newX <  maxX) ship.style.left = newX + 20 + 'px';
					else ship.style.left = maxX + 'px';
				}
				// bullet movement implementation
				var b= bullets.children;
				var end =false;
				for(var i=0; i < b.length;i++){
					var newY = parseInt(b[i].style.top)-b[i].speed;
					if(newY<0){
						bullets.removeChild(b[i]);
					}
					else{
						b[i].style.top=newY+'px';
						for(var j=0; j <enemies.length;j++){
							if(hittest(b[i],enemies[j])){
								bullets.removeChild(b[i]);
								explode(enemies[j]);
								placeEnemyShip(enemies[j]);
								break;
							}
						}
					}
				}
			//	output.innerHTML=b.length;
				for(var i=0; i < enemies.length;i++){
				var newY = parseInt(enemies[i].style.top);
					if(newY > GS_HEIGHT){
					placeEnemyShip(enemies[i]);	
					}
					else{
						enemies[i].style.top=newY+enemies[i].speed+'px';
					}
					if(hittest(enemies[i],ship)){
						explode(ship);
						explode(enemies[i]);
						ship.style.top='-1000px';
						placeEnemyShip(enemies[i]);
					}
				}
			}
			// fire function implementation
			function fire(){
				var bulletWidth=4;
				var bulletHeight=10;
				var bullet = document.createElement('DIV');
				bullet.className='gameObject';
				bullet.style.backgroundColor='yellow';
				bullet.style.width=bulletWidth;
				bullet.style.height=bulletHeight;
				bullet.speed=20;
				bullet.style.top=parseInt(ship.style.top) - bulletHeight+ 'px';
				var shipX = parseInt(ship.style.left)+parseInt(ship.style.width)/2;
				bullet.style.left=(shipX - bulletWidth/2)+'px';
				bullets.appendChild(bullet);
			}
			
			// fire functionality implementation
			document.addEventListener('keypress',function(event) {
			    if(event.charCode==32){
			    	fire();
			    }
			})

			document.addEventListener('keydown', function(event){
				if(event.keyCode==37) leftArrowDown = true;
				if(event.keyCode==39) rightArrowDown = true;
			});

			document.addEventListener('keyup', function(event){
				if(event.keyCode==37) leftArrowDown = false;
				if(event.keyCode==39) rightArrowDown = false;
			});

		</script>
		<style>
			#gameScreen{
				position: relative;
				background-color: silver;
				overflow: hidden;
			}

			.gameObject{
				position: absolute;
				z-index: 1;
			}
			body{
				background-image:url("img/space.jpg");;
				display: block;
			    margin: auto;
			    width: 50%;
			    overflow-x:hidden;
			}
			h1{
				font-family: 'Press Start 2P', cursive;
				text-align:center;
				color:white;
				font-size:4em;
			}
			#buddy{
			position:absolute;
			bottom: 150px;
			right: 0;
			width: 200px;
			height: 100px;
			}
			#btn{
				display: block;
			    margin: auto;
			    width: 40%;
			}
		</style>
		<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body onload="init()">
		<header>
			<h1>SPACE INVADERS</h1>
		</header>
		<div id="gameScreen"></div>
		<div id="output">
			<br>
			<button type="button" id='btn'class="btn btn-success">Play Again</button>
			<script>
				$("#btn").on("click",function(){
				location.reload();	
				});
			</script>
		</div>
		<div id='buddy'>
			<script type="text/javascript">
					var elem = document.createElement("IMG");
					elem.src='img/buddy_verified.png';
					document.getElementById("buddy").appendChild(elem);
			</script>
		</div>
	</body>
</html>
