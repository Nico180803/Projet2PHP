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
    header('Location: ../profil.php');
}
