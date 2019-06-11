<?php
$Nosaukums = "";
$Apraksts_Iss = "";
$Apraksts = "";
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');
// Lietotāja reģistrācija
if (isset($_POST['izveidot_projektu'])) {
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $Nosaukums = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Nosaukums'])));
    $Apraksts_Iss = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts_Iss'])));
    $Apraksts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['Apraksts'])));

    // Lietotāja datu pārbaude
    if(empty($Nosaukums)){ $Kludas[]="nepieciešams Nosaukums"; }
    if(empty($Apraksts_Iss)){ $Kludas[]="nepieciešams Īss apraksts"; }
    if(empty($Apraksts)){ $Kludas[]="nepieciešams apraksts"; }

    // vārda pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM projekts WHERE Nosaukums='$Nosaukums'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $projekts = mysqli_fetch_assoc($Rezultats);
    if($projekts){
        if ($projekts['Nosaukums'] === $Nosaukums){
            $Kludas[]="Projekts ar šādu nosaukumu jau eksistē";
        }
    }

    // ja nav kļūdu tad saglabā projekta datus
    if (count($Kludas) == 0) {
        $E_Pasts = $_SESSION['E_Pasts'];
        $Pieprasijums = "SELECT ID_Konts FROM konts WHERE E_Pasts='$E_Pasts'";
        $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
        $Lietotajs = mysqli_fetch_assoc($Rezultats);
        if($Lietotajs){
            mysqli_set_charset($Datu_Baze,"utf8");
            $Lietotajs = $Lietotajs['ID_Konts'];
            $Ievietojamais = "INSERT INTO projekts (Nosaukums, Apraksts_Iss, Apraksts, ID_Konts)
                VALUES('$Nosaukums', '$Apraksts_Iss', '$Apraksts', '$Lietotajs')";
            $izveidosana = mysqli_query($Datu_Baze, $Ievietojamais);
            if($izveidosana){
                $Pieprasijums = "SELECT ID_Projekts FROM projekts WHERE Nosaukums='$Nosaukums' AND ID_Konts='$Lietotajs'";
                $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
                    if($Rezultats){
                    $ID_Projekts = mysqli_fetch_assoc($Rezultats);
                    if($ID_Projekts){
                        $ID_Projekts = $ID_Projekts['ID_Projekts'];
                        header("location: konts.php?Saturs=22&labot=".$ID_Projekts);
                    }else{
                        $Kludas[]="radās kļūda, nevar atrast izveidoto projektu";
                    }
                }else{
                $Kludas[]="radās kļūda, mēģiniet vēlāk";
                } 
            }else{
                $Kludas[]="radās kļūda, mēģiniet vēlāk";
            }          
        }else{
            $Kludas[]="neizdevās iegūt lietotāja ID, mēģiniet iziet un ieiet savā kontā";
        }
    }
}