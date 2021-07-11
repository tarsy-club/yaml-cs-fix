<?php

namespace TarsyClub\YamlCsFix\Test;

use Codeception\Test\Unit;
use Yandex\Allure\Adapter\Annotation\Features;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Title;

/**
 * @Features({"Main"})
 * @Stories({"Main"})
 *
 * @tarsy-club
 */
class MainTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @Features({"Main"})
     * @Title("Main")
     * @test
     * @group main
     */
    public function main()
    {
        $this->assertTrue(true);
    }
}
