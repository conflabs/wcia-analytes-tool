<?php declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/vendor/autoload.php';

$missing = json_decode(file_get_contents(__DIR__ . '/storage/app/notInOpenThcList.json'));

/**
 * @param array $nonMetrics
 * @return Generator
 */
function metricGenerator(array $nonMetrics): Generator
{
    foreach ($nonMetrics as $nonMetric) {

        $nonMetric = collect($nonMetric)->toArray();
        $id = $nonMetric['ulid'];
        $cas = !is_null($nonMetric['cas_rn']) ? $nonMetric['cas_rn'] : null;
        $name = ucfirst($nonMetric['scientific_name']);
        $type = ucfirst($nonMetric['category']);
        $stub = str_replace(' ', '_', strtolower($nonMetric['scientific_name'])); //lowercase, replace spaces with underscores

        if (is_null($cas)) {
            yield [
              'id' => $id,
              'name' => $name,
              'type' => $type,
              'stub' => $stub,
            ];
        }

        yield [
          'id' => $id,
          'cas' => $cas,
          'name' => $name,
          'type' => $type,
          'stub' => $stub,
        ];
    }
}

$newMetrics = [];
foreach (metricGenerator($missing) as $metric) {

    $yaml = Yaml::dump($metric);

    $filePath = __DIR__ . '/storage/yamls';
    $fileName = '/'.$metric['id'].'.yaml';
    $fileSave = file_put_contents($filePath . $fileName, "---\n" . $yaml . "...");

    if (!$fileSave) {

        echo 'Failed to save file at ' . $filePath . $fileName . '.' . PHP_EOL;
    } else {

        echo 'Saved file at ' . $filePath . $fileName . '.' . PHP_EOL;
    }
}

echo PHP_EOL;
echo 'Complete.' . PHP_EOL;