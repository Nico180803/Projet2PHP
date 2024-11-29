<?php
if (isset($_POST['mdp'])){
    $bdd = new PDO('mysql:host=localhost;dbname=tp1;charset=utf8','root','');

    $req = $bdd -> prepare('SELECT * FROM inscrit WHERE email = :email AND mdp = :mdp');
    $req -> execute(array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp']
    ));
    $donnee = $req -> fetch();
    session_start();
    $_SESSION['nom'] = $donnee['nom'];
    if ($donnee == $_POST['email'] && $donnee == $_POST['mdp']){
        echo "erreur, votre compte n'existe pas";
        session_destroy();
    }
    else{
        header("location:session.php");
    }
}
?>
