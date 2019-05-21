<div id="Nav_Turetajs">
    <h1 class="Logo">ProData</h1>
    <input type="checkbox" id="Nav_Poga" class="Nav_Poga">
    <div class="Nav">
        <ul>
            <a href="index.php"><li>Sākums</li></a>
            <a href="projekti.php"><li>Projekti</li></a>
            <?php
                if(isset($_SESSION['E_Pasts'])){
                    echo "
                    <a href='konts.php?Saturs=1'><li>Konts</li></a>
                    <a href='atslegties.php'><li>Atslēgties</li></a>";
                }else{
                    echo "
                    <a href='konts.php'><li>Pieslēgties</li></a>";
                }
            ?>
        </ul>
    </div>
    <label for="Nav_Poga">
        <span></span>
    </label>
</div>