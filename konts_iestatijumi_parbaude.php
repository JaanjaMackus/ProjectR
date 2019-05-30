<?php
$Vards = "";
$Uzvards = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');
// Lietotāja rediģēšana
if (isset($_POST['Saglabat_Izmainas'])){
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Vards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Vards'])));
    $Uzvards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards'])));
    $E_Pasts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts'])));

    // Lietotāja datu pārbaude
    if(empty($Vards)){ $Kludas[]="nepieciešams Vārds"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams Uzvārds"; }
    if(empty($E_Pasts)){ $Kludas[]="nepieciešams E-Pasts"; }

    // E-pasta pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts='$E_Pasts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Lietotajs = mysqli_fetch_assoc($Rezultats);
    if($Lietotajs){
        if ($Lietotajs['E_Pasts'] === $E_Pasts){
            $Kludas[]="E-pasts jau tiek izmantots citā kontā";
        }
    }

    // ja nav kļūdu tad rediģē lietotāju
    if (count($Kludas) == 0){
        $Vecais_E_Pasts = $_SESSION['E_Pasts'];
        $Pieprasijums = "UPDATE konts set Vards='$Vards', Uzvards='$Uzvards', E_Pasts='$E_Pasts' where E_Pasts='$Vecais_E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        if($Rezultats){
            $_SESSION['E_Pasts'] = $E_Pasts;
            echo "<p>Izdevās konta rediģēšanās</p>";
        }else{
            $Kludas[]="neizdevās konta rediģēšana";
        }
    }
}