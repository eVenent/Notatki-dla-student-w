<!DOCTYPE html>
<html lang="pl">

<head>

	<?php include('header.php'); ?>

<title>Notatki dla studentów | Biblioteka</title>

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
					
                        <h1 style="font-variant: small-caps;">Biblioteka</h1>
                        <p>Lista notatek, które są udostępnione publicznie przez naszych użytkowników.</p>
						

<?php
  include 'wyswietlacz.php';
  echo zajecia(algorytmy,"Algorytmy i struktury danych", 1);
  echo zajecia(architektura,"Architektura komputerów", 1);
  echo zajecia(bazydanych,"Bazy danych", 1);
  echo zajecia(rachunek,"Rachunek prawdopodobieństwa i statystyka matematyczna", 1);
  echo zajecia(fizyka,"Fizyka", 1);
  echo zajecia(angielski,"Język angielski", 1);
  echo zajecia(logika,"Logika", 1);
  echo zajecia(matematyka,"Matematyka", 1);
  echo zajecia(ochrona,"Ochrona własności intelektualnej", 1);
  echo zajecia(eie,"Podstawy elektrotechniki i elektroniki", 1);
  echo zajecia(ppk,"Podstawy programowania komputerów", 1);
  echo zajecia(sieci,"Sieci komputerowe", 1);
  echo zajecia(ti,"Technologia informacyjna", 1);
  echo zajecia(wprowadzenie,"Wprowadzenie do zarządzania projektami", 1);
  echo zajecia(wyzwania,"Wyzwania bezpieczeństwa państwa w XXI wieku", 1);
  echo zajecia(zasady,"Zasady realizacji projetków", 1);
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
