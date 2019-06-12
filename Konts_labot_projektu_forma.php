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
        

        <input type="submit" name="Pievienot_Dalibnieku" value="Pievienot dalībnieku" class="Ievade_Poga Saura_Poga">
        
        <div class="dalibnieks">
        <?php
        $Pieprasijums = "SELECT * FROM dalibnieks WHERE ID_Projekts=$ID_Projekts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($Dalibnieks = mysqli_fetch_assoc($Rezultats)){
            echo "
            <div><h3>". $Dalibnieks['Vards'] ." ". $Dalibnieks['Uzvards'] ."</h3><p class='apraksts'> ". $Dalibnieks['Apraksts'] ." <br> <button class='konts_poga poga_blakus' type='submit' name='Labot_Dalibnieku' value=".$Dalibnieks['ID_Dalibnieks'].">Labot</button><button class='konts_poga poga_blakus' type='submit' name='Dzest_Dalibnieku' value=".$Dalibnieks['ID_Dalibnieks'].">Dzēst</button></p>
        </div>";
        }?>
            
        </div>
        
        
        <input type="submit" name="Dzest_Projektu" value="Dzēst Projektu" class="Ievade_Poga Saura_Poga">
        <?php
        $ID_Projekts = $_SESSION['Projekta_ID'];
        $Pieprasijums = "SELECT VaiPublisks FROM projekts WHERE ID_Projekts=$ID_Projekts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Dalibnieks = mysqli_fetch_assoc($Rezultats);
        if($Dalibnieks['VaiPublisks'] != 1 && $Dalibnieks['VaiPublisks'] != 2){
            echo "<input type='submit' name='Publicet_Projektu' value='Pieprasīt publicēšanu' class='Ievade_Poga Saura_Poga'>";
        }else{
            echo "<span class='Jauna_Rinda'></span>";
        }
        
        ?>
        <input type="submit" name="Atcelt_Projektu" value="Atcelt labojumus" class="Ievade_Poga Saura_Poga">
        <input type="submit" name="Saglabat_Projektu" value="Saglabāt labojumus" class="Ievade_Poga Saura_Poga">
    </form>