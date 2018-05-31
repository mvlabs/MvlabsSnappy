<?php
namespace MvlabsSnappyTest;

use MvlabsSnappy\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @author Diego Drigani <d.drigani@mvlabs.it>
 * @link http://www.mvlabs.it
 */
class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    private $module;

    public function setUp()
    {
        $this->module = new Module();
    }

    public function testGetConfig()
    {
        $expectedConfig = include __DIR__ . '/../config/module.config.php';
        $returnedConfig = $this->module->getConfig();

        $this->assertEquals($expectedConfig, $returnedConfig);
    }
}