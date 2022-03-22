<?php
// Connect to database
include("db_connection.php");

if (isset($_POST["import"])) {

  $nomFichier = $_FILES["file"]["tmp_name"];

  if ($_FILES["file"]["size"] > 0) {

    $file = fopen($nomFichier, "r");

    while (($colonne = fgetcsv($file, 10000, ";")) !== FALSE) {
      // $resultProduit = mysqli_query($conn, $Sql2);
    /*  $id = 1;
      $libelle = $colonne[2];

      $reference = $colonne[0];
      $libelleProduit = $colonne[1];
      $description = $colonne[3];
      $uniteS = $colonne[4];
      $nombreStock = $colonne[5];
      $prixUnitaire = $colonne[6];

      $quantite = $colonne[7];
      $dateE = $colonne[8];
      $sql = $mysqli->prepare("INSERT INTO categorie VALUES (?)") or die(mysqli_error($mysqli));
      $sql->bind_param('ss', $libelle);

      if ($sql->execute()) {
        // recuperation du dernier IDELEVE inséreé dans la table eleves
        $idCategorie = $sql->insert_id;
        $id++;
        // Insertion dans la table inscription
        $int = $mysqli->prepare("INSERT INTO produit (reference,idCategorie,libelle,description,uniteStock,nombreStock,prixUnitaire) VALUES (?,?,?,?,?,?,?)") or die(mysqli_error($mysqli));
        $int->bind_param('sssd', $reference, $idCategorie, $libelleProduit, $description, $uniteS, $nombreStock, $prixUnitaire);

        if ($int->execute()) {
          $stock =  $mysqli->prepare("INSERT INTO stock (reference,quantite,date_peremption) VALUES (?,?,?)") or die(mysqli_error($mysqli));
          $stock->bind_param('ssss', $reference, $quantite, $dateE);

          if ($stock->execute()) {
            echo "Tous les donnees sont enregistres avec success";
          } else {
            die('Impossible d\'insérer les donnée dans la troisieme table (stock). ' . mysqli_error($mysqli));
          }
        } else {
          die('Impossible d\'insérer les donnée dans la deuxième table (produit). ' . mysqli_error($mysqli));
        }
      } else {
        die('Impossible d\'insérer dans la table premiere table: categorie ' . mysqli_error($mysqli));
      }
*/
      // //echo $colonne[2];
      // $result = mysqli_query($conn, $sql);

      // $Sql2 = "INSERT into produit (idProduit,reference,idCategorie,libelle,description,uniteStock,nombreStock,prixUnitaire)
      // values ('" . $colonne[2] . "','" . $colonne[3] . "','" . $colonne[4] . "','" . $colonne[5] . "','" . $colonne[6] . "','" . $colonne[7] . "','" . $colonne[8] . "','" . $colonne[9] . "')";



      // if (!empty($result)) {
      //   $type = "success";
      //   $message = "Les Données sont importées dans la base de données";
      // } else {
      //   $type = "error";
      //   $message = "Problème lors de l'importation de données CSV";
      // }

      // if (!empty($resultProduit)) {
      //   echo "importaion reussi";
      // } else {
      //   echo " echec";
      // }
    }
  }
}
//Retourner à la page index.php
header('Location: index.php');
exit;
