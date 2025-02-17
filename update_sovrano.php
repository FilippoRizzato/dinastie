<?php
require 'header.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $nomePredecessore = $_POST['nome_predecessore'];
    $nomeSuccessore = $_POST['nome_successore'];

    $query = 'UPDATE Sovrano SET NomePredecessore = :nome_predecessore, NomeSuccessore = :nome_successore WHERE Nome = :nome';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':nome_predecessore', $nomePredecessore);
    $stmt->bindParam(':nome_successore', $nomeSuccessore);

    if ($stmt->execute()) {
        echo "<p>Sovrano aggiornato con successo!</p>";
    } else {
        echo "<p>Errore durante l'aggiornamento del sovrano.</p>";
    }
}
?>

<h1>Aggiorna Sovrano</h1>
<form method="POST">
    <label>Nome:</label> <input type="text" name="nome" required><br>
    <label>Nome Predecessore (opzionale):</label> <input type="text" name="nome_predecessore"><br>
    <label>Nome Successore (opzionale):</label> <input type="text" name="nome_successore"><br>
    <button type="submit">Aggiorna Sovrano</button>
</form>

<?php require 'footer.php'; ?>

