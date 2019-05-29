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
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Vards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Vards'])));
    $Uzvards = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Uzvards'])));
    $E_Pasts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts'])));
    $Parole_1 = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Parole_1'])));
    $Parole_2 = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Parole_2'])));

    // Lietotāja datu pārbaude
    if(empty($Vards)){ $Kludas[]="nepieciešams Vārds"; }
    if(strlen($Vards) > '20'){ $Kludas[]="vārds ir garāks par 20 simboliem"; }
    if(empty($Uzvards)){ $Kludas[]="nepieciešams Uzvārds"; }
    if(strlen($Uzvards) > '20'){ $Kludas[]="uzvārds ir garāks par 20 simboliem"; }
    if(empty($E_Pasts)){ $Kludas[]="nepieciešams E-Pasts"; }
    if(strlen($E_Pasts) > '20'){ $Kludas[]="E-Pasts ir garāks par 30 simboliem"; }
    if(empty($Parole_1)){ $Kludas[]="nepieciešama Parole"; 
        }else{
            if(strlen($Parole_1) < '10'){ $Kludas[]="parolei jābūt vismaz 10 simbolu garumā"; }
            if(strlen($Parole_1) > '30'){ $Kludas[]="parole ir garāka par 30 simboliem"; 
            }else{
                if(!preg_match("#[0-9]+#",$Parole_1)){ $Kludas[]="nepieciešams cipars parolē"; }
                if(!preg_match("#[A-Z]+#",$Parole_1)){ $Kludas[]="nepieciešams lielais burts parolē"; }
                if(!preg_match("#[a-z]+#",$Parole_1)){ $Kludas[]="nepieciešams mazais burts parolē"; }
            }
        }
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
        $registracija = mysqli_query($Datu_Baze, $Ievietojamais);
        if($registracija){
            $_SESSION['E_Pasts'] = $E_Pasts;
            header('location: konts.php?Saturs=1');
        }else{
            $Kludas[]="radās kļūda, mēģiniet vēlāk";
        }
    }
}