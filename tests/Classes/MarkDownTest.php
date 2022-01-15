<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Tests\Classes;

use Conflabs\WciaGenerator\Classes\Analyte;
use Conflabs\WciaGenerator\Classes\MarkDown;
use PHPUnit\Framework\TestCase;

class MarkDownTest extends TestCase
{
    protected Analyte $analyte;

    protected function setUp(): void
    {

        $ulid = '01FSDMX4HTSTYEZV9YYMA87SQE'; //public string
        $uuid = '4a45112c-c3b0-42d2-bd16-474ed3876d50'; //public string
        $scientific_name = 'test analyte'; //public string
        $common_names = ['test result', 'test amount', 'test quant']; //public array
        $category = 'test'; //public string
        $cas_rn = null; //public ?string

        $this->analyte = new Analyte($ulid, $uuid, $scientific_name, $common_names, $category, $cas_rn);
    }

    public function testClassExists()
    {

        $this->assertFileExists(dirname(__DIR__, 2) . '/src/Classes/MarkDown.php');
    }

    public function testConvert()
    {
        $markDown = MarkDown::convert($this->analyte);

        $this->assertIsString($markDown);
    }
}
