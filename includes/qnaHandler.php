<?php
// Načítanie obsahu JSON súboru
$qna_json = file_get_contents('json/qna.json');

// Dekódovanie JSON do pola
$qna_data = json_decode($qna_json, true);

// Kontrola, či boli údaje úspešne načítané
if ($qna_data === null) {
    echo "Chyba pri načítaní údajov z JSON súboru.";
    exit;
}

// Zobrazenie otázok a odpovedí
foreach ($qna_data as $item) {
    echo "<h3>" . htmlspecialchars($item['question']) . "</h3>";
    echo "<p>" . htmlspecialchars($item['answer']) . "</p>";
    echo "<hr>";
}
?>


