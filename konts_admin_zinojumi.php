
<?php 
if(isset($_POST['dzest'])){
    $Pieprasijums = "DELETE FROM zinojums WHERE ID_Zinojums=".$_POST['dzest']." LIMIT 1";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    if($Rezultats){
    }else{
        echo "Neizdevās izdzēst";
    }
    
}
echo "<form class='Smalks_PilnsSaturs_1_5' method='post'>";
$Pieprasijums = "SELECT * FROM zinojums";
$Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
if(mysqli_num_rows($Rezultats)!=0){
    while($zinojums = mysqli_fetch_assoc($Rezultats)){
            $Pieprasijums = "SELECT * FROM konts WHERE ID_Konts=".$zinojums['ID_Konts'];
            $Lietotajs = mysqli_query($Datu_Baze, $Pieprasijums);
            $Lietotajs = mysqli_fetch_assoc($Lietotajs);
            if($Lietotajs){
                $VardsUzvards = $Lietotajs['Vards']." ".$Lietotajs['Uzvards'];
            }else{
                $VardsUzvards = "Neeksistejoš";
            }
            $Pieprasijums = "SELECT Nosaukums FROM projekts WHERE ID_Projekts=".$zinojums['ID_Projekts'];
            $Projekts = mysqli_query($Datu_Baze, $Pieprasijums);
            $Projekts = mysqli_fetch_assoc($Projekts);
            if($Projekts){
                $Nosaukums = $Projekts['Nosaukums'];
            }else{
                $Nosaukums = "Neeksistejoš";
            }
        
        
            echo "
            <div class='Projekts Konta_teksts'>
                <h3>$VardsUzvards</h3>
                <h3>$Nosaukums</h3>
                <p>".$zinojums['Zina']."
                <br><br><button class='konts_poga' type='submit' name='dzest' value='".$zinojums['ID_Zinojums']."'>Dzēst ziņojumu</button></p>
            </div>";
    }
    echo "</form>";
}else{
    echo "<div class='Smalks_Pilns_1_5 Konta_teksts'><h3>Nav neviena ziņojuma</h3></div>";
}



?>
