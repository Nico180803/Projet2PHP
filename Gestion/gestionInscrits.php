<?php
if (isset($_POST['mdp'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=mls_projet2;charset=utf8', 'root', '');

    $req = $bdd->prepare('SELECT email FROM Inscrit');
    $req->execute();
    $mail = $req->fetchAll();

    var_dump($mail);
    var_dump($_POST);

    for ($i = 0; $i < count($mail); $i++) {
        if ($mail[$i]['email'] == $_POST['email']) {
            var_dump($mail[$i]['email']);
            echo count($mail);
            header('location: ../inscription.php?erreur=Cette Adresse Mail est déja associé à un compte !');
            exit();
        }
    }
        $req = $bdd->prepare('INSERT INTO inscrit(nom, prenom, email, tel_fixe, tel_portable, rue, cp, ville, mdp) VALUES(:nom, :prenom, :email, :tel_fixe, :tel_portable, :rue, :cp, :ville, :mdp)');
        $req->execute(array(
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

        $req->closeCursor();
        header("location:../inscription.php?confirm=Inscription bien prise en compte !");
}
?>
