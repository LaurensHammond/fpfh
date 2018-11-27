<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}

function removeDir($path) {
$dir = new DirectoryIterator($path);
foreach ($dir as $fileinfo) {
if ($fileinfo->isFile() || $fileinfo->isLink()) {
unlink($fileinfo->getPathName());
} elseif (!$fileinfo->isDot() && $fileinfo->isDir()) {
removeDir($fileinfo->getPathName());
}
}
rmdir($path);
}

$album=$_POST['album'];
$dzien=$_POST['dzien'];


require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else
	{
		if(($album=='')||($dzien==''))
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania NAZWY i DATY albumu !!!<br/></span>';
		header('Location:galeria_mod2.php');
		}
		else
		{
			$sql="SELECT * FROM galeria WHERE Album='$album'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wpisow=$rezultat->num_rows;
				if($ile_wpisow!=0)
				{		
						$sql_2 = "DELETE FROM `funpolfilmhist`.`galeria` WHERE Album = '$album' AND Data = '$dzien'";

						if($usun=$polaczenie->query($sql_2))
						{
						$katalog="./Galeria/$album";
						removeDir("$katalog");
						$_SESSION['usunieto']='<span style="color:#238E23;"> Album został usunięty !!! </span>';
						header('Location:galeria_mod2.php');
						}
						else
						{
						$_SESSION['blad1']='<span style="color:red;">Nie udało się usunąć albumu !!! </span>';
						header('Location:galeria_mod2.php');
						}
					
				}
				else
				{
					
					$_SESSION['blad2']='<span style="color:red;">Albumu o takim tytule i dacie nie ma w bazie.<br/></span>';
					header('Location:galeria_mod1.php');
				}
			}
			$polaczenie->close();
		
		}
	}
	


?>

