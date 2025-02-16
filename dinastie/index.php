<?php
require 'header.php';
require 'db.php';

$query = 'SELECT * FROM Sovrano ORDER BY DataInizioRegno';
$stmt = $db->query($query);
$sovrani = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Dinastia dei Sovrani di Utopia</h1>
<table>
    <tr>
        <th>Nome</th>
        <th>Data Inizio Regno</th>
        <th>Data Fine Regno</th>
        <th>Immagine</th>
        <th>Predecessore</th>
        <th>Successore</th>
    </tr>
    <?php foreach ($sovrani as $sovrano): ?>
        <tr>
            <td><?= htmlspecialchars($sovrano['Nome']) ?></td>
            <td><?= htmlspecialchars($sovrano['DataInizioRegno']) ?></td>
            <td><?= htmlspecialchars($sovrano['DataFineRegno']) ?></td>
            <td><img src="data:image/jpeg;base64,<?= base64_encode($sovrano['Immagine']) ?>" alt="Immagine di <?= htmlspecialchars($sovrano['Nome']) ?>"></td>
            <td><?= htmlspecialchars($sovrano['NomePredecessore']) ?></td>
            <td><?= htmlspecialchars($sovrano['NomeSuccessore']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>

