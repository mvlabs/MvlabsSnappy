<?php

namespace MvlabsSnappyTest;

use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    private $serviceManager;

    public function setUp()
    {
        $this->serviceManager = Bootstrap::getServiceManager();
    }

    public function testServiceIsAvailableOutOfTheBox()
    {

        $container = $this->serviceManager;

        $this->assertTrue($container->has('mvlabssnappy.pdf.service'), 'The pdf service is available.');

        $pdf = $container->get('mvlabssnappy.pdf.service');

        $this->assertInstanceof('Knp\Snappy\Pdf', $pdf);
        $this->assertEquals('/usr/bin/wkhtmltopdf', $pdf->getBinary());

        $this->assertTrue($container->has('mvlabssnappy.image.service'), 'The image service is available.');

        $image = $container->get('mvlabssnappy.image.service');

        $this->assertInstanceof('Knp\Snappy\Image', $image);
        $this->assertEquals('/usr/bin/wkhtmltoimage', $image->getBinary());
    }
}
