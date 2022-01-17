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
//        $text .= "* UUID: `" . $analyte->uuid . "`\n"; [last used v.0.9.7]
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
}