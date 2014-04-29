<?php

namespace MvlabsSnappy\Services;


use Knp\Snappy\Image;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MvlabsSnappyImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $service = new Image($config['mvlabs-snappy']['image']['binary'], $config['mvlabs-snappy']['image']['options']);
        
        return $service;
    }
}
