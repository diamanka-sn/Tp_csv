<!DOCTYPE html>
<html>

<head>
    <title>Importer fichier csv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <form class="row g-3" enctype="multipart/form-data" action="importer.php" method="post">
            <div class="col-auto">
                <input class="form-control" type="file" name="file" id="file" accept=".csv">
            </div>
            <div class="col-auto">
                <button type="submit" id="submit" name="import" class="btn btn-primary mb-3">Importer fichier</button>
            </div>
        </form>

        <?php
        // Connection à la base de donnees
        include("db_connection.php");

        $sql = "SELECT * FROM categorie";
        $result = mysqli_query($conn, $sql);

        $produit =  "SELECT * FROM  produit ,categorie where produit.idCategorie = categorie.idCategorie";
        $resultP = mysqli_query($conn, $produit);
        ?>

        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="col md-4">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Categorie id</th>
                                <th>libelle</th>

                            </tr>
                        </thead>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <tbody>
                                <tr>
                                    <td> <?php echo $row['idCategorie']; ?> </td>
                                    <td> <?php echo $row['Libelle']; ?> </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                    </table>

                    <form class="col-12" action="" method="POST">
                        <button type="submit" name="export" class="btn btn-success">Exporter Categorie</button>
                    </form>
                </div>
            <?php }   if (mysqli_num_rows($resultP) > 0) {?>
            <div class="col">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Produit id</th>
                            <th>Libelle</th>
                            <th>Categorie</th>
                            <th>Description</th>
                            <th>Unite stock</th>
                            <th>Nombre stock</th>
                            <th>Prix unitaire</th>

                        </tr>
                    </thead>
                    <?php while ($row1 = mysqli_fetch_array($resultP)) { ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row1['idProduit']; ?> </td>
                                <td> <?php echo $row1['libelle']; ?> </td>
                                <td> <?php echo $row1['Libelle']; ?> </td>
                                <td> <?php echo $row1['description']; ?> </td>
                                <td> <?php echo $row1['uniteStock']; ?> </td>
                                <td> <?php echo $row1['nombreStock']; ?> </td>
                                <td> <?php echo $row1['prixUnitaire']; ?> </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                </table>

                <form class="col-12" action="" method="POST">
                    <button type="submit" name="export" class="btn btn-success mb-3">Exporter produit</button>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>