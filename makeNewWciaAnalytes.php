<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$missing = json_decode(file_get_contents(__DIR__ . '/storage/app/notInWciaList.json'));

function analyteGenerator(array $nonAnalytes): \Generator
{
    foreach ($nonAnalytes as $nonAnalyte) {

        $nonAnalyte = collect($nonAnalyte)->toArray();
        $ulid = $nonAnalyte['id'];
        $uuid = null; //\Ramsey\Uuid\Uuid::uuid4()->toString()
        $scientific_name = strtolower($nonAnalyte['name']);
        $common_names = [strtolower($nonAnalyte['name'])];
        $category = strtolower($nonAnalyte['type']);
        $cas_rn = $nonAnalyte['cas'];

        yield new \Conflabs\WciaGenerator\Classes\Analyte($ulid, $uuid, $scientific_name, $common_names, $category, $cas_rn);
    }
}

$analytes = [];
foreach (analyteGenerator($missing) as $analyte) {

    $analytes[] = $analyte;
}

$filePath = __DIR__ . '/storage/app';
$fileName = '/newWciaAnalytes.json';
$saveFile = file_put_contents($filePath . $fileName, collect($analytes)->sortBy('category')
  ->values()
  ->toJson());

if (!$saveFile) {

    echo 'Failed to save file at ' . $filePath . $fileName . '.' . PHP_EOL;
} else {

    echo 'Saved file at ' . $filePath . $fileName . '.' . PHP_EOL;
}

echo 'Complete.' . PHP_EOL;