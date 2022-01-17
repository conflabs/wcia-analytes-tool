<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$dir = scandir(__DIR__ . '/storage/lab-metric-type');
unset($dir[0], $dir[1]);

$resource = [];
foreach ($dir as $file) {

    $resource[] = \Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/storage/lab-metric-type/' . $file);
}

$fileDir = __DIR__ . '/storage/app';
$fileName = '/openThcLabMetricTypes.json';
$fileSave = file_put_contents($fileDir . $fileName, collect($resource)->toJson(JSON_PRETTY_PRINT));

if (!$fileSave) {

    echo 'Failed to save file at ' . $fileDir . $fileName . '.' . PHP_EOL;
} else {

    echo 'Saved file at ' . $fileDir . $fileName . '.' . PHP_EOL;
}

echo 'Complete.' . PHP_EOL;