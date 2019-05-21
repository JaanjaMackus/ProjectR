<?php
session_start();
$Vards = "";
$Uzvards = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');

// Lietotāja reģistrācija
if (isset($_POST['Registret_Lietotaju'])) {
    // paņem visus datus no lietotāja izmanto mysqli_real_escape_string(), lai pasargātu no sql injection
    $Vards = mysqli_real_escape_string($Datu_Baze, $_POST['Vards']);
    $Uzvards = mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards']);
    $E_Pasts = mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts']);
    $Parole_1 = mysqli_real_escape_string($Datu_Baze, $_POST['Parole_1']);
    $Parole_2 = mysqli_real_escape_string($Datu_Baze, $_POST['Parole_2']);

    // Lietotāja datu pārbaude
    if(empty($Vards)){ $Kludas[]="nepieciešams Vārds"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams Uzvārds"; }
    if(empty($E_Pasts)){ $Kludas[]="nepieciešams E-Pasts"; }
    if(empty($Parole_1)){ $Kludas[]="nepieciešama Parole"; }
    if($Parole_1 != $Parole_2){ $Kludas[]= "Ievadītās paroles nesakrīt"; }

    // E-Pasta pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts='$E_Pasts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Lietotajs = mysqli_fetch_assoc($Rezultats);
    if($Lietotajs){
        if ($Lietotajs['E_Pasts'] === $E_Pasts){
            $Kludas[]="Lietotājs ar šādu E-Pasts jau ir reģistrēts";
        }
    }

    // ja nav kļūdu tad reģistrē lietotāju
    if (count($Kludas) == 0) {
        $Parole = password_hash($Parole_1, PASSWORD_DEFAULT);
        $Ievietojamais = "INSERT INTO konts (Vards, Uzvards, E_Pasts, Parole)
            VALUES('$Vards', '$Uzvards', '$E_Pasts', '$Parole')";
        mysqli_query($Datu_Baze, $Ievietojamais);
        $_SESSION['E_Pasts'] = $E_Pasts;
        header('location: index.php');
    }
}