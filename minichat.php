<?php // On démarre l'enregistrement de la session 
session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Mini-chat</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.png" />
</head>

<body>

<form method="post" action="minichat_post.php">
    <label for="pseudo">
        <input 
        	type="text" 
        	name="pseudo" 
        	placeholder="Votre pseudo" 
        	value="
        	<?php
			if (isset($_SESSION['pseudo']))
			    echo $_SESSION['pseudo'];?>"
		/>
    </label>
    <label for="message">
        <textarea name="message" placeholder="Votre message" rows="8" cols="45"></textarea>
    </label>
    <input type="submit" value="Valider" />
</form>

<?php
// On se connecte à la DB avec PDO
try {
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
// Si erreur -> on affiche un message
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// On affiche les 10 derniers messages de la DB     
$reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 5');
while ($donnees = $reponse->fetch()) {
    $message = ($donnees['message']);
    echo htmlspecialchars($donnees['pseudo']);
    echo htmlspecialchars($message);
}

// On ferme la requette    
$reponse->closeCursor();
?>

<p>Made with All The <img src="images/heart.png"> In The World.</p>

</body>

</html>