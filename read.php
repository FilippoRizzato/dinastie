<?php
require 'header.php';
include 'db.php';

$query = "SELECT s.nome, s.immagine, s.inizio, s.fine, 
                 p.nome AS predecessore, succ.nome AS successore
          FROM sovrano s
          LEFT JOIN sovrano p ON s.predecessore_id = p.nome
          LEFT JOIN sovrano succ ON s.successore_id = succ.nome
          ORDER BY s.inizio";

$stmt = $pdo->query($query);
$sovrani = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista dei Sovrani</title>
</head>
<body>
<h2>Lista dei Sovrani</h2>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Immagine</th>
        <th>Inizio</th>
        <th>Fine</th>
        <th>Predecessore</th>
        <th>Successore</th>
    </tr>
    <?php foreach ($sovrani as $sovrano): ?>
        <tr>
            <td><?= htmlspecialchars($sovrano['nome']) ?></td>
            <td><img src="<?= htmlspecialchars($sovrano['immagine']) ?>" width="50"></td>
            <td><?= $sovrano['inizio'] ?></td>
            <td><?= $sovrano['fine'] ?: 'In carica' ?></td>
            <td><?= $sovrano['predecessore'] ?: 'Nessuno' ?></td>
            <td><?= $sovrano['successore'] ?: 'Nessuno' ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
<?php require 'footer.php'; ?>