<?php include('konts_admin_lietotaji_parbaude.php'); ?>

<div class="Smalks_Pilns_1_5">
    <h3>Meklēt lietotājus pēc E-pasta</h3>
    <form method="post">
        <input value='' type='text' name='E_Pasts' class='Ievade_Ievads' placeholder='E-pasts' autofocus>
        <input type='submit' name='Meklet' value='Meklēt' class='Ievade_Poga'>
    </form>
    <br><br>
<?php
    if ($Eksiste==1 && mysqli_num_rows($Rezultats)!=0){
        while($Konts = mysqli_fetch_assoc($Rezultats)){
                echo "
                    <p class='Konts_lietotaji'>".$Konts['Vards']." ".$Konts['Uzvards']." ".$Konts['E_Pasts']."
                    </p><p class='Konts_lietotaji'><a href='#'>labot kontu</a><a href='#'>dzēst kontu</a></p>
                ";
        }
    }else{
        $Pieprasijums = "SELECT * FROM konts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($Konts = mysqli_fetch_assoc($Rezultats)){

                echo "
                    <p class='Konts_lietotaji'>".$Konts['Vards']." ".$Konts['Uzvards']." ".$Konts['E_Pasts']."
                    </p><p class='Konts_lietotaji'><a href='#'>labot kontu</a><a href='#'>dzēst kontu</a></p>
                ";
        }

        
    }


?>
</div>



