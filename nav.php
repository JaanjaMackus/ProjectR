<div id="Nav_Turetajs">
    <h1 class="Logo">ProData</h1>
    <input type="checkbox" id="Nav_Poga" class="Nav_Poga">
    <div class="Nav">
        <ul>
            <a <?php if($_SESSION['Sadala']=='Sakums'){ echo "class='Nav_Izvelets'";} ?> href="index.php"><li>Sākums</li></a>
            <a <?php if($_SESSION['Sadala']=='Projekti'){ echo "class='Nav_Izvelets'";} ?> href="projekti.php"><li>Projekti</li></a>
            <?php
                if(isset($_SESSION['E_Pasts'])){
                    echo "
                    <a ".(($_SESSION['Sadala']=='Konts')?'class="Nav_Izvelets"':"")." href='konts.php?Saturs=1'><li>Konts</li></a>
                    <a href='atslegties.php'><li>Atslēgties</li></a>";
                }else{
                    echo "
                    <a ".(($_SESSION['Sadala']=='Pieslegties')?'class="Nav_Izvelets"':"")." href='konts.php'><li>Pieslēgties</li></a>
                    <a ".(($_SESSION['Sadala']=='Registreties')?'class="Nav_Izvelets"':"")." href='registracija.php'><li>Reģistrēties</li></a>";
                }
            ?>
        </ul>
    </div>
    <label for="Nav_Poga">
        <span></span>
    </label>
</div>