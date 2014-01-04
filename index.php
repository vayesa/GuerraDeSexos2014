<?php
	session_start();
	require('api/twitteroauth.php');
	define('CONSUMER_KEY','ppwlup1XhJ4ADOOEf2AyQ');
	define('CONSUMER_SECRET', 'qoi6CflFVZB2Ix4NDHGU84LqfjwjaaXoNb1Iac4mLM');
	define('OAUTH_CALLBACK', 'http://lalala.es/lab/');
	if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
     $noconectado = 1;
	}
	//$accesstoken = '2238010110-shQMUbxr76JenBoyWbXCcr2lXYCI3nbToqMBjaq';
	//$accesstokensecret = 'VEjWouVS7JD0qcaplYvtR32aBqJzMUtdZh4ioGTLoVB21';
	$access_token = $_SESSION['access_token'];

	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	/* Build an image link to start the redirect process. */
	
		$content = '<a href="redirect.php"><img src="images/lighter.png" alt="Sign in with Twitter"/></a>'; 
	
	/* SACAMOS LOS DATOS */
	try{
	$bd = 'bczwqhrn_guerra';
	$user = 'bczwqhrn_guerra';
	$pass = '291160';
	$conn = new PDO('mysql:host=localhost;dbname=bczwqhrn_guerra', $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$result_chicas = $conn->query('SELECT count(id) FROM usuarios WHERE sexo = "Chica"');	
	$result_chicos = $conn->query('SELECT count(id) FROM usuarios WHERE sexo = "Chico"');	
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessage();
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>#GuerraDeSexos2014 - El Mayor Reto Fitness del Mundo</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="js/globalize.min.js"></script>
<script src="js/dx.chartjs.js"></script>
<script src="js/dx.module-core.js"></script> <!-- required -->
<script src="js/dx.module-viz-core.js"></script> <!-- required -->
<script src="js/dx.module-viz-charts.js"></script> <!-- dxChart -->
<script src="js/dx.module-viz-gauges.js"></script> <!-- dxCircularGauge and dxLinearGauge -->
<link rel="stylesheet" href="css/main.css" type="text/css" />

 
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
 
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
</head>
 
<body id="index" class="home">
	<input type="hidden" id="fChicas" value="<?php foreach ($result_chicas as $chicas){
			echo $chicas[0];
			}
		?>">
	<input type="hidden" id="fChicos" value="<?php foreach ($result_chicos as $chicos){
			echo $chicos[0];
			}
		?>">
	<header id="banner" class="body">
	<h1><a href="./index.php">#GuerraDeSexos2014 <strong>¡El mayor reto <i>fitness</i> del mundo!</strong></a></h1>
 
	<nav><ul>
		<li class="active"><a href="#">home</a></li>
		<li><a href="#">¡Participa!</a></li>
	</ul></nav>
</header><!-- /#banner -->
<section id="contenido" class="body">
	
			<div class='entrar'><?php print_r($content); ?></div>
		
	<div class="chicas sidebar">
		<h2 class="chicastitulo">Chicas</h2>
		<p>
			<a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> <a href="#">@Valen</a> 
		</p>
	</div>
	<div class="reto">
		<div id="chartContainer" style="max-width:300px;height: 400px;"></div>
		<small>Actualizado en tiempo real.</small>
		<div class="partner">
			<h2>Patrocinadores</h2>
			<img src="http://nutrimas.es/image/data/nutrimas-logo.png" alt="Nutrición Deportiva" />
		</div>
		<div class="partner">
			<h2>Timeline</h2>
			<a class="twitter-timeline" href="https://twitter.com/search?q=%23GuerraDeSexos2014" data-widget-id="410050314281041920">Tweets sobre "#GuerraDeSexos2014"</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div>
	<div class="chicos sidebar">
		<h2 class="chicostitulo">Chicos</h2>
		
	</div>
</section>
<script>
var chicas = $('#fChicas').val();
var chicos = $('#fChicos').val();
//alert(chicos);
//alert(chicas);
var dataSource = [
    {sexo:'Chicos', population:parseInt(chicos)},
    {sexo:'Chicas', population:parseInt(chicas)}
];
 
$(function () {
    $("#chartContainer").dxPieChart({
        dataSource: dataSource,
        series: {
            argumentField: 'sexo',
            valueField: 'population',
            border: { visible: false }
        },
        title: 'Situación Global',
       	tooltip: {
            enabled: true,
            customizeText: function (point) {
                return point.percentText;
            },
            percentPrecision: 1
            },
        legend: { visible: false }
    });
});
</script>
</body>
</html>