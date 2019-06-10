    <h3>Projekta labošana</h3>
    <?php if(count($Kludas)>0){
    foreach ($Kludas as $Kluda){
          echo "<p class='kluda'>$Kluda</p>";
    }
    } ?>
    <form method="post">
        <h2>Nosaukums</h2>
        <input value="<?php echo $Nosaukums; ?>" type="text" name="Nosaukums" class="Ievade_Ievads" placeholder="Nosaukums" autofocus required>
        <h2>Īss apraksts</h2>
        <textarea type="text" name="Apraksts_Iss" class="Ievade_Gars Ievade_Ievads" placeholder="Īss apraksts līdz 500 simboliem" required><?php echo $Apraksts_Iss;?></textarea>
        <h2>Pilns apraksts</h2>
        <textarea type="textarea" name="Apraksts" class="Ievade_Gars Ievade_Ievads" placeholder="Pilns apraksts" required><?php echo $Apraksts;?></textarea>
        

        <a class="Atstarpe_Auksa Pievienot_poga Konta_teksts" href="konts.php?Saturs=21">
            <h3>Pievienot jaunu Dalībnieku</h3></a>
        <div class="dalibnieks">
        <?php
        $Pieprasijums = "SELECT * FROM dalibnieks WHERE ID_Projekts=$ID_Projekts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($Dalibnieks = mysqli_fetch_assoc($Rezultats)){
            echo "
            <div><h3>". $Dalibnieks['Vards'] ." ". $Dalibnieks['Uzvards'] ."</h3><p class='apraksts'> ". $Dalibnieks['Apraksts'] ." <br> <button class='konts_poga poga_blakus' type='submit' name='LabotDalibnieku' value=".$Dalibnieks['ID_Dalibnieks'].">Labot</button><button class='konts_poga poga_blakus' type='submit' name='DzestDalibnieku' value=".$Dalibnieks['ID_Dalibnieks'].">Dzēst</button></p>
        </div>";
        }?>
            
            
            
            
        <!----
        <div><h3>Vards Uzvards</h3><p class="apraksts">stradaja pie sensoriem, kur jūtas ļoti labi, jo sensori viņu saprot <span class="dalibnieks_poga">labot</span> // <span class="dalibnieks_poga">dzēst</span></p>
            <button class='konts_poga' type='submit' name='Apskatit' value=".$projekts['ID_Projekts'].">Apskatīt projektu</button>
        </div>
            ---->
            
        </div>
        
        
        
        <input type="submit" name="atcelt_projektu" value="Atcelt labojumus" class="Ievade_Poga Saura_Poga">
        <input type="submit" name="saglabat_projektu" value="Saglabāt labojumus" class="Ievade_Poga Saura_Poga">
    </form>