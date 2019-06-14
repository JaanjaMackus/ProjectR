

<div class="Smalks_PilnsSaturs_1_5">
    
<?php
    $string = "2016-03-09 05:52:38"; 
    $str_arr = explode (" ", $string);  
    print_r($str_arr);
    $string = $str_arr[1]; 
    $str_arr = explode (":", $string);  
    print_r($str_arr); 

    $E_Pasts = $_SESSION['E_Pasts'];
    mysqli_set_charset($Datu_Baze,"utf8");
    $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Lietotajs = mysqli_fetch_assoc($Rezultats);
    if($Lietotajs){
        $ID_Konts = $Lietotajs['ID_Konts'];
        $Pieprasijums = "SELECT * FROM atskaite WHERE ID_Konts=$ID_Konts";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        while($filtrs = mysqli_fetch_assoc($Rezultats)){
//projekti.php?Apskatit=1&mervieniba1=3&mervieniba2=3&intervals=hour&biezums=1&datums1=2019-06-10&h1=&m1=&s1=&datums2=2019-06-08&h2=&m2=&s2=&Nosaukums=&filtrs=Filtr%C4%93t
            echo "
            <a class='Konta_teksts' href='projekti.php?Apskatit=".$filtrs['ID_Projekts']."&mervieniba1='".$filtrs['ID_Mervieniba1']."'&mervieniba2='".$filtrs['ID_Mervieniba2']."'&intervals='".$filtrs['Datuma_Intervals']."'&biezums='".$filtrs['Datuma_Biezums']."'  '><div>
                <h3>Filtra nosaukums</h3>
                <p>Projekta nosaukums</p>
                <p>datu tips1, datu tips2</p>
                <p>No_datums, Lidz_datums</p>
            </div></a>";
        }
    }else{
        echo "neatrada lietotāju";
    }

    
    
    
    ?>
    
    
    
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    
    
    
    
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    <a class="Konta_teksts" href="#"><div>
        <h3>Filtra nosaukums</h3>
        <p>Projekta nosaukums</p>
        <p>datu tips1, datu tips2</p>
        <p>No_datums, Lidz_datums</p>
    </div></a>
    
</div>