<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Tests\Classes;


use Conflabs\WciaGenerator\Classes\OpenTHCMetric;
use PHPUnit\Framework\TestCase;

class OpenTHCMetricTest extends TestCase
{

    protected OpenTHCMetric $openTHCMetric;

    protected function setUp(): void
    {

        $id = '01FSDMX4HTSTYEZV9YYMA87SQE'; //public string
        $cas = null; //public ?string
        $name = 'Test Analyte'; //public string
        $type = 'Test'; //public string
        $stub = 'test_analyte'; //public ?string

        $this->openTHCMetric = new OpenTHCMetric($id, $cas, $name, $type, $stub);
    }

    public function testClassExists()
    {

        $this->assertFileExists(dirname(__DIR__, 2) . '/src/Classes/OpenTHCMetric.php');
    }

    public function test__construct()
    {

        $this->assertInstanceOf(OpenTHCMetric::class, $this->openTHCMetric);
    }
}
