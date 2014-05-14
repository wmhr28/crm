<?php

namespace OroCRM\Bundle\ReportBundle\Tests\Functional;

use Oro\Bundle\ReportBundle\Tests\Functional\ControllersTest as BaseControllersTest;

/**
 * @outputBuffering enabled
 * @dbIsolation
 * @dbReindex
 */
class ControllersCrmTest extends BaseControllersTest
{
    static protected $fixturesLoaded = false;

    public function setUp()
    {
        $this->client = self::createClient(
            array(),
            array_merge($this->generateBasicAuthHeader(), array('HTTP_X-CSRF-Header' => 1))
        );

        if (!self::$fixturesLoaded) {
            $this->client->appendFixtures(__DIR__ . DIRECTORY_SEPARATOR . 'DataFixtures', array('LoadLead'));
            self::$fixturesLoaded = true;
        }
    }

    /**
     * @param array $report
     * @param array $reportResult
     *
     * @dataProvider exportDataProvider
     */
    public function testExport(array $report, array $reportResult)
    {
        $this->markTestSkipped("Skipped by BAP-2946");
    }

    /**
     * Data provider for SOAP API tests
     *
     * @return array
     */
    public function exportDataProvider()
    {
        return $this->getApiRequestsData(__DIR__ . DIRECTORY_SEPARATOR . 'reports');
    }
}
