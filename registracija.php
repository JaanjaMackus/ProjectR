<?php include('registracija_parbaude.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Datu Vizualizēšana</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>


<body>
    <?php include('nav.php'); ?>
    <div class="Atstarpe"></div>
    <div class="Saturs">
        <div class="Vidus_Mazais">
            
            <?php if(isset($_SESSION['E_Pasts'])){
            echo "<h3 class='Atstarpe_Auksa'>Esat jau pieslēgušies kontam, ja vēlaties iziet no konta spiediet <a href='atslegties.php'>Atslēgties</a></h3>";
            
            
            }else{ ?>
            <h3 class="Atstarpe_Auksa">Reģistrēšanās forma</h3>
            <?php if(count($Kludas)>0){
            foreach ($Kludas as $Kluda){
                  echo "<p class='kluda'>$Kluda</p>";
            }
            } ?>
            <form method="post" action="registracija.php">
                <input value="<?php echo $Vards ?>" type="text" name="Vards" class="Ievade_Ievads" placeholder="Vārds" autofocus>
                <input value="<?php echo $Uzvards ?>" type="text" name="Uzvards" class="Ievade_Ievads" placeholder="Uzvārds">
                <input value="<?php echo $E_Pasts ?>" type="email" name="E_Pasts" class="Ievade_Ievads" placeholder="E-pasta addrese">
                <input type="password" name="Parole_1" class="Ievade_Ievads" placeholder="Parole">
                <input type="password" name="Parole_2" class="Ievade_Ievads" placeholder="Atkārtota Parole">
                <input type="submit" name="Registret_Lietotaju" value="Izveidot kontu" class="Ievade_Poga">
            </form>
            <span class="Atstarpe_Auksa"></span>
            <p>Jau reģistrēts? <a href="konts.php">Pieslēdzies</a></p>
            <?php } ?>
        </div>
    </div>
</body>
    
</html>
