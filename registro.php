<?php
	session_start();
	require_once('api/twitteroauth.php');
	define('CONSUMER_KEY','ppwlup1XhJ4ADOOEf2AyQ');
	define('CONSUMER_SECRET', 'qoi6CflFVZB2Ix4NDHGU84LqfjwjaaXoNb1Iac4mLM');
	define('OAUTH_CALLBACK', 'http://lalala.es/lab/registro.php');

	/* If the oauth_token is old redirect to the connect page. */
	if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
	  $_SESSION['oauth_status'] = 'oldtoken';
	  header('Location: ./clearsessions.php');
	}

	/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	/* Request access tokens from twitter */
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

	/* Save the access tokens. Normally these would be saved in a database for future use. */
	$_SESSION['access_token'] = $access_token;

	/* Remove no longer needed request tokens */
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);

	/* If HTTP response is 200 continue otherwise send to connect page to retry */
	if (200 == $connection->http_code) {
	  $content = $connection->get('account/verify_credentials');
	} else {
	  /* Save HTTP status for error dialog on connnect page.*/
	  header('Location: ./clearsessions.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>#GuerraDeSexos2014 - El Mayor Reto Fitness del Mundo</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
 
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
</head>
 
<body id="index" class="home">
	<header id="banner" class="body">
	<h1><a href="./index.php">#GuerraDeSexos2014 <strong>¡El mayor reto <i>fitness</i> del mundo!</strong></a></h1>
 
	<nav><ul>
		<li class="active"><a href="#">home</a></li>
		<li><a href="#">¡Participa!</a></li>
	</ul></nav>
</header><!-- /#banner -->
<section id="contenido" class="body">
	<h2>¡Completa el último paso!</h2>
	<div class="success">Twitter no nos da información sobre si eres chico o chica, por eso es muy importante que completes el <b>último paso</b>.</div>
	<form name="registro" id="registro" method="POST" enctype="multipart/form-data" action="funciones/registro.php">
		<label for="usuario"></label>
			<input type="text" class="texto" name="usuario" id="usuario" value="<?php echo $content->screen_name
?>" readonly="readonly">
		<label for="sexo">¿A qué equipo perteneces?</label>
			<select name="sexo" class="texto" style="font-size: 20pt;" id="sexo">
				<option value="Chico">Chico</option>
				<option value="Chica">Chica</option>
			</select>
		<input type="submit" class="botonentrar" value="¡PARTICIPAR!" />
	</form>
</section>
</body>
</html>