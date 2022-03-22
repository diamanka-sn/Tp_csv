
<?php
$pdo = new PDO(
    'mysql:host=localhost;dbname=bdsuperette;charset=UTF8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

if (isset($_POST["import"])) {

    $nomFichier = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($nomFichier, "r");

        while (($colonne = fgetcsv($file, 10000, ";")) !== FALSE) {
            $libelle = $colonne[2];
            $reference = $colonne[0];
            $libelleProduit = $colonne[1];
            $description = $colonne[3];
            $uniteS = $colonne[4];
            $nombreStock = $colonne[5];
            $prixUnitaire = $colonne[6];

            $quantite = $colonne[7];
            $dateE = $colonne[8];

            $requette = $pdo->prepare("SELECT idCategorie FROM categorie WHERE libelle=? limit 1");
            $requette->execute([$libelle]);
            $user = $requette->fetch();
            if ($user) {
                $idCa = $user['idCategorie'];
            } else {
                $newAuthor = 'INSERT IGNORE INTO categorie(libelle)
                VALUES (?)';

                $requette = $pdo->prepare($newAuthor);
                $requette->execute(array($libelle));

                $idCa = $pdo->lastInsertId();
            }

            $insertionProduit = 'INSERT INTO produit (reference,idCategorie,libelle,description,uniteStock,nombreStock,prixUnitaire)  VALUES (:reference,:idCategorie,:libelle,:description,:uniteStock,:nombreStock,:prixUnitaire)';

            $requette = $pdo->prepare($insertionProduit);
            $requette->execute(array(':reference' => $reference, ':idCategorie' => $idCa, ':libelle' => $libelleProduit, ':description' => $description, ':uniteStock' => $uniteS, ':nombreStock' => $nombreStock, ':prixUnitaire' => $prixUnitaire));

            $categorie_id = $pdo->lastInsertId();


            $insertionStock = 'INSERT INTO stock (reference,quantite,date_peremption) VALUES (?, ?, ?)';

            $requette = $pdo->prepare($insertionStock);
            $requette->execute(array($reference, $quantite, $dateE));


            $sql = "DELETE FROM `categorie` WHERE `libelle` = :libelle";
            $stmt = $pdo->prepare($sql);
            $l = 'Categorie';
            $stmt->bindValue(':libelle', $l);
            $res = $stmt->execute();


            $sql1 = "DELETE FROM `produit` WHERE `reference` = :reference";
            $stmt1 = $pdo->prepare($sql1);
            $p = 'Reference';
            $stmt1->bindValue(':reference', $p);
            $res = $stmt1->execute();

            $sql2 = "DELETE FROM `stock` WHERE `reference` = :reference";
            $stmt2 = $pdo->prepare($sql2);
            $s = 'Reference';
            $stmt2->bindValue(':reference', $s);
            $res = $stmt2->execute();
        }
    }
}
header('Location: index.php');
exit;
