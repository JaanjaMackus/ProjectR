
    <div class="Konts_Nav">
        <ul>
            <li class="Lietotajs"><p><?php 
                $E_Pasts = $_SESSION['E_Pasts'];
                $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
                $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
                $Lietotajs = mysqli_fetch_assoc($Rezultats);
                if($Lietotajs){
                    echo $Lietotajs['Vards'].' '.$Lietotajs['Uzvards'];
                }else{
                    echo "neatrada lietotāju";
                }
                ?></p></li>
            <a href="?Saturs=1"><li <?php if($Konts_Izvelets==1){ echo "class='Konts_Izvelets'";} ?>>Filtri</li></a>
            <a href="?Saturs=2"><li <?php if($Konts_Izvelets==2){ echo "class='Konts_Izvelets'";} ?>>Mani Projekti</li></a>
            <a href="?Saturs=3"><li <?php if($Konts_Izvelets==3){ echo "class='Konts_Izvelets'";} ?>>Konta Iestatījumi</li></a>
            <?php
            if($Lietotajs['Tiesibas'] == 1){
                $skaits = 0;
                $Pieprasijums = "SELECT count(ID_Projekts) as skaits from projekts where VaiPublisks=2";
                $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
                $daudzums = mysqli_fetch_assoc($Rezultats);
                if($daudzums['skaits']>0){
                    $skaits = $daudzums['skaits'];
                }
                if($Konts_Izvelets==4){
                    
                }
                echo "<a href='?Saturs=4'><li ".(($Konts_Izvelets==4)?'class="Konts_Izvelets"':"").">Lietotāju pārvaldīšana</li></a>
                <a href='?Saturs=5'><li ".(($Konts_Izvelets==5)?'class="Konts_Izvelets"':"").">projekti publicēšanai ($skaits)</li></a>";
            } ?>
        </ul>
    </div>

