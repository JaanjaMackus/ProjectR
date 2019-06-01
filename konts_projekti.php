
<a class="Projekts Pievienot_poga Konta_teksts" href="konts.php?Saturs=21">
<h3>Pievienot jaunu projektu</h3></a>
<div class="Smalks_PilnsSaturs_1_5">


<?php
$E_Pasts = $_SESSION['E_Pasts'];
$Pieprasijums = "SELECT ID_Konts FROM konts WHERE E_Pasts='$E_Pasts'";
$Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
if(mysqli_num_rows($Rezultats) > 0){
    $Konts = mysqli_fetch_array($Rezultats);
    $ID_Konts = $Konts["ID_Konts"];
    $Pieprasijums = "SELECT * FROM projekts WHERE ID_Konts='$ID_Konts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    while($projekts = mysqli_fetch_assoc($Rezultats)){
        echo "
        <div class='Projekts Konta_teksts'>
            <h3>" . $projekts['Nosaukums'] . "</h3>
            <p>".$projekts['Apraksts_Iss']."
            <br><br><a class='konts_poga' href=''>Apskatīt projektu</a>
            <a class='konts_poga' href=''>Labot projektu</a></p>
        </div>";
    }
}

?>

</div>