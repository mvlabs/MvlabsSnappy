<?php
/**
 * MvlabsSnappy (https://github.com/mvlabs/MvlabsSnappy)
 *
 * @copyright Copyright (c) 2013 MVLabs(http://mvlabs.it)
 * @author Diego Drigani <d.drigani@mvlabs.it>
 * @license   MIT
 */
namespace MvlabsSnappy;

use Knp\Snappy\Image;
use Knp\Snappy\Pdf;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;

final class Module implements ServiceProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {

        return [
            'aliases' => [
                'mvlabssnappy.pdf.service' => Pdf::class,
                'mvlabssnappy.image.service' => Image::class
            ],
            'factories' => [
                Pdf::class  => Factory\MvlabsSnappyPdfServiceFactory::class,
                Image::class => Factory\MvlabsSnappyImageServiceFactory::class,
            ],
        ];
    }
}
