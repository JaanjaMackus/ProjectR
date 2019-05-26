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
                <input value="<?php echo $Vards ?>"
                       maxlength="20"
                       type="text" name="Vards"
                       title="Vārds" class="Ievade_Ievads"
                       placeholder="Vārds" autofocus required>
                <input value="<?php echo $Uzvards ?>"
                       id="Uzvards"
                       class="Ievade_Ievads"
                       maxlength="20"
                       type="text" name="Uzvards"
                       pattern="[a-zA-Z-].{3,}"
                       title="Uzvārds" class="Ievade_Ievads"
                       placeholder="Uzvārds" required>
                <input value="<?php echo $E_Pasts ?>"
                       maxlength="30"
                       type="email" name="E_Pasts"
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+$"
                       title="E-Pasts" class="Ievade_Ievads"
                       placeholder="E-pasta addrese" required>
                <input type="password" name="Parole_1"
                       maxlength="30"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Parole" class="Ievade_Ievads"
                       placeholder="Parole" required>
                <input type="password" name="Parole_2"
                       maxlength="30"
                       title="Atkārtotā parole"
                       class="Ievade_Ievads"
                       placeholder="Atkārtota Parole" required>
                <input type="submit" name="Registret_Lietotaju" value="Izveidot kontu" class="Ievade_Poga">
            </form>
            <span class="Atstarpe_Auksa"></span>
            <p>Jau reģistrēts? <a href="konts.php">Pieslēdzies</a></p>
            <?php } ?>
        </div>
    </div>
</body>
    
<script>
    var input = document.getElementById('Vards');
    input.oninvalid = function(event) {
    event.target.setCustomValidity('Uzvārdam vajag 1 lielo burtu');
}
</script>
</html>
