<?php
{
    	// Récupérer des informations du livre en question qui seront par la suite afficher dans le formulaire en bas
        $row = mysqli_fetch_assoc($result); //pour aller a la prochaine ligne dans la BD
        $id=$row["id"];
        $titre=$row["titre"];
        $auteur=$row["auteur"];
        $date=$row["date"];
    }  