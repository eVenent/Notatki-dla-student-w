<!DOCTYPE html>
<html lang="pl">

<head>

	<?php include('header.txt'); ?>

<title>Notatki dla studentów | Strona główna</title>

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
                        
<h1>Rejestracja</h1>						
						
<p>
<form method="POST" class="logowanie" action="rejestracja.php">
<b>Login:</b> <input type="text" name="login"><br>
<b>Hasło:</b> <input type="password" name="haslo1"><br>
<b>Powtórz hasło:</b> <input type="password" name="haslo2"><br>
<b>Email:</b> <input type="text" name="email"><br>
<input type="submit" value="Zarejestruj" name="loguj">
</form> 

<?php
mysql_connect("localhost","root","");
mysql_select_db("test");

function filtruj($zmienna) 
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); // usuwamy slashe

	// usuwamy spacje, tagi html oraz niebezpieczne znaki
    return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
}

if (isset($_POST['loguj'])) 
{
	$login = filtruj($_POST['login']);
	$haslo1 = filtruj($_POST['haslo1']);
	$haslo2 = filtruj($_POST['haslo2']);
	$email = filtruj($_POST['email']);
	$ip = filtruj($_SERVER['REMOTE_ADDR']);
	
	// sprawdzamy czy login nie jest już bazie
	if (mysql_num_rows(mysql_query("SELECT login FROM uzytkownicy WHERE login = '".$login."';")) == 0) 
	{
		if ($haslo1 == $haslo2) // sprawdzamy czy hasła takie same
		{
			mysql_query("INSERT INTO `uzytkownicy` (`login`, `haslo`, `email`, `rejestracja`, `logowanie`, `ip`)
				VALUES ('".$login."', '".md5($haslo1)."', '".$email."', '".time()."', '".time()."', '".$ip."');");

			echo "Konto zostaԯ utworzone!";
		}
		else echo "Hasła nie są takie same";
	}
	else echo "Podany login jest już zajęte.";
}
?>

<?php mysql_close(); ?>

						</p>
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
