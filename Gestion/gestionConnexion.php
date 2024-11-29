<?php
if (isset($_POST['mdp'])){
    $bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8','root','');

    $req = $bdd -> prepare('SELECT * FROM inscrit WHERE email = :email AND mdp = :mdp');
    $req -> execute(array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp']
    ));
    $donnee = $req -> fetch();
    session_start();
    $_SESSION['id'] = $donnee['id_inscrit'];
    $_SESSION['nom'] = $donnee['nom'];
    if ($donnee ['email'] == $_POST['email'] && $donnee['mdp'] == $_POST['mdp']){
        header("location:../index.php");
    }
    else{
        session_destroy();
        header("location:../connexion.php?erreur = Erreur, mail ou mot de passe incorrect");
    }
}
?>
