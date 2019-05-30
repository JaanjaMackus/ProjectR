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
            <input value='<?php echo $E_Pasts ?>' type='text' name='E_Pasts' class='Ievade_Ievads' placeholder='E-pasts' autofocus>
            <h2>Parole</h2>
            <input type='password' name='Parole' class='Ievade_Ievads' placeholder='Parole'>
            <input type='submit' name='Pieslegt_Lietotaju' value='Pieslēgties' class='Ievade_Poga'>
        </form>
        <span class='Atstarpe_Auksa'></span>
        <p>Jauns lietotājs? <a href='registracija.php'>Reģistrējies</a></p>
    </div> 
</div>  
        