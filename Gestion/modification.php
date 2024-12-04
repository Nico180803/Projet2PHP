<?php
session_start();
var_dump($_POST);
var_dump($_SESSION);
$bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8','root','');
if(isset($_POST['modifierProfil'])){
    $requete = $bdd->prepare('UPDATE inscrit SET nom =:nom, prenom = :prenom, email = :email, tel_fixe = :telFixe, tel_portable = :telPortable, rue = :rue, cp= :cp,ville= :ville WHERE id_inscrit =:id');
    $requete->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'telFixe' => $_POST['tel_fixe'],
        'telPortable' => $_POST['tel_portable'],
        'rue' => $_POST['rue'],
        'cp' => $_POST['cp'],
        'ville' => $_POST['ville'],
        'id' => $_SESSION['id_inscrit']
    ));
    $requete->closeCursor();
    header('Location: ../profil.php');
}
if(isset($_POST['modifierMdp'])){
    $requete = $bdd->prepare('SELECT mdp FROM inscrit WHERE id_inscrit =:id');
    $requete->execute(array(
        'id' => $_SESSION['id_inscrit']
    ));
    $mdp=$requete->fetch();
    $requete->closeCursor();
    if($_POST['oldMdp'] != $mdp['mdp'] || $_POST['newMdp'] != $_POST['confirmNewMdp']){
        header('Location: ../profil.php?erreur=Erreur mot de passe incorrect ou le nouveau mot de passe ne correspond pas');
    }
    else{
        $requete = $bdd->prepare('UPDATE inscrit SET mdp = :mdp WHERE id_inscrit =:id');
        $requete->execute(array(
            'mdp' => $_POST['newMdp'],
            'id' => $_SESSION['id_inscrit']
        ));
        $requete->closeCursor();
        header('Location: ../profil.php');
    }
}