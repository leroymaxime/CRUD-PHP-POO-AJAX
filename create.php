<?php

// On require une fois le modèle
require_once 'model.php';

// On crée une nouvelle instance de modèle
$model = new Model();

// On insère la donnée
$create = $model->insert();

?>