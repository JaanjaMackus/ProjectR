<?php include('registracija_parbaude.php');
$_SESSION['Sadala']='Registreties'; ?>

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
                <h2>Vārds</h2>
                <input value="<?php echo $Vards ?>"
                       maxlength="20" 
                       type="text" name="Vards" id="Vards"
                       pattern="(?=.*[a-z])(?=.*[A-Z]).{2,}"
                       oninvalid="setCustomValidity('Vārdam vajag 1 lielo un mazo burtu')" 
                       oninput="setCustomValidity('')"
                       title="Vārds" class="Ievade_Ievads"
                       placeholder="Vārds" autofocus required>
                <h2>Uzvārds</h2>
                <input value="<?php echo $Uzvards ?>"
                       maxlength="20"
                       type="text" name="Uzvards" id="Uzvards"
                       pattern="(?=.*[a-z])(?=.*[A-Z]).{2,}"
                       oninvalid="setCustomValidity('Uzvārdam vajag 1 lielo un mazo burtu')" 
                       oninput="setCustomValidity('')"
                       title="Uzvārds" class="Ievade_Ievads"
                       placeholder="Uzvārds" required>
                <h2>E-pasts</h2>
                <input value="<?php echo $E_Pasts ?>"
                       maxlength="30"
                       type="email" name="E_Pasts" id="E_Pasts"
                       pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+$"
                       oninvalid="setCustomValidity('E-Pastam nepieciešams @ simbols un adresse kura satur punktu')" 
                       oninput="setCustomValidity('')"
                       title="E-Pasts" class="Ievade_Ievads"
                       placeholder="E-pasta addrese" required>
                <h2>Parole</h2>
                <input type="password" name="Parole_1" id="Parole_1"
                       maxlength="30"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
                       oninvalid="setCustomValidity('Vismaz 10 simbolu parolei nepieciešams 1 cipars, 1 lielais un 1 mazais burts')" 
                       oninput="setCustomValidity('')"
                       title="Parole" class="Ievade_Ievads"
                       placeholder="Parole" required>
                <h2>Atkārtotā parole</h2>
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

</html>
