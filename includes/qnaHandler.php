<?php
$qna_json = file_get_contents('json/qna.json');

$qna_data = json_decode($qna_json, true);

if ($qna_data === null) {
    echo "Chyba pri načítaní údajov z JSON súboru.";
    exit;
}

foreach ($qna_data as $item) {
    echo "<h3>" . htmlspecialchars($item['question']) . "</h3>";
    echo "<p>" . htmlspecialchars($item['answer']) . "</p>";
    echo "<hr>";
}
?>


