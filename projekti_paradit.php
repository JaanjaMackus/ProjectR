


        <div class="Smalks_Pilns">
            <h1><?php echo $Projekts['Nosaukums']; if(isset($_SESSION['E_Pasts'])){?><form method="post" class="Zinojums_Poga"><button value="<?php echo $Projekts['ID_Projekts']; ?>" name="zinot">(ziņot par pārkāpumu)</button></form><?php } ?></h1>
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
