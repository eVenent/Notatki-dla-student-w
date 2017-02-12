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
$autoryzacja = mysql_query("SELECT * FROM notatki WHERE id='".$_GET['id']."' AND (autor='$sesja' OR dostep LIKE ', %".$sesja."%,' OR publiczny='tak')")
or die('Błąd zapytania');

/* 
wyświetlamy wyniki, sprawdzamy, 
czy zapytanie zwróciło wartość większą od 0 
*/ 
if(mysql_num_rows($autoryzacja) > 0) {
if(mysql_num_rows($wynik) > 0) { 
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */ 
    while($r = mysql_fetch_assoc($wynik)) { 
        echo "<h1 style='font-variant: small-caps;'>".$r['tytul']."</h1>"; 
        echo "<p>".$r['tresc']."</p>"; 
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

<?php if ($_SESSION['zalogowany']==true): ?>

<br /><h1 style="font-variant: small-caps;">Komentarze</h1>
<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//flameman.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php endif; ?>
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
