


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
