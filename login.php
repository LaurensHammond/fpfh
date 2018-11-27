<?php 
session_start();
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
{	header('Location: panel.php');
	exit();
}
?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
<title>Fundacja Polskiego Filmu Historycznego</title>
	<meta charset="utf-8"/>
	<meta name="description" content="Fundacja Polskiego Filmu Historycznego"/>
	<meta name="keywords" content=""/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="Shortcut icon" href="flaga2.png" />
	<link rel="stylesheet" href="style.css" type="text/css"/> 
	<link href='http://fonts.googleapis.com/css?family=Akronim&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=New+Rocker|Ruslan+Display|Marck+Script|Patrick+Hand+SC|Limelight|Lobster|Shojumaru|Russo+One|Racing+Sans+One|Great+Vibes|Arbutus|Kaushan+Script|Courgette|Black+Ops+One|Freckle+Face|Titan+One|Bowlby+One+SC|Kavoon|Sancreek&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px|Open+Sans+Condensed:300|Poiret+One|Inconsolata|Josefin+Sans|Abril+Fatface|Source+Code+Pro:700,400|Limelight|Sacramento|Herr+Von+Muellerhoff|Cutive+Mono|Pirata+One|Diplomata|Work+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="logo">
	<div id="nazwa">
	<a href="index.php">
		Fundacja<br/>
		Polskiego<br/>
		Filmu<br/>
		Historycznego
	</a>
	</div>
<div id="flag"><img src="flaga3.png" width=100% height="100%"/></div>
</div>
<div class="belt">
<div class="beltmenu">
<form action="logowanie.php" method="post">
<div class="cliche" style="font-size:36px;">Login:</div>
<div class="cliche" style="font-size:36px; padding-top:35px; height:60px;"><input type="text" name="login"></input></div>
<div class="cliche" style="font-size:36px;">Hasło:</div>
<div class="cliche" style="font-size:36px;padding-top:35px; height:60px;"><input type="password"  name="haslo"></input></div>
<div class="cliche" style="font-size:36px;padding-top:35px; height:60px;"><input type="submit" value="Zaloguj"></input></div>
</form>
<div style="clear:both;"></div>
</div>
<?php
	if(isset($_SESSION['blad']))
	echo $_SESSION['blad'];
	unset($_SESSION['blad']);
?>
</div>

<div id="footer">
<div class="footer1"><img src="podpis.png" width=100% /></div>
<div class="footer2">2015 &copy. Fundacja Polskiego Filmu Historycznego</div>
<div class="footer1"><img src="podpis.png" width=100% /></div>
<div style="clear:both;"></div>
</div>


	
	
	
	
	<script src="jquery-1.11.3.min.js"></script>
	<script>
	$(document).ready(function() {
	var NavY = $('.belt').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.belt').addClass('sticky');
	} else {
		$('.belt').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
	
	</script>
	
</body>
</html>