<?php include('konts_pievienot_projektu_parbaude.php');?>

<div class="Pievienot_forma_konts">
    <h3 class="Atstarpe_Auksa">Jauna projekta pievienošana</h3>
    <?php if(count($Kludas)>0){
    foreach ($Kludas as $Kluda){
          echo "<p class='kluda'>$Kluda</p>";
    }
    } ?>
    <form method="post">
        <h2>Nosaukums</h2>
        <input value="<?php echo $Nosaukums ?>" type="text" name="Nosaukums" class="Ievade_Ievads" placeholder="Nosaukums" autofocus required>
        <h2>Īss apraksts</h2>
        <textarea value="<?php echo $Apraksts_Iss ?>" type="text" name="Apraksts_Iss" class="Ievade_Gars Ievade_Ievads" placeholder="Īss apraksts līdz 500 simboliem" required></textarea>
        <h2>Pilns apraksts</h2>
        <textarea value="<?php echo $Apraksts ?>" type="textarea" name="Apraksts" class="Ievade_Gars Ievade_Ievads" placeholder="Pilns apraksts" required></textarea>
        <input type="submit" name="izveidot_projektu" value="Izveidot projektu un turpināt" class="Ievade_Poga">
    </form>
    <span class="Atstarpe_Auksa"></span>
</div>