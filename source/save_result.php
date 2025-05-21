<?php
// Répertoire de stockage
$dir = __DIR__ . '/resultats/';
if (!is_dir($dir)) mkdir($dir, 0777, true);

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['uid']) || !isset($data['responses'])) {
    http_response_code(400);
    echo json_encode(['ok'=>false]);
    exit;
}
$uid = preg_replace('/[^a-zA-Z0-9_]/', '', $data['uid']);
file_put_contents($dir . $uid . '.json', json_encode($data['responses'], JSON_PRETTY_PRINT));
echo json_encode(['ok'=>true]);

$questionsFile = __DIR__ . '/questions.json';
$questions = json_decode(file_get_contents($questionsFile), true);
$updated = false;

foreach ($data['responses'] as $idx => $resp) {
    if (
        isset($resp['choice'], $resp['custom']) &&
        $resp['choice'] &&
        $resp['custom'] &&
        isset($questions[$idx]['choices']) &&
        isset($questions[$idx]['allowCustomChoice']) &&
        $questions[$idx]['allowCustomChoice']
    ) {
        // Si la réponse personnalisée n'est pas déjà dans les choix, on l'ajoute
        $customText = trim($resp['custom']);
        $alreadyExists = false;
        foreach ($questions[$idx]['choices'] as $choice) {
            if (mb_strtolower($choice) === mb_strtolower($customText)) {
                $alreadyExists = true;
                break;
            }
        }
        if (!$alreadyExists && $customText !== '') {
            // On ajoute la réponse personnalisée juste avant "Aucune de ces réponses"
            $choices = $questions[$idx]['choices'];
            $inserted = false;
            foreach ($choices as $i => $choice) {
                if (strpos($choice, 'Aucune de ces réponses') === 0) {
                    array_splice($choices, $i, 0, [$customText]);
                    $inserted = true;
                    break;
                }
            }
            if (!$inserted) {
                $choices[] = $customText;
            }
            $questions[$idx]['choices'] = $choices;
            $updated = true;
        }
    }
}

if ($updated) {
    file_put_contents($questionsFile, json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
