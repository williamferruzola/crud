<?php
namespace Bank;

use Bank\Controller\BankController;
use Bank\Model\Bank;
use Bank\Model\BankTable;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getControllerConfig()
    {
        return [
            'factories' => [
                BankController::class => function ($container) {
                    return new BankController($container->get(BankTable::class));
                }
            ]
        ];
    }
    public function getServiceConfig()
    {
        return [
            'factories' => [
                BankTable::class => function ($container) {
                    $tableGateway = $container->get(Model\BankTableGateway::class);
                    return new BankTable($tableGateway);
                },
                Model\BankTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Bank());
                    return new TableGateway('banks', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}
