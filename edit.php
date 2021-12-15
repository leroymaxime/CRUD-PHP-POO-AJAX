<?php
// On require une fois le modèle
require_once 'model.php';

// On attribue la valeur de ce qui à été posté dans une variable
$update_id = $_POST['studentupdate_id'];

// On crée une nouvelle instance de modèle
$model = new Model();

// On update l'enregistrement
$row = $model->edit($update_id);

// Si la donnée n'est pas vide on affiche le formulaire
if(!empty($row))
{
?>

	<form id="edit_form" method="post" class="form-horizontal">
					
		<div class="form-group">
		<label class="col-sm-3 control-label">Firstname</label>
		<div class="col-sm-6">
		<input type="text" class="form-control" id="edit_firstname" value="<?php echo $row['firstname']; ?>" placeholder="enter firstname" />
		</div>
		</div>
				
		<div class="form-group">
		<label class="col-sm-3 control-label">Lastname</label>
		<div class="col-sm-6">
		<input type="text" class="form-control" id="edit_lastname" value="<?php echo $row['lastname']; ?> " placeholder="enter lastname" />
		</div>
		</div>
		
		<input type="hidden" id="edit_id" value="<?php echo $row['student_id']; ?>">
				
	</form>
	
<?php
}

?>