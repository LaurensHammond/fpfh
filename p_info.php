<?php
session_start();

if (!isset($_SESSION['admin']))
{	header('Location: login.php');
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
<h1><center>Niezbędne informacje</center></h1>
	
	<div class="akt">
	<h2>Aktualności:</h2>
	Dane związane z wpisem w sekcji "Aktualności" zostaną zapisane w bazie danych w tabeli 'aktualnosci'.
	<br/><br/><br/>
	Aby dodać zdjęcie w sekcji "Aktualności" należy podać nazwę z właściwym rozszerzeniem oraz wybrać plik. Zostanie on zapisany w katalogu "aktualności_zdj".
	<br/><br/><br/>
	Aby zamieścić film z serwisu YouTube należy pobrać z tego serwisu znacznik umieszczony pod filmem -> Udostępnij -> Umieść na stronie... <br/>
	<br/><center><img src="znacznik.png" width="50%"/><center><br/><br/><br/><br/>
	
	</div>
	<div class="akt">
	<h2>Sekcje bez możliwości modyfikacji:</h2>
	Aby mnienić treść w sekcji "Strona główna" oraz "O fundacji" należy wstawić je w plikach tekstowych kolejno:<br/>- index.php<br/>- opis.php<br/>
	Treść powinna być zapisana zgodnie z zasadami kodu html.<br/><br/><br/>
	</div>
	
	<div class="akt">
	<h2>Partnerzy:</h2>
	Dane związane z wpisem w sekcji "Partnerzy" zostaną zapisane w bazie danych w tabeli 'partnerzy'.
	<br/><br/><br/>
	Zdjęcie w sekcji "Partnerzy" należy umieścić w katalogu "partnerzy_zdj". Nazwa zdjęcia powinna być zgodna z nazwą podaną w formularzu dodawania.<br/><br/><br/>
	</div>
	
	<div class="akt">
	<h2>Galeria:</h2>
	Wszystkie zdjęcia dodawane do Galerii muszą mieć rozszerzenie .JPEG	<br/><br/><br/>
	Aby dodać zdjęcie należy najpierw utworzyć album za pomocą fomularza.
	<br/><br/><br/>
	Zdjęcia można dodawać też do istniejących już albumów.<br/><br/><br/>
	Nie można usunąć pojedyńczego zdjęcia. Możliwe jest tylko usunięcie całego albumu.<br/><br/><br/>
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