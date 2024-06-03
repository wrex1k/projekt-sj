<?php
// načítanie obsahusúboru qna.json
$qna_json = file_get_contents('json/qna.json');

// dekódovanie JSON obsahu do asociatívneho poľa
$qna_data = json_decode($qna_json, true);

// kontrola, či dekódovanie bolo úspešné
if ($qna_data === null) {
    echo "Error loading JSON file.";
    exit;
}

// postupné vypisovanie obsahu
foreach ($qna_data as $item) {
    echo "<h3>" . ($item['question']) . "</h3>";
    echo "<p>" . ($item['answer']) . "</p>";
    echo "<hr>";
}
?>
