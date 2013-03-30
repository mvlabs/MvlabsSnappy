<?php

namespace mvaSnappy\Service;


use Knp\Snappy\Image;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MvaSnappyImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $service = new \Knp\Snappy\Image($config['mva-snappy']['image']['binary'], $config['mva-snappy']['image']['options']);
        
        return $service;
    }
}
