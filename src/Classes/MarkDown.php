<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Classes;

class MarkDown
{

    public static function convert(Analyte $analyte): string
    {
        $title = "----------------------------------------\n";
        $title .= "\n";
        $title .= "## " . ucwords($analyte->scientific_name) . "\n";
        $title .= "\n";

        $text = "* ULID: `" . $analyte->ulid . "`\n";
        $text .= "* Scientific Name: `" . $analyte->scientific_name . "`\n";
        $text .= "* Common Names: `";
        foreach ($analyte->common_names as $name) {
            $text .= $name . ', ';
        }
        $text = rtrim($text, ', ');
        $text .= "`\n";
        $text .= "* Category: `" . $analyte->category . "`\n";
        $text .= "* CAS RN: `" . $analyte->cas_rn . "`\n";
        $text .= "\n";

        $code = "```json\n";
        $code .= collect($analyte)->toJson(JSON_PRETTY_PRINT) . "\n";
        $code .= "```\n";
        $code .= "\n";

        return $title . $text . $code;
    }

    public static function convertAssay(Assay $assay): string
    {
        $title = "----------------------------------------\n";
        $title .= "\n";
        $title .= "## " . ucwords($assay->assay_name) . "\n";
        $title .= "\n";

        $text = "* ULID: `" . $assay->ulid . "`\n";
        $text .= "* Assay Name: `" . $assay->assay_name . "`\n";
        $text .= "* Common Names: `";
        foreach ($assay->common_names as $name) {
            $text .= $name . ', ';
        }
        $text = rtrim($text, ', ');
        $text .= "`\n";

        $code = "```json\n";
        $code .= collect($assay)->toJson(JSON_PRETTY_PRINT) . "\n";
        $code .= "```\n";
        $code .= "\n";

        return $title . $text . $code;
    }

    public static function convertUom(UnitOfMeasure $uom): string
    {
        $title = "----------------------------------------\n";
        $title .= "\n";
        $title .= "## " . ucwords($uom->symbol) . "\n";
        $title .= "\n";

        $text = "* ULID: `" . $uom->ulid . "`\n";
        $text .= "* Symbol: `" . $uom->symbol . "`\n";
        $text .= "* Name: `" . $uom->name . "`\n";
        $text .= "* Plural: `" . $uom->plural . "`\n";
        $text .= "* Description: `" . $uom->description . "`\n";
        $text .= "\n";

        $code = "```json\n";
        $code .= collect($uom)->toJson(JSON_PRETTY_PRINT) . "\n";
        $code .= "```\n";
        $code .= "\n";

        return $title . $text . $code;
    }
}