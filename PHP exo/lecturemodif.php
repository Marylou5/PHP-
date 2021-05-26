<?php
$servername = "http://127.0.0.1/";
$username = "root";
$password = "";
$dbname = "lecture";

// Création de la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Tester la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Après appel de la page on récupéré l'id du livre en question (isset verifie si variable declaré)
if(isset($_GET["id"])){
	//protection de données
	$idm = mysqli_real_escape_string($conn,$_GET["id"]); // verification de la chaine de caractere rentrer
	$sql = "SELECT * FROM lecture WHERE id=$idm";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	  include('location:lecturedonne.php'); // header = appel fichier php 
        else
		include('location:lectureenvoie.php');
    
    // Après clic sur le bouton modifier on récupère les données envoyées par la méthode post
 if(count($_POST)>3) {
	$titre = mysqli_real_escape_string($conn,$_POST["titre"]);
	$auteur = mysqli_real_escape_string($conn, $_POST["auteur"]);
	$date = mysqli_real_escape_string($conn, $_POST["date"]);
	$id=mysqli_real_escape_string($conn, $_POST["id"]);
	$sql = "update  livre set titre='{$titre}' , auteur='{$auteur}', date_creation='{$date}' 
     WHERE id=$id";
    //executer le requete de l'update et redirection vers la page lecture.php
	if (mysqli_query($conn, $sql)) {
    	$message= "Le livre à était enregistré avec succes";
	} else {
    	$message = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	header("Location:lecture.php?message=$message"); //retour au formulaire
}

        ?>
<!--  Afficher le formulaire rempli par les données du livre récupéré en haut.-->
        <form name="livre" action="lecturemodif.php" method="post">
      		<fieldset>
      			<legend>Modifier liste de lecture</legend>
      			<input type="hidden" id="id" name="id" value="<?php if(isset($id)) { echo $id; } ?>"><br/>
      			<label for="titre">Titre du livre</label>
      			<input type="text" id="titre" name="titre" required value="<?php if(isset($titre)) { echo $titre; } ?>"><br/>
      			<label for="auteur">Auteur du livre</label>
      			<input type="text" id="auteur" name="auteur" required value="<?php if(isset($auteur)) { echo $auteur; } ?>"><br/>
      			<label for="date">Date creation</label>
      			<input type="date" id="date" name="date" required value="<?php if(isset($date)) { echo $date; } ?>"><br/>
      			<input Type="submit" value="Modifier">
      		</fieldset>
      </form>
