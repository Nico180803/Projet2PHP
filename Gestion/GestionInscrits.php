<?php
if (isset($_POST['mdp'])){
    $bdd = new PDO('mysql:host=localhost;dbname=tp1;charset=utf8','root','');

    $req = $bdd -> prepare('INSERT INTO inscrit(nom, prenom, email, tel_fixe, tel_portable, rue, cp, ville, mdp) VALUES(:nom, :prenom, :email, :tel_fixe, :tel_portable, :rue, :cp, :ville, :mdp)');
    $req -> execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'tel_fixe' => $_POST['tel_fixe'],
        'tel_portable' => $_POST['tel_portable'],
        'rue' => $_POST['rue'],
        'cp' => $_POST['cp'],
        'ville' => $_POST['ville'],
        'mdp' => $_POST['mdp']
    ));

    $req -> closeCursor();
}
?>
