<?php declare(strict_types=1);

use Conflabs\WciaGenerator\Classes\Analyte;
use Conflabs\WciaGenerator\Classes\MarkDown;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * @param array $contents
 * @return Generator
 */
function analyteGenerator(array $contents): Generator
{

    foreach ($contents as $analyte) {

        yield new Analyte(
          $analyte->ulid, $analyte->uuid, $analyte->scientific_name, $analyte->common_names, $analyte->category, $analyte->cas_rn
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

        $contents = json_decode(file_get_contents(__DIR__ . '/storage/json/' . $file));
        $expFile = explode('.', $file);
        $titleCaption = ucwords($expFile[0]);

        $markDown = "# " . $titleCaption . "\n";
        $markDown .= "A list of " . $titleCaption . " Analytes for use in interoperability.\n";
        $markDown .= "\n";

        foreach (analyteGenerator($contents) as $analyte) {

            $markDown .= MarkDown::convert($analyte);
        }

        yield [
          'fileName' => $titleCaption,
          'markDown' => $markDown,
          ];
    }
}

$dir = __DIR__ . '/storage/json';
$files = scandir($dir);
unset($files[0], $files[1]);

foreach (fileGenerator($files) as $markDown) {

    $filePath = __DIR__ . '/storage/docs';
    $fileName = '/' . ucwords($markDown['fileName']) . '.md';
    $fileSave = file_put_contents($filePath . $fileName, $markDown['markDown']);

    if (!$fileSave) {

        echo 'Failed to save file: ' . $filePath . $fileName . '.' . PHP_EOL;
    } else {

        echo 'Saved file: ' . $filePath . $fileName . '.' . PHP_EOL;
    }
}

echo 'Complete.'.PHP_EOL;