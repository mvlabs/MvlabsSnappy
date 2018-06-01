<?php
/**
 * MvlabsSnappy (https://github.com/mvlabs/MvlabsSnappy)
 *
 * @copyright Copyright (c) 2013 MVLabs(http://mvlabs.it)
 * @author Diego Drigani <d.drigani@mvlabs.it>
 * @license   MIT
 */
namespace MvlabsSnappy\Factory;

use Interop\Container\ContainerInterface;
use Knp\Snappy\Pdf;
use Zend\ServiceManager\Factory\FactoryInterface;

class MvlabsSnappyPdfServiceFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config  = $container->get('config');
        $service = new Pdf($config['mvlabs-snappy']['pdf']['binary'], $config['mvlabs-snappy']['pdf']['options']);

        return $service;
    }
}
