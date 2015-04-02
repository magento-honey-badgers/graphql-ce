<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Console;

use Zend\ServiceManager\ServiceManager;

/**
 * Class CommandList contains predefined list of commands for Setup
 */
class CommandList
{
    /**
     * Service Manager
     *
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * Constructor
     *
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * Gets list of setup command classes
     *
     * @return string[]
     */
    protected function getCommandsClasses()
    {
        return [
            'Magento\Setup\Console\Command\AdminUserCreateCommand',
            'Magento\Setup\Console\Command\ConfigSetCommand',
            'Magento\Setup\Console\Command\DbStatusCommand',
            'Magento\Setup\Console\Command\ModuleEnableCommand',
            'Magento\Setup\Console\Command\ModuleDisableCommand',
            'Magento\Setup\Console\Command\ModuleStatusCommand',
            'Magento\Setup\Console\Command\MaintenanceAllowIpsCommand',
            'Magento\Setup\Console\Command\MaintenanceDisableCommand',
            'Magento\Setup\Console\Command\MaintenanceEnableCommand',
            'Magento\Setup\Console\Command\MaintenanceStatusCommand',
            'Magento\Setup\Console\Command\UpdateCommand',
            'Magento\Setup\Console\Command\DbSchemaUpgradeCommand',
            'Magento\Setup\Console\Command\DbDataUpgradeCommand',
        ];
    }

    /**
     * Gets list of command instances
     *
     * @return \Symfony\Component\Console\Command\Command[]
     * @throws \Exception
     */
    public function getCommands()
    {
        $commands = [];

        foreach ($this->getCommandsClasses() as $class) {
            if (class_exists($class)) {
                $commands[] = $this->serviceManager->create($class);
            } else {
                throw new \Exception('Class ' . $class . ' does not exist');
            }
        }

        return $commands;
    }
}
