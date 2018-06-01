<?php
/**
 * MvlabsSnappy (https://github.com/mvlabs/MvlabsSnappy)
 *
 * @copyright Copyright (c) 2013 MVLabs(http://mvlabs.it)
 * @author Diego Drigani <d.drigani@mvlabs.it>
 * @license   MIT
 */
namespace MvlabsSnappy;

final class ConfigProvider
{
    public function __invoke()
    {
        $mvlabsSnappyModule = new Module();

        return [
            'mvlabs-snappy' => $mvlabsSnappyModule->getConfig(),
            'dependencies' => $mvlabsSnappyModule->getServiceConfig(),
        ];
    }
}
