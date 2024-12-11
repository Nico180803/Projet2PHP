<?php
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['supprimer'])){
    var_dump($_POST);
    $requete = $bdd->prepare('DELETE FROM auteur WHERE id_auteur=:id_auteur');
    $requete->execute(array('id_auteur' => $_POST['auteur']));
    $requete->closeCursor();
    header('Location: .././listeAuteur.php');
}
if (isset($_POST['modifier'])){
    var_dump($_POST);
    $requete = $bdd->prepare('UPDATE auteur SET nom = :nom, prenom = :prenom, date_naissance = :date, ref_pays = :pays WHERE id_auteur= :id ');
    $requete->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'date' => $_POST['naissance'],
        'pays' => $_POST['pays'],
        'id' => $_POST['auteur']
    ));
    $requete->closeCursor();
    header('Location: .././listeAuteur.php');
}
if (isset($_POST['ajout'])){
    var_dump($_POST);
    $requete = $bdd->prepare('INSERT INTO auteur( nom, prenom, date_naissance, ref_pays) VALUES (:nom, :prenom, :date, :pays)');
    $requete->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'date' => $_POST['date'],
        'pays' => $_POST['pays']
    ));
    $requete->closeCursor();


    header('Location: ../listeAuteur.php');
}