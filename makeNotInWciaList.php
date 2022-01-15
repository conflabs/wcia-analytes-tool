<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$metrics = json_decode(file_get_contents(__DIR__ . '/storage/openThcLabMetrics.json'));
$analytes = json_decode(file_get_contents(__DIR__ . '/storage/json/allAnalytes.json'));

$notInWciaList = [];
foreach ($metrics as $metric) {

    $wciaAnalyteExists = collect($analytes)->firstWhere('ulid', $metric->id);
    if (!$wciaAnalyteExists) {

        $notInWciaList[] = $metric;
    }
}

$filePath = __DIR__ . '/storage/app';
$fileName = '/notInWciaList.json';
$saveFile = file_put_contents($filePath . $fileName, collect($notInWciaList)->sortBy('category')
  ->sortBy('scientific_name')
  ->values()
  ->toJson());

if (!$saveFile) {

    echo 'Failed to save file at ' . $filePath . $fileName . '.' . PHP_EOL;
} else {

    echo 'Saved file at ' . $filePath . $fileName . '.' . PHP_EOL;
}

echo 'Complete.' . PHP_EOL;