<?php
session_start();

if (!isset($_SESSION['admin']))
{	header('Location: aktualnosci.php');
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
<div class="cliche" style="background-image:none;"></div>
<div class="cliche"><a href="index.php">Główna</a></div>
<div class="cliche"><a href="statystyka.php">Statystyka</a></div>
<div class="cliche">
<ol>
Opcje
<ul>
<li><a href="zmiana.php">Zmiana NAZWY i HASŁA</a></li>
<li><a href="p_info.php">Potrzebne informacje</a></li>
<li><a href="koder.php">Kontakt do kodera</li>
</ul>
</ol>
</div>

<div class="cliche"><a href="logout.php">Wyloguj</a></div>

<div style="clear:both;"></div>
</div>
</div>
<div class="container">
	<div id="menu1">
	<div class="kafel" style="background-image:url('kafel/kafel1.png')"><a href="aktualnosci_mod.php">[Aktualności]</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel4.png')"><a href="partnerzy_mod.php">[Partnerzy]</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel5.png')"><a href="galeria.php">[Galeria]</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel6.png')"><a href="kontakt.php">[Kontakt]</a></div>
	<div class="kafel" style="background-image:url('kafel/kafel7.png')"><a href="sprawozdania.php">[Sprawozdania]</a></div>
	</div>
	<div id="main">
	
<?php
	echo '<h2><center>Panel Administratora - Kontakt!</center></h2>';
	if(isset($_SESSION['blad1']))
	echo $_SESSION['blad1'];
	unset($_SESSION['blad1']);
	if(isset($_SESSION['blad2']))
	echo $_SESSION['blad2'];
	unset($_SESSION['blad2']);
	if(isset($_SESSION['blad3']))
	echo $_SESSION['blad3'];
	unset($_SESSION['blad3']);
	
echo<<<END

<h2>Usuwanie Kontaktu</h2>
<form action="kontakt_usun.php" method="post">
Jaki kontakt chcesz usunąć? :<br/>
<select name="naglowek">
END;

	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "SELECT * FROM Kontakt ORDER BY Naglowek";
		if($rezultat = @$polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;
			for($i=0;$i<$ile_postow;$i++)
			{
				$sql2 = "SELECT * FROM Kontakt ORDER BY Naglowek LIMIT 1 OFFSET $i";
				
					$rezulat2=$polaczenie->query($sql2);
					$wiersz=$rezulat2->fetch_assoc();
					$naglowek = $wiersz['Naglowek'];
					echo "<option>$naglowek </option>";
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane";
		}


	$polaczenie->close();
	}
echo '</select><br/>';
echo 'Wartość kontaktu:<br/>';
echo '<select name="dane">';


	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "SELECT * FROM Kontakt ORDER BY Naglowek";
		if($rezultat = @$polaczenie->query($sql))
		{
			$ile_postow = $rezultat->num_rows;
			for($i=0;$i<$ile_postow;$i++)
			{
				$sql2 = "SELECT * FROM Kontakt ORDER BY Naglowek LIMIT 1 OFFSET $i";
				
					$rezulat2=$polaczenie->query($sql2);
					$wiersz=$rezulat2->fetch_assoc();
					$dane = $wiersz['Dane'];
					echo "<option>$dane</option>";
			}
		}
		else
		{   echo "Połącznie z bazą nie może być zrealizowane";
		}


	$polaczenie->close();
	}
echo '</select><br/><br/><input type="submit" value="USUŃ"></input></form>';

?>

	
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
<div style="float:right;font-size:15px;"><a href="login.php">Panel administratora</a></div>

	
	
	
	
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