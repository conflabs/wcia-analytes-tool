<?php declare(strict_types=1);


use Conflabs\WciaGenerator\Classes\Assay;
use Conflabs\WciaGenerator\Classes\MarkDown;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * @param array $contents
 * @return Generator
 */
function uomGenerator(array $contents): Generator
{

    foreach ($contents as $uom) {

        yield new \Conflabs\WciaGenerator\Classes\UnitOfMeasure(
            $uom->ulid, $uom->symbol, $uom->name, $uom->plural, $uom->description,
        );
    }
}

/**
 * @param array $files
 * @return Generator
 */
function fileGenerator(array $files): Generator
{

    foreach ($files as $file) {

        $contents = json_decode(file_get_contents(__DIR__ . '/storage/json-uoms/' . $file));
        $expFile = explode('.', $file);
        $titleCaption = ucwords($expFile[0]);

        $markDown = "# " . $titleCaption . "\n";
        $markDown .= "A list of " . $titleCaption . " Units of Measure for use in interoperability.\n";
        $markDown .= "\n";

        foreach (uomGenerator($contents) as $assay) {

            $markDown .= MarkDown::convertUom($assay);
        }

        yield [
          'fileName' => $titleCaption,
          'markDown' => $markDown,
          ];
    }
}

$dir = __DIR__ . '/storage/json-uoms';
$files = scandir($dir);
unset($files[0], $files[1]);

foreach (fileGenerator($files) as $markDown) {

    $filePath = __DIR__ . '/storage/docs-uoms';
    $fileName = '/' . ucwords($markDown['fileName']) . '.md';
    $fileSave = file_put_contents($filePath . $fileName, $markDown['markDown']);

    if (!$fileSave) {

        echo 'Failed to save file: ' . $filePath . $fileName . '.' . PHP_EOL;
    } else {

        echo 'Saved file: ' . $filePath . $fileName . '.' . PHP_EOL;
    }
}

echo 'Complete.'.PHP_EOL;