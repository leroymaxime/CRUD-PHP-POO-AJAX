<?php 

	Class Model
	{
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $database = 'crud_app_db';
		private $connection;

		// Création de la connexion à la base de données
		public function __construct()
		{
			try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
		}

		// On insère le nouvel enregistrement de l'étudiant dans la base de données et gérer la demande ajax
		public function insert()
		{
			if(isset($_POST['insertbutton']))
			{
				if(isset($_POST['studentfirstname']) && isset($_POST['studentlastname']))
				{
					if(!empty($_POST['studentfirstname']) && !empty($_POST['studentlastname']))
					{
						$firstname = $_POST['studentfirstname'];
						$lastname = $_POST['studentlastname'];
						
						$insert_stmt=$this->connection->prepare('INSERT INTO tbl_student(firstname, 
																						 lastname) 
																					 VALUES
																						 (:fname,
																						  :lname)');
						$insert_stmt->bindParam(':fname',$firstname);
						$insert_stmt->bindParam(':lname',$lastname);
						
						if($insert_stmt->execute()) 
						{
							echo '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong> Succès : La données à bien été insérée </strong>
								  </div>';
						}
						else
						{
							echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Echec : La données n\'a pas été insérée </strong>
								 </div>' ;
						}		
					}
					else
					{
						echo '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong> Erreur : Tous les champs sont requis </strong>
							</div>' ;
					}
				}
			}
		}

		// Récupérer tous les enregistrements des étudiants de la base de données et gérer la demande ajax
		public function fetchAllRecords()
		{
			
			$data = null;

			$select_stmt = $this->connection->prepare('SELECT * FROM tbl_student');
			
			$select_stmt->execute();
			
			$data = $select_stmt->fetchAll();
			
			return $data;
		}

		// Récupérer un enregistrements de la base de données et gérer la demande ajax
		public function deleteRecords($delete_id)
		{
			$delete_stmt = $this->connection->prepare('DELETE FROM tbl_student WHERE student_id = :sid ');
			$delete_stmt->bindParam(':sid',$delete_id);
			
			if ($delete_stmt->execute()) 
			{
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong> Succès : La donnée à été supprimée </strong>
					 </div>';
			}
			else
			{
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Echec : La donnée ne s\'est pas supprimée </strong>
					  </div>' ;
			}
		}

		// Récupérer les données de l'étudiant dans la base de données et gérer la demande ajax
		public function edit($update_id)
		{
			$data = null;

			$edit_stmt = $this->connection->prepare('SELECT * FROM tbl_student WHERE student_id = :sid');
			$edit_stmt->bindParam(':sid',$update_id);
			
			$edit_stmt->execute();
			
			$data = $edit_stmt->fetch(); 
			
			return $data;
		}

		// Update les données de l'étudiant dans la base de données et gérer la demande ajax
		public function update($data)
		{
			$update_stmt=$this->connection->prepare('UPDATE tbl_student SET firstname=:fname, 
																			lastname=:lname 
																		WHERE 
																		    student_id=:id');
			$update_stmt->bindParam(':fname',$data['edit_firstname']);
			$update_stmt->bindParam(':lname',$data['edit_lastname']);
			$update_stmt->bindParam(':id',$data['edit_id']);
						
			if($update_stmt->execute())
			{
				echo '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong> Succèes : Donnée modifiée avec succès </strong>
					  </div>
					  
					  <script> $("#updateModal").modal("hide"); </script> ';
					  
			}
			else
			{
				echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Echec : La mise à jour n\'a pas été effectuée </strong>
					  </div>' ;
			}
		}
	}
 ?>