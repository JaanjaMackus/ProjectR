<?php include('konts_admin_lietotaji_parbaude.php'); ?>

<!--   pilna loga divs  -->
<div class="Smalks_Pilns_1_5"><h3>pilns loga garums visa garuma ja vajag</h3></div>

<!--  ja vajag 4 kolunnas atsevisķi  -->
<div><p>1kolonna</p></div>
<div><p>2kolonna</p></div>
<div><p>3kolonna</p></div>
<div><p>4kolonna</p></div>

<!--  ja vajag 2 kolunnas atsevisķi  -->
<div class="Projekts"><p>11 kolonna</p></div>
<div class="Projekts"><p>12 kolonna</p></div>



<div class="Smalks_Pilns_1_5">
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



