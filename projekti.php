<?php

session_start();
$_SESSION['Sadala']='Projekti';

// datubāzes konekcija
include('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>


<body>
    <?php include('nav.php'); ?>
    <div class="Atstarpe"></div>
    <form class="Saturs Saturs_Smalks" method="post">
    <?php
    
    if (isset($_POST['Apskatit'])) {
        $ID_Projekts = $_POST['Apskatit'];
        mysqli_set_charset($Datu_Baze,"utf8");
        // Projekta datu iegūšana
        $Pieprasijums = "SELECT * FROM projekts WHERE ID_Projekts='$ID_Projekts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Projekts = mysqli_fetch_assoc($Rezultats);
        if($Projekts){
        ?>
        <div class="Smalks_Pilns">
            <h1><?php echo $Projekts['Nosaukums']; ?></h1>
            <p class="apraksts"><?php echo $Projekts['Apraksts']; ?></p>
        </div>
            
        <?php 
        // Projekta datu iegūšana
        $Pieprasijums = "SELECT * FROM dalibnieks WHERE ID_Projekts='$ID_Projekts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        if($Rezultats){
            while($Dalibnieks = mysqli_fetch_assoc($Rezultats)){
                echo "
                    <div><h3>".$Dalibnieks['Vards'] ." ". $Dalibnieks['Uzvards']."</h3><p class='apraksts'>".$Dalibnieks['Apraksts']."</p>
                    </div>";
            }
        }
            
            
            
        ?>
        <div class="Smalks_Pilns Vizualizesanai">
            <h1>Vieta kur būs datu filtrēšana un attēlošana</h1>
            
        </div>
        
        
        
        
    <?php
    }else{
        echo "Neizdevās atrast izvēlēto projektu, mēģiniet vēlreiz";
    }
    }else{
        
        mysqli_set_charset($Datu_Baze,"utf8");
        $Pieprasijums = "SELECT * FROM projekts WHERE VaiPublisks=1";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($projekts = mysqli_fetch_assoc($Rezultats)){
            echo "
            <div class='Projekts Konta_teksts Projekts_Izstiepts'>
                <h3>" . $projekts['Nosaukums'] . "</h3>
                <p>".$projekts['Apraksts_Iss']."
                <br><br><button class='konts_poga' type='submit' name='Apskatit' value=".$projekts['ID_Projekts'].">Apskatīt projektu</button></p>
            </div>";
        }
    }
    ?>
        
</form>
        

</body>
    
</html>
