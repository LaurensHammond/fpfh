<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}


$album=$_POST['album'];
$obrazek=$_POST['obrazek'];
require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else
	{
		if($album=='')
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania nazwy ALBUMU !!!<br/></span>';
		header('Location:galeria_album.php');
		}
		else
		{
			$sql="SELECT * FROM galeria WHERE Album='$album'";
			if($rezultat = $polaczenie->query($sql))
				{
					$wiersz=$rezultat->fetch_assoc();
					$ile = $wiersz['ile'];
								  if ($_FILES['obrazek']['error'] > 0)
								  {
									echo 'problem: ';
									switch ($_FILES['obrazek']['error'])
									{
									  // jest większy niż domyślny maksymalny rozmiar,
									  // podany w pliku konfiguracyjnym
									  case 1: {$_SESSION['blad']= '<br/>Rozmiar pliku jest zbyt duży.'; break;} 
									  
									  // jest większy niż wartość pola formularza 
									  // MAX_FILE_SIZE
									  case 2: {$_SESSION['blad']= '<br/>Rozmiar pliku jest zbyt duży.'; break;}
									  
									  // plik nie został wysłany w całości
									  case 3: {$_SESSION['blad']= '<br/>Plik wysłany tylko częściowo.'; break;}
									  
									  // plik nie został wysłany
									  case 4: {$_SESSION['blad']= '<br/>Nie wysłano żadnego pliku.'; break;}
									  
									  // pozostałe błędy
									  default: {$_SESSION['blad']= '<br/>Wystąpił błąd podczas wysyłania.';
										break;}
									}
									header('Location: galeria_album.php');
								  }
								  else
								  {
										if ($_FILES['obrazek']['type'] != 'image/jpeg')
										{
											$_SESSION['blad1']= '<br/> Wymaga się podania pliku z rozszeżeniem .jpeg !';
										}
										else
										{		

$nazwa=$album.$ile.'.jpeg';

												$lokalizacja = "./Galeria/$album/$nazwa";
									
												  if(is_uploaded_file($_FILES['obrazek']['tmp_name']))
												  {
													if(!move_uploaded_file($_FILES['obrazek']['tmp_name'], $lokalizacja))
													{
													  $_SESSION['blad1']= '<br/>Problem: Nie udało się skopiować pliku do katalogu333.'; 
													}
													else 
													{	
													$ile2 = $ile + 1;
													$sql_2="UPDATE `funpolfilmhist`.`galeria` SET `ile` = '$ile2' WHERE `galeria`.`Album` = '$album';";
													if($rezultat2 = $polaczenie->query($sql_2))
													$_SESSION['dodano']= '<br/><span style="color:#238E23;">Zdjęcie zapisano pomyślnie</span>';
													else
													$_SESSION['blad1']= "<br/>Problem: Nie udało się skopiować pliku do katalogu222. Ile = $ile Ile2 = $ile2";
													}
												  }
												  else
												  {
													$_SESSION['blad']= '<br/>Problem: Możliwy atak podczas przesyłania pliku. Plik nie został zapisany';
												  }
										}
								  }							

				}
				else
				$_SESSION['blad1']= '<br/>Problem: Nie udało się skopiować pliku do katalogu111.';
	$polaczenie->close();
		
		}
	}
	
header('Location: galeria_album.php');

?>

