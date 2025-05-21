<?php
header('Content-Type: application/json');
$questions = json_decode(file_get_contents(__DIR__ . '/questions.json'), true);
$dir = __DIR__ . '/resultats/';
$responses = [];
if (is_dir($dir)) {
    foreach (glob($dir . '*.json') as $file) {
        $resp = json_decode(file_get_contents($file), true);
        if (is_array($resp)) $responses[] = $resp;
    }
}
$stats = [];
foreach ($questions as $qidx => $q) {
    $choiceCounts = array_fill(0, count($q['choices']), 0);
    $customCount = 0;
    foreach ($responses as $resp) {
        if (!isset($resp[$qidx]['choice'])) continue;
        $choice = $resp[$qidx]['choice'];
        $found = false;
        foreach ($q['choices'] as $i => $c) {
            if ($choice === $c) {
                $choiceCounts[$i]++;
                $found = true;
                break;
            }
        }
        if (!$found) $customCount++;
    }
    $total = array_sum($choiceCounts) + $customCount;
    $choicesArr = [];
    foreach ($q['choices'] as $i => $c) {
        $count = $choiceCounts[$i];
        $percent = $total ? round($count * 100 / $total, 1) : 0;
        $choicesArr[] = ['text'=>$c, 'count'=>$count, 'percent'=>$percent];
    }
    // Ajout custom si pertinent
    if ($q['allowCustomChoice']) {
        $percent = $total ? round($customCount * 100 / $total, 1) : 0;
        $choicesArr[] = ['text'=>'Réponse personnalisée', 'count'=>$customCount, 'percent'=>$percent];
    }
    $stats[] = [
        'question' => $q['question'],
        'choices' => $choicesArr
    ];
}
echo json_encode($stats);
