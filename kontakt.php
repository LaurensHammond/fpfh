<?php
session_start();
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
	<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
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
<div class="cliche" style="background-image:none;"></div>
<div class="cliche"><a href="opis.php">O Fundacji</a></div>
<div class="cliche"><a href="partnerzy.php">Partnerzy<a/></div>
<div class="cliche"><a href="galeria.php">Galeria<a/></div>
<div class="cliche"><a href="kontakt.php">Kontakt</a></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="container">
	<div id="menu1">
	<div class="kafel" style="background-image:url('kafel/kafel1.png')"><a href="aktualnosci.php">Aktualności</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel2.png')"><a href="opis.php">O Fundacji</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel3.png')"><a href="kontakt.php">Kontakt</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel4.png')"><a href="statut.php">Statut</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel5.png')"><a href="partnerzy.php">Partnerzy</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel6.png')"><a href="galeria.php">Galeria</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel7.png')"><a href="sprawozdania.php">Sprawozdania</a></div>
	</div>
	<div id="main">  
	<h1><center>Kontakt</center></h1>
<?php
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
{
echo "<a href='kontakt_mod1.php'>[------- + DODAJ KONTAKT -----]</a>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='kontakt_mod2.php'>[------- - USUŃ KONTAKT -------]</a><br/>";	
}
?>	


	<div class="akt" style="marin-top:0;padding-top:0;">
	<h2>Dane do korespondencji</h2>
<?php
	require_once"baza.php";
	
	$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane. pierwszy if";
	}
	else	
	{
		$sql = "SELECT * FROM kontakt WHERE Kat='korespondencja' ORDER BY Waga";
		if($rezultat = $polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;

			for($i=0;$i<$ile_postow;$i++)
			{	
				$sql2 = "SELECT * FROM kontakt WHERE Kat='korespondencja' ORDER BY Waga LIMIT 1 OFFSET $i";
				
					if($rezulat2=$polaczenie->query($sql2))
					{
					$ile_gile = $rezultat2->num_rows;
					$wiersz=$rezulat2->fetch_assoc();
					$naglowek = $wiersz['Naglowek'];
					$dane = $wiersz['Dane'];

					echo "<span style='font-size:23px;'>$naglowek: ";
					echo "$dane </span><br/>";
					}
					else
					{
						echo "Sorry memory";
					}
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane. zła kwerenda";
		}


	$polaczenie->close();
	}
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
echo <<< END
<form action="kontakt_edit.php" method="post">
	<input type="hidden" name="kat" value="korespondencja" />
	<font style="float:right;"><input type="submit" value="EDYTUJ"/></font><br/>
</form>
END;
?>
	</div>	
	
	<div class="akt" style="marin-top:0;padding-top:0;">	
	<h2>Dane do wpłat</h2>
<?php
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "SELECT * FROM kontakt WHERE Kat='wpłaty' ORDER BY Waga";
		if($rezultat = @$polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;
			for($i=0;$i<$ile_postow;$i++)
			{	
				$sql2 = "SELECT * FROM kontakt  WHERE Kat='wpłaty' ORDER BY Waga LIMIT 1 OFFSET $i";
				
					if($rezulat2=$polaczenie->query($sql2))
					{
					$ile_gile = $rezultat2->num_rows;
					$wiersz=$rezulat2->fetch_assoc();
					$naglowek = $wiersz['Naglowek'];
					$dane = $wiersz['Dane'];

					echo "<span style='font-size:23px;'>$naglowek: ";
					echo "$dane </span><br/>";
					}
					else
					{
						echo "Sorry memory";
					}
					
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane";
		}


	$polaczenie->close();
	}
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
echo <<< END
<form action="kontakt_edit.php" method="post">
	<input type="hidden" name="kat" value="wplaty" />
	<font style="float:right;"><input type="submit" value="EDYTUJ"/></font><br/>
</form>
END;
?>	
	
	</div>	
	<div class="akt" style="marin-top:0;padding-top:0;">
	<h2>Informacje o fundacji</h2>
<?php
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "SELECT * FROM kontakt WHERE Kat='informacje' ORDER BY Waga";
		if($rezultat = @$polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;
			for($i=0;$i<$ile_postow;$i++)
			{	
				$sql2 = "SELECT * FROM kontakt  WHERE Kat='informacje' ORDER BY Waga LIMIT 1 OFFSET $i";
				
					if($rezulat2=$polaczenie->query($sql2))
					{
					$ile_gile = $rezultat2->num_rows;
					$wiersz=$rezulat2->fetch_assoc();
					$naglowek = $wiersz['Naglowek'];
					$dane = $wiersz['Dane'];

					echo "<span style='font-size:23px;'>$naglowek: ";
					echo "$dane </span><br/>";
					}
					else
					{
						echo "Sorry memory";
					}
					
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane";
		}


	$polaczenie->close();
	}
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
echo <<< END
<form action="kontakt_edit.php" method="post">
	<input type="hidden" name="kat" value="informacje" />
	<font style="float:right;"><input type="submit" value="EDYTUJ"/></font><br/>
</form>
END;
?>
	</div>	
	<div class="akt" style="marin-top:0;padding-top:0;">
<h2>Reprezentacja fundacji</h2>

	<?php

	require_once"baza.php";
	
	$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "SELECT * FROM kontakt WHERE Kat='ludzie' ORDER BY Waga";
		if($rezultat = $polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;
			for($i=0;$i<$ile_postow;$i++)
			{	
				$sql2 = "SELECT * FROM kontakt  WHERE Kat='ludzie' ORDER BY Waga LIMIT 1 OFFSET $i";
				
					if($rezulat2=$polaczenie->query($sql2))
					{
					$ile_gile = $rezultat2->num_rows;
					$wiersz=$rezulat2->fetch_assoc();
					$naglowek = $wiersz['Naglowek'];
					$dane = $wiersz['Dane'];

					echo "<span style='font-size:23px;'>$naglowek: ";
					echo "$dane </span><br/>";
					}
					else
					{
						echo "Sorry memory";
					}
					
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane";
		}


	$polaczenie->close();
	}
if(isset($_SESSION['admin'])&&($_SESSION['admin']==true))
echo <<< END
<form action="kontakt_edit.php" method="post">
	<input type="hidden" name="kat" value="ludzie" />
	<font style="float:right;"><input type="submit" value="EDYTUJ"/></font><br/>
</form>
END;

?>	
	</div>	
	</div>

	<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<div id="footer">
<div class="footer1"><img src="podpis.png" width=100% /></div>
<div class="footer2">2015 &copy. Fundacja Polskiego Filmu Historycznego</div>
<div class="footer1"><img src="podpis.png" width=100% /></div>
<div style="clear:both;"></div>
</div>
<div style="float:right;font-size:15px;"><a href="login.php">Panel administratora_</a></div>

	
	
	
	
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