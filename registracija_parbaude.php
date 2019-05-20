<?php
session_start();
$Lietotajvards = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
$Datu_Baze = mysqli_connect('localhost', 'root', '', 'registration');

// Lietotāja reģistrācija
if (isset($_POST['Registret_Lietotaju'])) {
    // paņem visus datus no lietotāja izmanto mysqli_real_escape_string(), lai pasargātu no sql injection
    $Lietotajvards = mysqli_real_escape_string($Datu_Baze, $_POST['Lietotajvards']);
    $E_Pasts = mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts']);
    $Parole_1 = mysqli_real_escape_string($Datu_Baze, $_POST['Parole_1']);
    $Parole_2 = mysqli_real_escape_string($Datu_Baze, $_POST['Parole_2']);

    // Lietotāja datu pārbaude
    if(empty($Lietotajvards)){ $Kludas[]="nepieciešams Lietotājvārds"; }
    if(empty($E_Pasts)){ $Kludas[]="nepieciešams E-Pasts"; }
    if(empty($Parole_1)){ $Kludas[]="nepieciešama Parole"; }
    if($Parole_1 != $Parole_2){ $Kludas[]= "Ievadītās paroles nesakrīt"; }

    // Lietotājvārda un E-Pasta pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM konts WHERE Lietotajvards='$Lietotajvards' OR E_Pasts='$E_Pasts'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Lietotajs = mysqli_fetch_assoc($Rezultats);
    if($Lietotajs){
        if($Lietotajs['Lietotajvards'] === $Lietotajvards){
            if ($Lietotajs['E_Pasts'] === $E_Pasts){
                $Kludas[]="Lietotājs ar šādu Lietotājvārdu un E-Pastu jau ir reģistrēts";
            }else{
                $Kludas[]="Lietotājs ar šādu Lietotājvārds jau ir reģistrēts";
            }
        }else{
            if ($Lietotajs['E_Pasts'] === $E_Pasts){
                $Kludas[]="Lietotājs ar šādu E-Pasts jau ir reģistrēts";
            }
        }
    }

    // ja nav kļūdu tad reģistrē lietotāju
    if (count($Kludas) == 0) {
        $Parole = password_hash($Parole_1, PASSWORD_DEFAULT);
        $Ievietojamais = "INSERT INTO konts (Lietotajvards, E_Pasts, Parole)
            VALUES('$Lietotajvards', '$E_Pasts', '$Parole')";
        mysqli_query($Datu_Baze, $Ievietojamais);
        $_SESSION['Lietotajvards'] = $Lietotajvards;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}