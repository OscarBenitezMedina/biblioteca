<?php
include "base_datos.php";
    $categorias = $miPDO->prepare('SELECT * FROM categorias;');
    $categorias->execute();
    $autores = $miPDO->prepare('SELECT * FROM autores;');
    $autores->execute();

     
?>
<select name="categoria" class="form-select">
                <option>Seleccione categoría</option>
                <?php foreach ($categorias as $categoria){ ?>
                    <option value="<?= $categoria['codigo_categoria']; ?>"> <?= $categoria['nombre']; ?></option>
                <?php } ?>
            </select>