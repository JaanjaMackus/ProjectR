<?php
$Nosaukums = "";
$Apraksts_Iss = "";
$Apraksts = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');
// Lietotāja reģistrācija
if(isset($_POST['saglabat_projektu'])){
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Nosaukums = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Nosaukums'])));
    $Apraksts_Iss = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts_Iss'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));
    
    $_SESSION['Projekta_Nosaukums']=$Nosaukums;
    $_SESSION['Projekta_Apraksts_Iss']=$Apraksts_Iss;
    $_SESSION['Projekta_Apraksts']=$Apraksts;
    $ID_Projekts = $_GET['labot'];
    
    // Lietotāja datu pārbaude
    if(empty($Nosaukums)){ $Kludas[]="nepieciešams Nosaukums"; }else{
        $_SESSION['Projekta_Nosaukums']=$Nosaukums;
    }
    if(empty($Apraksts_Iss)){ $Kludas[]="nepieciešams Īss apraksts"; }else{
        $_SESSION['Projekta_Apraksts_Iss']=$Apraksts_Iss;
    }
    if(empty($Apraksts)){ $Kludas[]="nepieciešams apraksts"; }else{
        $_SESSION['Projekta_Apraksts']=$Apraksts;
    }

    // vārda pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM projekts WHERE Nosaukums='$Nosaukums'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $projekts = mysqli_fetch_assoc($Rezultats);
    if($projekts){
        if($projekts['ID_Projekts'] == $ID_Projekts){
        }else if ($projekts['Nosaukums'] === $Nosaukums){
            $Kludas[]="Projekts ar šādu nosaukumu jau eksistē";
        }
    }

    // ja nav kļūdu tad saglabā izmaiņas projektā
    if (count($Kludas) == 0) {
        $E_Pasts = $_SESSION['E_Pasts'];
        $Pieprasijums = "SELECT ID_Konts FROM konts WHERE E_Pasts='$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Lietotajs = mysqli_fetch_assoc($Rezultats);
        if($Lietotajs){
            mysqli_set_charset($Datu_Baze,"utf8");
            $Lietotajs = $Lietotajs['ID_Konts'];
            $labojamais = "UPDATE projekts SET Nosaukums='$Nosaukums', Apraksts_Iss='$Apraksts_Iss', Apraksts='$Apraksts ' WHERE ID_Konts=$Lietotajs AND ID_Projekts=$ID_Projekts";
            echo $labojamais;
            $labosana = mysqli_query($Datu_Baze, $labojamais);
            if($labosana){
                    header('location: konts.php?Saturs=2');
            }else{
                $Kludas[]="radās kļūda labojot projektu, mēģiniet vēlāk";
            }          
        }else{
            $Kludas[]="neizdevās iegūt lietotāja ID, mēģiniet iziet un ieiet savā kontā";
        }
    }
}else if(isset($_POST['labot_dalibnieku'])){
    $ID_Projekts = $_POST['labot_dalibnieku '];
    
}else if(isset($_POST['DzestDalibnieku'])){
    $ID_Projekts = $_POST['DzestDalibnieku'];
    echo $ID_Projekts;
    
}