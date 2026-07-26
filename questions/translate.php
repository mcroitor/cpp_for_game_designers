<?php

$questionsFile = "questions.xml";
$questionsFileTr = "questions_tr.xml";

// encoding: UTF-8
$xml = simplexml_load_file($questionsFile);
if ($xml === false) {
    echo "Failed to load XML file.";
    exit;
}

$translatedFile = "questions.json";
$translated = json_decode(file_get_contents($translatedFile), true);

foreach ($xml->question as $question) {
    $name = (string)$question->name->text;
    // if the question name is not in the translated file, skip it
    if (!isset($translated[$name])) {
        continue;
    }

    // replace the question text with the translated text
    $question->questiontext->text = $translated[$name]['questiontext'];
    for ($i = 0; $i < count($question->answer); $i++) {
        // if the answer text is not in the translated file, skip it
        if (!isset($translated[$name]['answers'][$i])) {
            continue;
        }
        // replace the answer text with the translated text
        $question->answer[$i]->text = $translated[$name]['answers'][$i];
    }
}

// Save the updated XML back to the file
$xml->asXML($questionsFileTr);
