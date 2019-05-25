
    <div class="Konts_Nav">
        <ul>
            <li class="Lietotajs"><p><?php 
                $E_Pasts = $_SESSION['E_Pasts'];
                $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts='$E_Pasts'";
                $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
                $Lietotajs = mysqli_fetch_assoc($Rezultats);
                if($Lietotajs){
                    echo $Lietotajs['Vards'].' '.$Lietotajs['Uzvards'];
                }else{
                    echo "neatrada lietotāju";
                }
                ?></p></li>
            <a href="?Saturs=1"><li>Filtri</li></a>
            <a href="?Saturs=2"><li>Mani Projekti</li></a>
            <a href="?Saturs=3"><li>Konta Iestatījumi</li></a>
        </ul>
    </div>