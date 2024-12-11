<?php
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

var_dump($_POST);

if (isset($_POST['supprimer'])){
    $requete = $bdd->prepare('DELETE FROM auteur WHERE id_auteur=:id_auteur');
    $requete->execute(array('id_auteur' => $_POST['auteur']));
    $requete->closeCursor();
    header('Location: .././listeAuteur.php');
}
if (isset($_POST['modifier'])){}