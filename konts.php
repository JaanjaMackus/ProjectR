<?php include('konts_parbaude.php'); ?>

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
        case 1: include 'Saturs_1.php'; break;
        case 2: include 'Saturs_2.php'; break;
        case 3: include 'Saturs_3.php'; break;
        default: include 'Saturs_1.php';
        
        }
        echo "</div>";
    }else{
        include('pieslegties.php');
    } ?>        
        
</body>
    
</html>
