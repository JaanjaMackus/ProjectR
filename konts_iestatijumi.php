
<?php include('konts_iestatijumi_parbaude.php'); ?>

<div class="Smalks_Pilns_1_5">
    <h3>Labot kontu</h3>
    <?php if(count($Kludas)>0){
    foreach ($Kludas as $Kluda){
          echo "<p class='kluda'>$Kluda</p>";
    }
    } ?>
    <form method="post">
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
        <h2>E_Pasts</h2>
        <input value="<?php echo $E_Pasts ?>"
               maxlength="30"
               type="email" name="E_Pasts" id="E_Pasts"
               pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+$"
               oninvalid="setCustomValidity('E-Pastam nepieciešams @ simbols un adresse kura satur punktu')" 
               oninput="setCustomValidity('')"
               title="E-Pasts" class="Ievade_Ievads"
               placeholder="E-pasta addrese" required>   
        
        <label class="Ievade_Paradit_Poga">
        <input class="Paradit_Poga" type="checkbox" value="1"><span class="Ievade_Paslepts"><p>Labot paroli</p>
        <h2 class="Ievade_Paslepts">Parole</h2>
        <input type="password" name="Parole_1" id="Parole_1"
               maxlength="30"
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
               oninvalid="setCustomValidity('Vismaz 10 simbolu parolei nepieciešams 1 cipars, 1 lielais un 1 mazais burts')" 
               oninput="setCustomValidity('')"
               title="Parole" class="Ievade_Ievads Ievade_Paslepts"
               placeholder="Parole">
        <h2 class="Ievade_Paslepts">Atkārtotā parole</h2>
        <input type="password" name="Parole_2"
               maxlength="30"
               title="Atkārtotā parole"
               class="Ievade_Ievads Ievade_Paslepts"
               placeholder="Atkārtota Parole">
            </span>
            </label>
        <input type="submit" name="Saglabat_Izmainas" value="Saglabāt izmaiņas" class="Ievade_Poga">
    </form>









</div>