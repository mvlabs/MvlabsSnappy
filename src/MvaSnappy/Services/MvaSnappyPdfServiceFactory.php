<?php

namespace mvaSnappy\Service;


use Knp\Snappy\Pdf;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class MvaSnappyPdfServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $service = new \Knp\Snappy\Pdf($config['mva-snappy']['pdf']['binary'], $config['mva-snappy']['pdf']['options']);
        
        return $service;
    }
}
