<?php
require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nome = $_POST['nome'];
$dataInizioRegno = $_POST['data_inizio_regno'];
$dataFineRegno = $_POST['data_fine_regno'];
$immagine = file_get_contents($_FILES['immagine']['tmp_name']);
$nomePredecessore = !empty($_POST['nome_predecessore']) ? $_POST['nome_predecessore'] : NULL;
$nomeSuccessore = !empty($_POST['nome_successore']) ? $_POST['nome_successore'] : NULL;

// Verify that the predecessor and successor exist in the 'sovrano' table
$verifyQuery = 'SELECT COUNT(*) FROM Sovrano WHERE Nome = :nome';
$verifyStmt = $db->prepare($verifyQuery);

if ($nomePredecessore !== NULL) {
$verifyStmt->bindParam(':nome', $nomePredecessore);
$verifyStmt->execute();
if ($verifyStmt->fetchColumn() == 0) {
echo "<p>Il nome del predecessore non esiste.</p>";
exit();
}
}

if ($nomeSuccessore !== NULL) {
$verifyStmt->bindParam(':nome', $nomeSuccessore);
$verifyStmt->execute();
if ($verifyStmt->fetchColumn() == 0) {
echo "<p>Il nome del successore non esiste.</p>";
exit();
}
}

// Proceed with the insertion
$query = 'INSERT INTO Sovrano (Nome, Inizio, Fine, Immagine, Predecessore_id, Successore_id) VALUES (:nome, :inizio, :fine, :immagine, :predecessore_id, :successore_id)';
$stmt = $db->prepare($query);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':inizio', $dataInizioRegno);
$stmt->bindParam(':fine', $dataFineRegno);
$stmt->bindParam(':immagine', $immagine);
$stmt->bindParam(':predecessore_id', $nomePredecessore);
$stmt->bindParam(':successore_id', $nomeSuccessore);

if ($stmt->execute()) {
echo "<p>Sovrano aggiunto con successo!</p>";
} else {
echo "<p>Errore durante l'inserimento del sovrano.</p>";
}
}
?>

<h1>Aggiungi un nuovo Sovrano</h1>
<form method="POST" enctype="multipart/form-data">
    <label>Nome:</label> <input type="text" name="nome" required><br>
    <label>Data Inizio Regno:</label> <input type="date" name="data_inizio_regno" required><br>
    <label>Data Fine Regno:</label> <input type="date" name="data_fine_regno"><br>
    <label>Immagine:</label> <input type="file" name="immagine" required><br>
    <label>Nome Predecessore (opzionale):</label> <input type="text" name="nome_predecessore"><br>
    <label>Nome Successore (opzionale):</label> <input type="text" name="nome_successore"><br>
    <button type="submit">Aggiungi Sovrano</button>
</form>

<?php require 'footer.php'; ?>
