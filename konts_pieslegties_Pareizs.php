<div class='Atstarpe'></div>
<div class='Saturs'>
    <div class='Vidus_Mazais'>
        <h3 class='Atstarpe_Auksa'>Pieslēgšanās forma</h3>
        <?php
        if(count($Kludas)>0){
        foreach ($Kludas as $Kluda){
        echo "<p class='kluda'>$Kluda</p>";
        }
        } ?>
        <form method='post' action='konts.php'>
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
            <input type="password" name="Parole"
               maxlength="30"
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}"
               oninvalid="setCustomValidity('Vismaz 10 simbolu parolei nepieciešams 1 cipars, 1 lielais un 1 mazais burts')" 
               oninput="setCustomValidity('')"
               title="Parole" class="Ievade_Ievads"
               placeholder="Parole" required>
            <input type='submit' name='Pieslegt_Lietotaju' value='Pieslēgties' class='Ievade_Poga'>
        </form>
        <span class='Atstarpe_Auksa'></span>
        <p>Jauns lietotājs? <a href='registracija.php'>Reģistrējies</a></p>
    </div> 
</div>  
        