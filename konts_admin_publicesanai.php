
<?php 
$Pieprasijums = "SELECT * FROM projekts WHERE VaiPublisks=2";
$Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
while($projekts = mysqli_fetch_assoc($Rezultats)){
        
        echo "
        <div class='Projekts Konta_teksts'>
            <h3>" . $projekts['Nosaukums'] . "</h3>
            <p>".$projekts['Apraksts_Iss']."
            <br><br><a class='konts_poga' href='#'>Apskatīt projektu</a></p>
        </div>";
}



?>