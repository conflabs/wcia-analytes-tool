<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$metrics = json_decode(file_get_contents(__DIR__ . '/storage/app/openThcLabMetrics.json'));
$analytes = json_decode(file_get_contents(__DIR__ . '/storage/json-analytes/allAnalytes.json'));

$notInOpenThcList = [];
foreach ($analytes as $analyte) {

    $openThcAnalyteExists = collect($metrics)->firstWhere('id', $analyte->ulid);
    if (!$openThcAnalyteExists) {

        $notInOpenThcList[] = $analyte;
    }
}

$filePath = __DIR__ . '/storage/app';
$fileName = '/notInOpenThcList.json';
$saveFile = file_put_contents($filePath . $fileName, collect($notInOpenThcList)->sortBy('type')
  ->values()
  ->toJson());

if (!$saveFile) {

    echo 'Failed to save file at ' . $filePath . $fileName . '.' . PHP_EOL;
} else {

    echo 'Saved file at ' . $filePath . $fileName . '.' . PHP_EOL;
}

echo 'Complete.' . PHP_EOL;