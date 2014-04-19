<?php

namespace MvlabsSnappy\Services;


use Knp\Snappy\Pdf;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MvlabsSnappyPdfServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $service = new Pdf($config['mvlabs-snappy']['pdf']['binary'], $config['mvlabs-snappy']['pdf']['options']);
        
        return $service;
    }
}
