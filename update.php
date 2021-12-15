<?php
// Si on clique sur le bouton (en gros)
if(isset($_POST['update_button']))
{
	// Si il y a des valeurs dans le champs de formulaire quand on déclenche la méthode post
	if(isset($_POST['update_firstname']) && isset($_POST['update_lastname']) && isset($_POST['update_id']))
	{
		// Si les valeurs dans le champs de formulaire quand on déclenche la méthode post ne sont pas vide
		if(!empty($_POST['update_firstname']) && !empty($_POST['update_lastname']) && !empty($_POST['update_id']))
		{
			// On attribue les datas aux valeurs présentent dans le formulaire au moment de la méthode poste
			$data['edit_firstname'] = $_POST['update_firstname'];
			$data['edit_lastname'] = $_POST['update_lastname'];
			$data['edit_id'] = $_POST['update_id'];
			
			// On require le modèle
			require_once 'model.php';

			// On crée une nouvelle instance de modèle
			$model = new Model();
			
			// On update l'enregistrement
			$update = $model->update($data);		
		}
		else
		{
			// On déclenche une alerte en cas de valeur vide
			echo '<script> alert("Tous les champs sont requis"); </script>' ;
		}
	}
}

?>