<option value="">Medida</option>
<?php foreach($medidas as $medida){ ?>
    <option value="<?= $medida->id ?>" data-precio="<?= $medida->precio ?>">
        <?= $medida->medidas ?>
    </option>
<?php } ?>
