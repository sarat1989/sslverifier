<?php
/**
 * @license   See LICENSE file
 * @copyright Copyright (c) 2020 Joshua Smith
 */

namespace Tests\Handlers;

use DMS\PHPUnitExtensions\ArraySubset\Assert;
use Exception;
use phpWhois\Handlers\AppHandler;

/**
 * AppHandlerTest
 */
class AppHandlerTest extends AbstractHandler
{
    /**
     * @var AppHandler $handler
     */
    protected $handler;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->handler            = new AppHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @return void
     * @test
     * @throws Exception
     */
    public function parseGoogleDotApp()
    {
        $query = 'google.app';

        $fixture = $this->loadFixture($query);
        $data    = [
            'rawdata'  => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                'name'    => 'google.app',
                'changed' => '2018-04-09',
                'created' => '2018-03-29',
                'expires' => '2019-03-29',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }

    /**
     * @return void
     * @test
     * @throws Exception
     */
    public function parseGodaddyDotApp()
    {
        $query = 'google.app';

        $fixture = $this->loadFixture($query);
        $data    = [
            'rawdata'  => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                'name'    => 'google.app',
                'changed' => '2018-04-09',
                'created' => '2018-03-29',
                'expires' => '2019-03-29',
            ],
            'registered' => 'yes',
        ];

        Assert::assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        Assert::assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
