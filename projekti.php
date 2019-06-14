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
    <?php
        
    if(isset($_POST['Publicesana'])){
        echo "<form class='Saturs Saturs_Smalks' method='post'>";
        $ID_Projekts = $_POST['ID_Projekts'];
        if($_POST['Publicesana']=='Noraidit'){
        // Noraida projekta publicesanu
            $Pieprasijums = "UPDATE projekts SET VaiPublisks=0 WHERE ID_Projekts='$ID_Projekts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if(mysqli_affected_rows($Datu_Baze) > 0){
                ?>
                <script type="text/javascript">
                    window.location.href = 'konts.php?Saturs=5';
                </script>
                <?php
                header('Location: konts.php?Saturs=5');
            }else{
                echo "Neizdevās noraidīt projektu";
            }
        }else{
        // Apstiprina projekta publicesanu
            $Pieprasijums = "UPDATE projekts SET VaiPublisks=1 WHERE ID_Projekts='$ID_Projekts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            if(mysqli_affected_rows($Datu_Baze) > 0){
                ?>
                <script type="text/javascript">
                    window.location.href = 'konts.php?Saturs=5';
                </script>
                <?php
                header('Location: konts.php?Saturs=5');
            }else{
                echo "Neizdevās apstiprināt projektu";
            }
        }
        echo "</form>";
    }else if(isset($_POST['Apskatit']) || isset($_GET['Apskatit'])) {
        echo "<div class='Saturs Saturs_Smalks'>";
        if(isset($_POST['Apskatit'])){
            $ID_Projekts = $_POST['Apskatit'];
        }else{
            $ID_Projekts = $_GET['Apskatit'];
        }
        mysqli_set_charset($Datu_Baze,"utf8");
        // Projekta datu iegūšana
        $Pieprasijums = "SELECT * FROM projekts WHERE ID_Projekts='$ID_Projekts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Projekts = mysqli_fetch_assoc($Rezultats);
        if($Projekts){
            if($Projekts['VaiPublisks']==1){
////////////ja ir publisks projekts
                include('projekti_paradit.php');
                ?>
    </div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?> 

</div><?php
        }else{
/////////ja nav publisks projekts
            $E_Pasts = $_SESSION['E_Pasts'];
            mysqli_set_charset($Datu_Baze,"utf8");
            $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            $Lietotajs = mysqli_fetch_assoc($Rezultats);
            if($Lietotajs){
                
                if($Lietotajs['Tiesibas'] == 1){
                    include('projekti_paradit.php');
                    ?>
    </div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?>     
                    <br><br>
                <form method='post'>
                    <input type="hidden" name="ID_Projekts" value="<?php echo $ID_Projekts; ?>">
                    <button class='konts_poga' type='submit' name='Publicesana' value='Noraidit'>Noraidīt</button>
                    <button class='konts_poga' type='submit' name='Publicesana' value='Apstiprinat'>Apstiprināt</button><br><br>
                </form>
    </div>
                    <?php
                }else if($Lietotajs['ID_Konts'] == $Projekts['ID_Konts']){
                    include('projekti_paradit.php');
?>
</div>
<div class="Vizualizesanai">
    <?php include('grafs.php'); ?>     
</div><?php
                }else{
                    echo "<h3>Jums nav atļauta piekļuve šim projektam</h3>";
                }
            }   





        }
    }else{
        echo "Neizdevās atrast izvēlēto projektu, mēģiniet vēlreiz";
    }
    }else{
        echo "<form class='Saturs Saturs_Smalks' method='post'>";
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
        echo "</form>";
    }
    ?>
        
 
</body>
    
</html>
