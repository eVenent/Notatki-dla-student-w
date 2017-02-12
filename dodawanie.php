<p>
						<div id="sample">
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  <form action="dodaj.php" method="post"> 
  <input name="tytul" class="title" type="text" placeholder="Twój tytuł nowej notatki" />
  <p>Bez obaw! Obszar roboczy będzie się rozszerzał wraz z pisaniem.</p>
  <textarea name="area2" style="width: 100%; height: 200px;">
Treść notatki.
</textarea>

<br /><div style="float: right"><input type="submit" class="btn btn-default" id="menu-zaloguj" value="Zapisz" /> </form></div>

<div>Czy notatka ma być publiczna?
<select name="publiczny">
  <option value="nie">Nie</option>
  <option value="tak">Tak</option>
</select></div>

<div>Kategoria:
<select name="kategoria">
  <option value="Algorytmy i struktury danych">Algorytmy i struktury danych</option>
  <option value="Architektura komputerów">Architektura komputerów</option>
  <option value="Bazy danych">Bazy danych</option>
  <option value="Rachunek prawdopodobieństwa i statystyka matematyczna">Rachunek prawdopodobieństwa i statystyka matematyczna</option>
  <option value="Fizyka">Fizyka</option>
  <option value="Inżynieria oprogramowania">Inżynieria oprogramowania</option>
  <option value="Język angielski">Język angielski</option>
  <option value="Logika">Logika</option>
  <option value="Matematyka">Matematyka</option>
  <option value="Ochrona własności intelektualnej">Ochrona własności intelektualnej</option>
  <option value="Podstawy elektrotechniki i elektroniki">Podstawy elektrotechniki i elektroniki</option>
  <option value="Podstawy programowania komputerów">Podstawy programowania komputerów</option>
  <option value="Sieci komputerowe">Sieci komputerowe</option>
  <option value="Technologia informacyjna">Technologia informacyjna</option>
  <option value="Wprowadzenie do zarządzania projektami">Wprowadzenie do zarządzania projektami</option>
  <option value="Wyzwania bezpieczeństwa państwa w XXI wieku">Wyzwania bezpieczeństwa państwa w XXI wieku</option>
  <option value="Zasady realizacji projetków">Zasady realizacji projetków</option>
</select></div>

<div>Udostępnij notatkę użytkownikom: <input type="text" class="share" name="share" placeholder="użytkowników oddzielaj przecinkami" /></div> 
</div></p>

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
	$ins = @mysql_query("INSERT INTO notatki (autor, tytul, tresc, data, publiczny, dostep, kategoria) VALUES ('".$_SESSION['login']."', '$tytul', '$tresc', '$data', '$publiczny', ', $share,', '$kategoria')"); 

	$id = mysql_insert_id(); 

	if($ins) echo "Wyświetl swoją  <a href='notatka.php?id=".$id."'>notatkę</a>"; 
    else echo "Błąd nie udało się dodać nowego rekordu"; 
     
    mysql_close($connection); 
} 

?>