<?php 
function zajecia($kategoria, $nazwa_kategorii, $public) {
    // łączymy się z bazą danych 
    $connection = @mysql_connect('localhost', 'root', '') 
    or die('Brak połączenia z serwerem MySQL'); 
    $db = @mysql_select_db('test', $connection) 
    or die('Nie mogę połączyć się z bazą danych'); 

/* zapytanie do konkretnej tabeli */ 
if ($public == 0){
$kategoria = mysql_query("SELECT * FROM notatki WHERE kategoria='$nazwa_kategorii' AND (autor='".$_SESSION['login']."' OR dostep LIKE ', %".$_SESSION['login']."%,')")
or die('Błąd zapytania');}
else {
$kategoria = mysql_query("SELECT * FROM notatki WHERE kategoria='$nazwa_kategorii' AND publiczny='tak'")
or die('Błąd zapytania');}


/* 
wyświetlamy wyniki, sprawdzamy, 
czy zapytanie zwróciło wartość większą od 0 
*/ 
if(mysql_num_rows($kategoria) > 0) { 
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */ 
    echo "<div class='categories-headers'>$nazwa_kategorii</div>"; 
    while($r = mysql_fetch_assoc($kategoria)) { 
        echo "<div class='categories-note'>"; 
		echo "<div style='float: right' class='buttons'><a href='edycja.php?id=".$r['id']."'>edytuj</a></div>";
        echo "<b></b><a href='notatka.php?id=".$r['id']."'>".$r['tytul']."</a> // <i>".$r['data']."</i>"; 
        echo "<div>";
		$text = $r['tresc'];
		$text2 = strip_tags($text);
		echo substr($text2, 0, 450);
		echo "...</div>"; 
		echo "</div>";
    } 
    echo "<div class='categories-wrapper'></div>
						<br />"; 						
}
}
?>