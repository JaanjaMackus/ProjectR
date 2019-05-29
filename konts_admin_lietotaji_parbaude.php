<?php
$E_Pasts    = "";
$Kludas = array(); 

// datubāzes konekcija
include('db.php');
// Lietotāja reģistrācija
if (isset($_POST['Meklet'])) {
    // paņem visus datus no lietotāja izmantjot vairākas funkcijas, lai pasargātu no ļaunprātīgiem ierakstiem
    $E_Pasts = trim(htmlspecialchars(mysqli_real_escape_string($Datu_Baze, $_POST['E_Pasts'])));

    // vārda pieejamības pārbaude
    $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts LIKE '%$E_Pasts%'";
    $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
    $Eksiste=1;
    //ja viss kārtībā $Rezultats ir atrastie konti
}else{
    $Eksiste=0;
}