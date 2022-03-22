
<?php
include("db_connection.php"); 
if (isset($_POST["export"])) {
   
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Categorie id', 'Libelle'));
    $query = "SELECT * from categorie ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>  