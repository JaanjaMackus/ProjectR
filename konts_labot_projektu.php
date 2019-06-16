<?php include('konts_labot_projektu_parbaude.php');?>

<div class="Smalks_Pilns_1_5">
    <?php
    
    $sakne = $_SERVER["DOCUMENT_ROOT"]."/prodata";
    
    if(isset($_POST['Labot_Dalibnieku']) || isset($_POST['Pievienot_Dalibnieku'])){
        //saglabā sesijā lai nepazaudētu pagaidu izmaiņas
        $_SESSION['Projekta_Nosaukums'] = $_POST['Nosaukums'];
        $_SESSION['Projekta_Apraksts_Iss'] = $_POST['Apraksts_Iss'];
        $_SESSION['Projekta_Apraksts'] = $_POST['Apraksts'];
        if(isset($_POST['Labot_Dalibnieku'])){
            echo "<h3>Projekta dalībnieka labošana</h3>";
            if(count($Kludas)>0){
                foreach ($Kludas as $Kluda){
                      echo "<p class='kluda'>$Kluda</p>";
                }
            }

            $ID_Projekts = $_GET['labot'];
            $ID_Dalibnieks = $_POST['Labot_Dalibnieku'];
            mysqli_set_charset($Datu_Baze,"utf8");
            $Pieprasijums = "SELECT * FROM dalibnieks WHERE ID_Projekts= '$ID_Projekts' AND ID_Dalibnieks='$ID_Dalibnieks'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            $Dalibnieks = mysqli_fetch_assoc($Rezultats);
            if($Dalibnieks){
                $_SESSION['Dalibnieks_ID'] = $Dalibnieks['ID_Dalibnieks'];

                ?>
                <form class="Atstarpe_Apaksa" method="post">
                    <h2>Vārds</h2>
                    <input value="<?php echo $Dalibnieks['Vards']; ?>" type="text" name="Vards" class="Ievade_Ievads" placeholder="Vārds" autofocus required>
                    <h2>Uzvārds</h2>
                    <input value="<?php echo $Dalibnieks['Uzvards']; ?>" type="text" name="Uzvards" class="Ievade_Ievads" placeholder="Uzvārds" required>
                    <h2>Apraksts</h2>
                    <textarea type="text" name="Apraksts" class="Ievade_Gars Ievade_Ievads" placeholder="Apraksts līdz 500 simboliem" required><?php echo $Dalibnieks['Apraksts']; ?></textarea>
                    <input type="submit" name="Saglabat_Dalibnieku" value="Labot dalībnieku" class="Ievade_Poga">
                </form>
    <a class="Pievienot_poga Atcelt_Poga" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Atcelt</a>

                <?php


            }else{
                echo "<h3>Jūs nevarat labot projektu, kas nepieder jums</h3>";
            }


        }else{
            echo "<h3>Projekta dalībnieka pievienošana</h3>";
            if(count($Kludas)>0){
                foreach ($Kludas as $Kluda){
                      echo "<p class='kluda'>$Kluda</p>";
                }
            }
            
            $ID_Projekts = $_GET['labot'];
            ?>
            <form class="Atstarpe_Apaksa" method="post">
                <h2>Vārds</h2>
                <input value="" type="text" name="Vards" class="Ievade_Ievads" placeholder="Vārds" autofocus required>
                <h2>Uzvārds</h2>
                <input value="" type="text" name="Uzvards" class="Ievade_Ievads" placeholder="Uzvārds" required>
                <h2>Apraksts</h2>
                <textarea type="text" name="Apraksts" class="Ievade_Gars Ievade_Ievads" placeholder="Apraksts līdz 500 simboliem" required></textarea>
                <input type="submit" name="Saglabat_Pievienoto_Dalibnieku" value="Pievienot dalībnieku" class="Ievade_Poga">
                
            </form>
<a class="Pievienot_poga Atcelt_Poga" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Atcelt</a>
            <?php
            
        }
           
           
    }else if(isset($_GET['labot'])){
        $ID_Projekts = $_GET['labot'];
        mysqli_set_charset($Datu_Baze,"utf8");
        // Projekta datu iegūšana
        
        //ja ir pagaidu dati
        if(isset($_SESSION['Projekta_ID']) && $_SESSION['Projekta_ID'] == $ID_Projekts){
            $Nosaukums = $_SESSION['Projekta_Nosaukums'];
            $Apraksts_Iss = $_SESSION['Projekta_Apraksts_Iss'];
            $Apraksts = $_SESSION['Projekta_Apraksts'];
            include('konts_labot_projektu_forma.php');
        }else{
            $Pieprasijums = "SELECT * FROM projekts WHERE ID_Projekts='$ID_Projekts'";
            $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
            $Projekts = mysqli_fetch_assoc($Rezultats);
            if($Projekts){
                $E_Pasts = $_SESSION['E_Pasts'];
                mysqli_set_charset($Datu_Baze,"utf8");
                $Pieprasijums = "SELECT * FROM konts WHERE E_Pasts= BINARY '$E_Pasts'";
                $Rezultats = mysqli_query($Datu_Baze, $Pieprasijums);
                $Lietotajs = mysqli_fetch_assoc($Rezultats);
                if($Lietotajs){
                    if($Lietotajs['ID_Konts'] == $Projekts['ID_Konts']){
                        $Nosaukums = $Projekts['Nosaukums'];
                        $Apraksts_Iss = $Projekts['Apraksts_Iss'];
                        $Apraksts = $Projekts['Apraksts'];
                        $_SESSION['Projekta_ID'] = $ID_Projekts;
                        $_SESSION['Projekta_Nosaukums'] = $Nosaukums;
                        $_SESSION['Projekta_Apraksts_Iss'] = $Apraksts_Iss;
                        $_SESSION['Projekta_Apraksts'] = $Apraksts;
                        include 'konts_labot_projektu_forma.php';
                    }else{
                        echo "<h3>Jūs nevarat labot projektu, kas nepieder jums</h3>";
                    }
                }   
            }else{
            echo "Neizdevās atrast izvēlēto projektu, mēģiniet vēlreiz";
            }
        }
    }else{
        echo "Neizdevās iegūt projektu labošanai, mēģiniet vēlreiz";
    }
    ?>
    
</div>
