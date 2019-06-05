
<?php 
$Pieprasijums = "SELECT * FROM projekts WHERE VaiPublisks=2";
$Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
if(mysqli_num_rows($Rezultats)!=0){
    while($projekts = mysqli_fetch_assoc($Rezultats)){

            echo "
            <div class='Projekts Konta_teksts'>
                <h3>" . $projekts['Nosaukums'] . "</h3>
                <p>".$projekts['Apraksts_Iss']."
                <br><br><a class='konts_poga' href='projekti.php?Apskatit=".$projekts['ID_Projekts']."'>Apskatīt projektu</a></p>
            </div>";
    }
}else{
    echo "<div class='Projekts Konta_teksts'><h3>Nav neviena pieprasījuma projektu publicēšanai</h3></div>";
}



?>