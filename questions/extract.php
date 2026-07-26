<?php

$xmlfile = 'questions.xml';
// encoding: UTF-8
$xml = simplexml_load_file($xmlfile);
if ($xml === false) {
    echo "Failed to load XML file.";
    exit;
}

$questions = [];

foreach ($xml->question as $question) {
    if (empty($question->name) || empty($question->questiontext)) {
        continue; // Skip questions without name or question text
    }
    $name = (string)$question->name->text;
    $questiontext = (string)$question->questiontext->text;
    $answers = [];

    if (isset($question->answer)) {
        foreach ($question->answer as $answer) {
            $answers[] = isset($answer->text) ? (string)$answer->text : '';
        }
    }

    $questions[$name] = [
        'name' => $name,
        'questiontext' => $questiontext,
        'answers' => $answers
    ];
}

// Output the questions in JSON format with proper Unicode handling
file_put_contents('questions.json', json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Questions extracted and saved to questions.json\n";
