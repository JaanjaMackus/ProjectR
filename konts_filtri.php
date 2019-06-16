

<form class="Smalks_PilnsSaturs_1_5 Forma_Pilna">
<input type='hidden' name='Saturs' value='1'>
<?php
    
    if(isset($_GET['dzest'])){
        $ID_Filtrs = $_GET['dzest'];
        $Pieprasijums = "DELETE FROM atskaite WHERE ID_Atskaite=$ID_Filtrs LIMIT 1";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        if($Rezultats){
            
        }else{
            echo "Neizdevās izdzēst";
        }
    }
    
    $E_Pasts = $_SESSION['E_Pasts'];
    mysqli_set_charset($Datu_Baze,"utf8");
    $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Lietotajs = mysqli_fetch_assoc($Rezultats);
    if($Lietotajs){
        $ID_Konts = $Lietotajs['ID_Konts'];
        $Pieprasijums = "SELECT * FROM atskaite WHERE ID_Konts=$ID_Konts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($Atskaite = mysqli_fetch_assoc($Rezultats)){
//parāda filtru
            $datums1 = $Atskaite['No_Datums'];
            $datums1 = explode (" ", $datums1);
            $laiks1 = $datums1[1];
            $datums1 = $datums1[0];
            $laiks1 = explode (":", $laiks1);  
            $h1 = $laiks1[0];
            $m1 = $laiks1[1];
            $s1 = $laiks1[2];
            
            $datums2 = $Atskaite['Lidz_Datums'];
            $datums2 = explode (" ", $datums2);
            $laiks2 = $datums2[1];
            $datums2 = $datums2[0];
            $laiks2 = explode (":", $laiks2);  
            $h2 = $laiks2[0];
            $m2 = $laiks2[1];
            $s2 = $laiks2[2];
            $Pieprasijums = "SELECT * FROM projekts WHERE ID_Projekts =".$Atskaite['ID_Projekts'];
            $Projekts = mysqli_query($Datu_Baze, $Pieprasijums);
            $Projekts = mysqli_fetch_assoc($Projekts);
            if($Projekts){
                $Projekts = $Projekts['Nosaukums'];
            }else{
                $Projekts = "Nosaukums";
            }
            
            $Pieprasijums = "SELECT * FROM mervieniba WHERE ID_Mervieniba =".$Atskaite['ID_Mervieniba1'];
            $Mervieniba1 = mysqli_query($Datu_Baze, $Pieprasijums);
            $Mervieniba1 = mysqli_fetch_assoc($Mervieniba1);
            if($Mervieniba1){
                $Mervieniba1 = $Mervieniba1['Mervieniba'];
            }else{
                $Mervieniba1 = 0;
            }
            $Pieprasijums = "SELECT * FROM mervieniba WHERE ID_Mervieniba =".$Atskaite['ID_Mervieniba2'];
            $Mervieniba2 = mysqli_query($Datu_Baze, $Pieprasijums);
            $Mervieniba2 = mysqli_fetch_assoc($Mervieniba2);
            if($Mervieniba2){
                $Mervieniba2 = $Mervieniba2['Mervieniba'];
            }else{
                $Mervieniba2 = 0;
            }
            
            
            echo "
            <div>
                <h3>".$Atskaite['Nosaukums']."</h3>
                <p>$Projekts</p>
                <p>$Mervieniba1, $Mervieniba2</p>
                <p>".$Atskaite['No_Datums']."<br> ".$Atskaite['Lidz_Datums']."</p>
                <br><a class='Konta_teksts konts_poga' href='projekti.php?Apskatit=".$Atskaite['ID_Projekts']."&mervieniba1=".$Atskaite['ID_Mervieniba1']."&mervieniba2=".$Atskaite['ID_Mervieniba2']."&intervals=".$Atskaite['Datuma_Intervals']."&biezums=".$Atskaite['Datuma_Biezums']."&datums1=".$datums1."&h1=".$h1."&m1=".$m1."&s1=".$s1."&datums2=".$datums2."&h2=".$h2."&m2=".$m2."&s2=".$s2."&Nosaukums=".$Atskaite['Nosaukums']."&filtrs=filtr'>Apskatīt</a>
                <button class='Dzest_Filtru' type='submit' name='dzest' value='".$Atskaite['ID_Atskaite']."'>X</button>
            </div>";
        }
    }else{
        echo "neatrada lietotāju";
    }

    
    
    
    ?>
    
    
    
</form>