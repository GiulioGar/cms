<?php
$url=$_REQUEST['urlimg'];
$peso=$_REQUEST['peso'];

if ($peso==""){$peso=0;}

$stringadasostituire=",".$peso."],";

$coord=$_REQUEST['coordinate'];
$coord = str_replace(' ', '', $coord);
$coord = str_replace(']', $stringadasostituire, $coord);


$immagine = $url;
$dimensioni = getimagesize($immagine);
$larghezza = $dimensioni[0];
$altezza = $dimensioni[1];
//echo "Dimensioni immagine: " . $larghezza . "X" . $altezza . " pixel";


?>
<html>
<head>
    
    <style>
        body { text-align: center; font: 16px/1.4 "Helvetica Neue", Arial, sans-serif; }
        a { color: #0077ff; }
        .container { width: <?php echo $larghezza;?>px; height: <?php echo $altezza;?>px; margin: 0 auto; position: relative; border: 1px solid #ccc; }
        .options { position: absolute; top: 0; right: 0; padding: 10px; background: rgba(255,255,255,0.6);
            border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; line-height: 1; }
        .options input { width: 200px; }
        .options label { width: 60px; float: left; text-align: right; margin-right: 10px; color: #555; }
        .ghbtns { position: relative; top: 4px; margin-left: 5px; }
		 canvas { background:url(<?php echo $url;?>) }
    </style>
	
	<script>
	function loadCanvas() {
	//alert("ciao");
	var dataURL="http://www.primisoft.com/fields/GPE/TEST/resources/01_C.jpg";
	var c = document.getElementById('canvas');
	var context = c.getContext('2d');
	
	// load image from data url
	var imageObj = new Image();
	imageObj.onload = function() {
	context.drawImage(this, 0, 0);
	
	};
	
	imageObj.src = dataURL;
	}
	</script>
	
	
</head>
<body>

<div class="container">
    
    <canvas id="canvas" width="<?php echo $larghezza;?>" height="<?php echo $altezza;?>"></canvas>
</div>

<script src="simpleheat.js"></script>

<script>
	
	var data = [
	<?php echo $coord;?>
	];	
	
	
</script>
<script>

	window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
	window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
	
	function get(id) {
		return document.getElementById(id);
	}
	
	var heat = simpleheat('canvas').data(data).max(18),
    frame;
	
	function draw() {
		console.time('draw');
		heat.draw();
		console.timeEnd('draw');
		frame = null;
	}
	
	draw();
	
	
	
	var radius = get('radius'),
    blur = get('blur'),
    changeType = 'oninput' in radius ? 'oninput' : 'onchange';
	
	radius[changeType] = blur[changeType] = function (e) {
		heat.radius(+radius.value, +blur.value);
		frame = frame || window.requestAnimationFrame(draw);
	};

</script>
</body>
</html>
