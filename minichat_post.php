<?php
// On démarre l'enregistrement de la session 
session_start();
?>

<?php
// Cookies pseudo
if (isset($_POST['pseudo'])) 
$_SESSION['pseudo'] = $_POST['pseudo'];

// Message d'erreur
$erreur = "Désolé, il y a une erreur... Vous devez indiquez un un pseudo et un message.";

// Si pas de pseudo ou pas de message, on affiche un message d'erreur
if (empty($_POST['pseudo']) OR empty($_POST['message'])) 
	{ 
		echo $erreur;
	}
	else 
	{
		// Si pseudo et message, on se connecte à la base de donnée
		try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
		}
			// Si erreur -> on affiche un message
			catch (Exception $e)
			{
			    die('Erreur : ' . $e->getMessage());
			} 
			// Si les champs sont complet...
		   if(isset($_POST['pseudo']) AND isset ($_POST['message']))
		    	{
				// ...On insère des donnée dans la table minichat
				$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(?, ?)');
				$req->execute(array($_POST['pseudo'], $_POST['message']));
				// Et on redirige le tout vers minichat.php :
				 header('Location: minichat.php');
				}
		}
?>