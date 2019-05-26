<?php include('konts_pieslegties_parbaude.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <?php include('nav.php');
    if(isset($_SESSION['E_Pasts'])){
        echo "<div class='Atstarpe'></div><div class='Saturs Saturs_Smalks'>";
        include('konts_nav.php');
        switch($_GET['Saturs']){
        case 1: include 'konts_filtri.php'; break;
        case 2: include 'konts_projekti.php'; break;
        case 21: include 'konts_pievienot_projektu.php'; break;
        case 22: include 'konts_labot_projektu.php'; break;
        case 3: include 'konts_iestatijumi.php'; break;
        default: include 'konts_filtri.php';
        
        }
        echo "</div>";
    }else{
        include('konts_pieslegties.php');
    } ?>        
        
</body>
    
</html>
