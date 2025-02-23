<?php
require 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $immagine = $_POST['immagine'];
    $inizio = $_POST['inizio'];
    $fine = $_POST['fine'] ?: NULL;
    $predecessore = $_POST['predecessore'] ?: NULL;
    $successore = $_POST['successore'] ?: NULL;

    $query = "INSERT INTO sovrano (nome, immagine, inizio, fine, predecessore_id, successore_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute([$nome, $immagine, $inizio, $fine, $predecessore, $successore]);
        echo "<p style='color: green;'>Sovrano aggiunto con successo!</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Errore: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Sovrano</title>
</head>
<body>
    <h2>Aggiungi un nuovo sovrano</h2>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Immagine (URL): <input type="text" name="immagine"><br>
        Inizio regno: <input type="date" name="inizio" required><br>
        Fine regno: <input type="date" name="fine"><br>
        Predecessore: <input type="text" name="predecessore"><br>
        Successore: <input type="text" name="successore"><br>
        <input type="submit" value="Aggiungi Sovrano">
    </form>
</body>
</html>


<?php require 'footer.php'; ?>
