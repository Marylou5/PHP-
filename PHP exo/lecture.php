<!doctype html>
<html>
<head>
	<title>Liste de lecture</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/lecture.css">
	</style>
</head>
<body>



<?php
$servername = "http://127.0.0.1/";
$username = "root";
$password = "";
$dbname = "lecture";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("erreur de connexion: " . mysqli_connect_error());
}

if(count($_POST)>2) {
	
	$titre = mysqli_real_escape_string($conn,$_POST["titre"]);
	$auteur = mysqli_real_escape_string($conn, $_POST["auteur"]);
	$date = mysqli_real_escape_string($conn, $_POST["date"]);
	$sql = "INSERT INTO lecture (titre, auteur, date)
	VALUES ('{$titre}', '{$auteur}', '{$date}')"; //values = ce qui va apparaitre a l'ecran

	if (mysqli_query($conn, $sql)) {
    	$message= "Le livre a été ajouté  avec succès";
	} else {
    	$message = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
if(isset($_GET["message"])){
	$message=$_GET["message"];
}


 if(isset($message)) { echo "<div class='message'>".$message."</div>"; } ?>
	<div class="frm">
		
	
      <form name="lecture" action="lecture.php" method="post">
      	<fieldset> 
      		<legend>Ajouter un livre</legend>
      	
      	<label for="titre">Titre du livre</label>
      	<input type="text" id="titre" name="titre" required autofocus><br/>
      	<label for="auteur">Auteur du livre</label>
      	<input type="text" id="auteur" name="auteur" required><br/>
      	<label for="date">Date de lecture</label>
      	<input type="date" id="date" name="date" required placeholder="YYYY/MM/DD"><br/>
      	<input Type="submit" value="Envoyer">
      	</fieldset>
      </form>

      </div>
      
      <div class="grid">
      	<table  cellspacing="0">
      		<thead>
      			<tr>
      				<th>titre</th>
      				<th>auteur</th>
      				<th>date</th>
      			</tr>
      		</thead>
      		<tbody>  <!-- fermeture du tableau -->

      			<?php
     	 			$sql = "SELECT * FROM lecture";
		 			  $result = mysqli_query($conn, $sql);
             
					
				?>
      		</tbody>
      	</table>
      </div>

</body>
</html>
