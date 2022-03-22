while (($colonne = fgetcsv($file, 10000, ";")) !== FALSE) {
      $sql = "INSERT into categorie (idCategorie,libelle)
             values ('" . $colonne[0] . "','" . $colonne[1] . "')";

      $Sql2 = "INSERT into produit (idProduit,Reference,idCategorie,Libelle,Description,UniteStock,NombreStock,PrixUnitaire)
        values ('" . $colonne[2] . "','" . $colonne[3] . "','" . $colonne[4] . "','" . $colonne[5] . "','" . $colonne[6] . "','" . $colonne[7] . "','" . $colonne[8] . "','" . $colonne[9] . "')";

      //echo $colonne[2];
      $result = mysqli_query($conn, $sql);

      if (!empty($result)) {
        $type = "success";
        $message = "Les Données sont importées dans la base de données";
      } else {
        $type = "error";
        $message = "Problème lors de l'importation de données CSV";
      }
    }
    mysqli_close($conn);
    while (($colonne = fgetcsv($file, 10000, ";")) !== FALSE) {


      $Sql2 = "INSERT into produit (idProduit,Reference,idCategorie,Libelle,Description,UniteStock,NombreStock,PrixUnitaire)
        values ('" . $colonne[2] . "','" . $colonne[3] . "','" . $colonne[4] . "','" . $colonne[5] . "','" . $colonne[6] . "','" . $colonne[7] . "','" . $colonne[8] . "','" . $colonne[9] . "')";

      $resultProduit = mysqli_query($conn, $sql2);
      if (!empty($resultProduit)) {
        echo "importaion reussi";
      } else {
        echo " echec";
      }
    }
  }