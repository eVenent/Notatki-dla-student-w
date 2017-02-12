<!DOCTYPE html>
<html lang="pl">

<head>

	<?php include('header.txt'); ?>

<title>Notatki dla studentów | Strona główna</title>

<style>
body {
background-image: url("gfx/background.jpg");
background-repeat: no-repeat;
background-position: center center;
background-attachment: fixed;
}

</style>

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
if ($_SESSION['zalogowany']==true)
{
	echo "<h1 style='font-variant: small-caps;'>Witaj ".$_SESSION['login']."!</h1>";

} else echo "<h1 style='font-variant: small-caps;'>Witaj studencie!</h1>" ?>
                        <p>Sam wiesz, że notatki często są cenniejsze od najcenniejszych skarbów. Nasza strona to klucz do tego skarbca wiedzy. Ułatwi Ci zapisywanie notatek i dzielenie się nimi ze swoim znajomym.</p>
						<br />
						
						<?php include('logowanie.php'); ?>

						
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
