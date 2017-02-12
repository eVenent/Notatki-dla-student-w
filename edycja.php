<!DOCTYPE html>
<html lang="pl">

<head>

	<?php include('header.txt'); ?>

<title>Notatki dla studentów | Dodaj notatkę</title>

</head>

<body>

    <div id="wrapper">

		<?php include('sidebar.php'); ?>

<?php
session_start();
mysql_connect("localhost","root","");
mysql_select_db("test");
?>

<?php
if (isset($_GET['wyloguj'])==1) 
{
	$_SESSION['zalogowany'] = false;
	session_destroy();
}
?>
		
        <!-- Treść -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
				
				<div style="float: right;">
				
				<?php if ($_SESSION['zalogowany']==true){echo '<a href="?wyloguj=1" class="btn btn-default" id="menu-zaloguj">Wyloguj</a>';}?>
				<?php if ($_SESSION['zalogowany']==false){echo '<a href="index.php" class="btn btn-default" id="menu-zaloguj">Zaloguj</a>';}?>
 				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">☰</a></div>
                    <div class="col" style="margin-top: -16px; margin-right: 15px; margin-left: 15px; z-index: -1">

<p>
						<div id="sample">

<?php
    // łączymy się z bazą danych 
    $connection = @mysql_connect('localhost', 'root', '') 
    or die('Brak połączenia z serwerem MySQL'); 
    $db = @mysql_select_db('test', $connection) 
    or die('Nie mogę połączyć się z bazą danych'); 
	
/* zapytanie do konkretnej tabeli */ 
if ($_SESSION['zalogowany']==true) {$sesja = $_SESSION['login'];};
if ($_SESSION['zalogowany']==false) {$sesja = niezalogowanyuzytkownik;};
$wynik = mysql_query("SELECT * FROM notatki WHERE id='".$_GET['id']."'") 
or die('Błąd zapytania');
$autoryzacja = mysql_query("SELECT * FROM notatki WHERE id='".$_GET['id']."' AND autor='$sesja'")
or die('Błąd zapytania');

/* 
wyświetlamy wyniki, sprawdzamy, 
czy zapytanie zwróciło wartość większą od 0 
*/ 
if(mysql_num_rows($autoryzacja) > 0) {
if(mysql_num_rows($wynik) > 0) { 
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */ 
    while($r = mysql_fetch_assoc($wynik)) { 
	
echo "	  <form action='edycja.php' method='post'>";
echo "  <input name='tytul' class='title' type='text' value='".$r['tytul']."' />";
echo "  <p>Bez obaw! Obszar roboczy będzie się rozszerzał wraz z pisaniem.</p>";
echo "  <textarea name='area2' style='width: 100%; height: 200px;'>";
echo "<p>".$r['tresc']."</p>";
echo "</textarea>";

echo "<div>Czy notatka ma być publiczna?";
echo "<select name='publiczny'>";
echo "  <option value='nie'>Nie</option>";
echo "  <option value='tak'>Tak</option>";
echo "</select></div>";

echo "<div>Kategoria:";
echo "<select name='kategoria'>";
echo "  <option value='Algorytmy i struktury danych'>Algorytmy i struktury danych</option>";
echo "  <option value='Architektura komputerów'>Architektura komputerów</option>";
echo "  <option value='Bazy danych'>Bazy danych</option>";
echo "  <option value='Rachunek prawdopodobieństwa i statystyka matematyczna'>Rachunek prawdopodobieństwa i statystyka matematyczna</option>";
echo "  <option value='Fizyka'>Fizyka</option>";
echo "  <option value='Inżynieria oprogramowania'>Inżynieria oprogramowania</option>";
echo "  <option value='Język angielski'>Język angielski</option>";
echo "  <option value='Logika'>Logika</option>";
echo "  <option value='Matematyka'>Matematyka</option>";
echo "  <option value='Ochrona własności intelektualnej'>Ochrona własności intelektualnej</option>";
echo "  <option value='Podstawy elektrotechniki i elektroniki'>Podstawy elektrotechniki i elektroniki</option>";
echo "  <option value='Podstawy programowania komputerów'>Podstawy programowania komputerów</option>";
echo "  <option value='Sieci komputerowe'>Sieci komputerowe</option>";
echo "  <option value='Technologia informacyjna'>Technologia informacyjna</option>";
echo "  <option value='Wprowadzenie do zarządzania projektami'>Wprowadzenie do zarządzania projektami</option>";
echo "  <option value='Wyzwania bezpieczeństwa państwa w XXI wieku'>Wyzwania bezpieczeństwa państwa w XXI wieku</option>";
echo "  <option value='Zasady realizacji projetków'>Zasady realizacji projetków</option>";
echo "</select></div>";

echo "<div>Udostępnij notatkę użytkownikom: <input type='text' class='share' name='share' placeholder='użytkowników oddzielaj przecinkami' /></div>";
echo "<div style='float: right; margin-top: -50px;'><input type='submit' class='btn btn-default' id='menu-zaloguj' value='Zapisz' /> </form></div>";
echo "</div></p>";
    } 
}
else {
	echo "<h1>:(</h1>";
	echo "Notatka nie istnieje lub została usunięta.";
}
}
else {
	echo "<h1>:(</h1>";
	echo "Nie masz dostępu do tej notatki.";
}

?>
						
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>


						<?php 
// odbieramy dane z formularza 
$tytul = $_POST['tytul']; 
$tresc = $_POST['area2']; 
$share = $_POST['share']; 
$publiczny = $_POST['publiczny']; 
$kategoria = $_POST['kategoria']; 
$data = date('j.m.Y, G:i');


if($tytul and $tresc and $_SESSION['zalogowany']==true) { 
     
    // łączymy się z bazą danych 
    $connection = @mysql_connect('localhost', 'root', '') 
    or die('Brak połączenia z serwerem MySQL'); 
    $db = @mysql_select_db('test', $connection) 
    or die('Nie mogę połączyć się z bazą danych'); 
     
    // dodajemy rekord do bazy 
	$ins = @mysql_query("UPDATE notatki (autor, tytul, tresc, data, publiczny, dostep, kategoria) VALUES ('".$_SESSION['login']."', '$tytul', '$tresc', '$data', '$publiczny', ', $share,', '$kategoria') WHERE id='".$_GET['id']."'"); 
    
    mysql_close($connection); 
} 

?>					
						
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include('footer.php'); ?>

</body>

</html>