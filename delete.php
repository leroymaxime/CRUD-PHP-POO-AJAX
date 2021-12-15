<?php
// On require une fois le modèle
require_once 'model.php';

// On attribue la valeur de ce qui à été posté dans une variable
$delete_id = $_POST['studentdelete_id'];

// On crée une nouvelle instance de modèle
$model = new Model();

// On supprime l'enregistrement
$delete = $model->deleteRecords($delete_id);

?>
