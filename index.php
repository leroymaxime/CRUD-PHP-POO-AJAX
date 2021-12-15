<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>CRUD en PHP avec POO et AJAX</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<div class="col-lg-12">
		  		<h2>Ajouter une données</h2>
			
			<form id="insert_form" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">Nom</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="txt_firstname" placeholder="enter firstname" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Prénom</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="txt_lastname" placeholder="enter lastname" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6 m-t-15">
						<button type="submit" id="btn_create" class="btn btn-success">Ajouter</button>
					</div>
				</div>
			</form>
			<div class="col-lg-12">
				<div id="message"></div>
				<div id="fetch"></div>
			</div>
		</div>
	</div>	
</div>
	
	<!-- Modal pour update -->
	
	<div class="modal fade" id="updateModal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Update Record</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			<div id="update_data"></div>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" id="btn_update" class="btn btn-primary">Update</button>
		  </div>

		</div>
	  </div>
	</div>
	
	<!-- Fin modal update -->
	
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script>
	
		// Créer un nouvel enregistrement
		
		// Quand on clique sur le bouton, on déclenche la fonction
		$(document).on('click','#btn_create',function(e){
			// On retire le comportement par défault du lien (ajouter le # dans la barre d'adresse et rafraichir la page)
			e.preventDefault();
			
			// On attribue les valeurs des id à une variable
			var firstname = $('#txt_firstname').val();
			var lastname = $('#txt_lastname').val();
			var create = $('#btn_create').val();
			
			// On fait notre appel en ajax
			$.ajax({
				url: 'create.php', // On appel l'url
				type: 'post', // Method post du formulaire
				data: 
					{studentfirstname:firstname, 
					 studentlastname:lastname, 
					 insertbutton:create
					},
				success: function(response){ // En cas de succès on déclenche la fonction
					fetch(); // Va chercher
					$('#message').html(response); // Envoie le message de réponse
				}
			});
			
			$('#insert_form')[0].reset(); // Reset du formulaire
			
		});
		
		// Va chercher tous les enregistrement
		
		function fetch(){
			
			$.ajax({
				url: 'read.php',
				type: 'post',
				success: function(response){
					$('#fetch').html(response);
				}
			});
		}
		
		fetch();
		
		// Supprime un enregistrement
		
		$(document).on('click','#delete',function(e){
			
			e.preventDefault();
			
			if(window.confirm('are you sure to delete data'))
			{
				var delete_id = $(this).attr('value'); 
			
				$.ajax({
					url: 'delete.php',
					type: 'post',
					data:{studentdelete_id:delete_id},
					success: function(response){
						fetch();
						$('#message').html(response);
					}
				});				
			}
			else
			{
				return false;
			}
		});
		
		// Obtenir un enregistrement d'identification spécifique ou modifier l'enregistrement 
		
		$(document).on('click','#edit', function(e){
			
			e.preventDefault();
			
			var update_id = $(this).attr('value');
			
			$.ajax({
				url: 'edit.php',
				type: 'post',
				data: {studentupdate_id:update_id},
				success: function(response){
					$('#update_data').html(response);
				}
			});
			
		});
		
		// Update enregistrement
		
		$(document).on('click','#btn_update',function(e){
			
			e.preventDefault();
			
			var firstname = $('#edit_firstname').val();
			var lastname = $('#edit_lastname').val();
			var edit_id = $('#edit_id').val();
			var update_btn = $('#btn_update').val();
			
			$.ajax({
				url: 'update.php',
				type: 'post',
				data: 
					{update_firstname:firstname, 
					 update_lastname:lastname, 
					 update_id:edit_id,
					 update_button:update_btn
					},
				success: function(response){
					fetch();
					$('#message').html(response);
				}
			});
			
		});
		
	</script>
	
	</body>
</html>

