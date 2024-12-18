<?php
    foreach ($city as $row) {
 ?>
        <option value="<?= $row['city_name'] ?>"><?= $row['city_name'] ?></option>
    <?php
    }
    ?> 