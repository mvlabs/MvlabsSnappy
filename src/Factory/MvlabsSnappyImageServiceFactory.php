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
use Knp\Snappy\Image;
use Zend\ServiceManager\Factory\FactoryInterface;

class MvlabsSnappyImageServiceFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config  = $container->get('config');
        $service = new Image($config['mvlabs-snappy']['image']['binary'], $config['mvlabs-snappy']['image']['options']);
        
        return $service;
    }
}
