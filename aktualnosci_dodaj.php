<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}
if((!isset($_POST['title'])) || (!isset($_POST['contents'])) || (!isset($_POST['you'])) || (!isset($_POST['photo'])))
	{
		header('Location:aktualnosci_mod1.php');
		exit();
	}



	$tytul = $_POST['title'];
	$foto = $_POST['photo'];
	$tresc = $_POST['contents'];
	$yt = $_POST['you'];
	
	if($yt == '&lt;iframe...&gt;&lt;/iframe&gt;')
		$yt='';
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
	if(($tytul=='')||($tresc=='')||($tresc=='Treść wpisu...'))
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania co najmniej &nbsp;&nbsp; TYTUŁU &nbsp; i &nbsp; TREŚCI &nbsp;&nbsp; wpisu !!!<br/></span>';
		header('Location:aktualnosci_mod1.php');
		}
		else
		{
			$sql="SELECT * FROM aktualnosci WHERE Tytul='$tytul'AND Data='$dzisiaj'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wpisow=$rezultat->num_rows;
				if($ile_wpisow==0)
				{		
						$dzis=date("Y m d");
						if($foto=='')
						$sql_2 = "INSERT INTO `funpolfilmhist`.`aktualnosci` (`ID`, `Tytul`, `Data`, `Tresc`, `Foto`, `YouTube`) VALUES (NULL, '$tytul', CURDATE(), '$tresc', NULL, '$yt');";
						else
						{
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

								  }
								  else
								  {
										if (($_FILES['obrazek']['type'] != 'image/jpeg')&&($_FILES['obrazek']['type'] != 'image/png'))
										{
											$_SESSION['blad']= '<br/> Wymaga się podania pliku z rozszeżeniem .jpeg lub .png!';
										}
										else
										{
												$lokalizacja = "C:/xampp/htdocs/funpolfilmhist/aktualnosci_zdj/$foto";
									
												  if(is_uploaded_file($_FILES['obrazek']['tmp_name']))
												  {
													if(!move_uploaded_file($_FILES['obrazek']['tmp_name'],$lokalizacja))
													{
													  $_SESSION['blad']= '<br/>Problem: Nie udało się skopiować pliku do katalogu.'; 
													}
													else $_SESSION['blad']= '<br/>Obrazek zapisany pomyślnie';
												  }
												  else
												  {
													$_SESSION['blad']= '<br/>Problem: Możliwy atak podczas przesyłania pliku. Plik nie został zapisany';
												  }
										}
								  }
								  
						$sql_2 = "INSERT INTO `funpolfilmhist`.`aktualnosci` (`ID`, `Tytul`, `Data`, `Tresc`, `Foto`, `YouTube`) VALUES (NULL, '$tytul', CURDATE(), '$tresc', '$foto', '$yt');";
						}
						if($dodaj=$polaczenie->query($sql_2))
						{
						
						$_SESSION['dodano']='<span style="color:#238E23;">Wpis został dodany! </span>';
						header('Location:panel.php');}
						else
						{
						$_SESSION['dodano']='<span style="color:red;">Nie udało się! </span>';
						header('Location:panel.php');}
					
				}
				else
				{
					
					$_SESSION['blad2']='<span style="color:red;">Post o takim tytule i dacie istnieje już w bazie.<br/></span>';
					header('Location:aktualnosci_mod1.php');

				}
			}
			$polaczenie->close();
		
		}
	}

?>

