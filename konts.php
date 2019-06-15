<?php include('konts_pieslegties_parbaude.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <?php 
    mysqli_set_charset($Datu_Baze,"utf8");
    if(isset($_SESSION['E_Pasts'])){
        $_SESSION['Sadala']='Konts';
        include('nav.php');
        
        echo "<div class='Atstarpe'></div><div class='Saturs Saturs_Smalks'>";
        switch($_GET['Saturs']){
        case 1: $Konts_Izvelets=1; include 'konts_filtri.php'; break;
        case 2: $Konts_Izvelets=2; include 'konts_projekti.php'; break;
        case 21: $Konts_Izvelets=2; include 'konts_pievienot_projektu.php'; break;
        case 22: $Konts_Izvelets=2; include 'konts_labot_projektu.php'; break;
        case 3: $Konts_Izvelets=3; include 'konts_iestatijumi.php'; break;
        case 4: $Konts_Izvelets=4; include 'konts_admin_lietotaji.php'; break;
        case 5: $Konts_Izvelets=5; include 'konts_admin_publicesanai.php'; break;
        case 6: $Konts_Izvelets=6; include 'konts_admin_zinojumi.php'; break;
        default: $Konts_Izvelets=1; include 'konts_filtri.php';
        
        }
        include('konts_nav.php');
        echo "</div>";
    }else{
        $_SESSION['Sadala']='Pieslegties';
        include('nav.php');
        include('konts_pieslegties.php');
    } ?>        
        
</body>
    
</html>
