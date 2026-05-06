<?php
declare(strict_types=1);

namespace App\Controllers;
class MainController
{
    private \App\Controllers\AdminController $adminController;
    private \App\Controllers\CRUDController $crudController;
    private \App\Controllers\ConfigurationController $configurationController;
    private \App\Controllers\DetailController $detailController;
    private \App\Controllers\KachelController $kachelController;
    private \App\Controllers\LoginController $loginController;
    private \App\Controllers\RouteController $routeController;
    private \App\Controllers\SearchController $searchController;

    public function __construct()
    {
        $this->configurationController = new \App\Controllers\ConfigurationController();
        $this->configurationController->configure();

        $this->adminController = new \App\Controllers\AdminController(
            $this->configurationController->getConnection(),
        );
        $this->crudController = new \App\Controllers\CrudController(
            $this->configurationController->getConnection(),
        );
        $this->detailController = new \App\Controllers\DetailController(
            $this->configurationController->getConnection(),
        );
        $this->kachelController = new \App\Controllers\KachelController(
            $this->configurationController->getConnection(),
        );
        $this->loginController = new \App\Controllers\LoginController(
            $this->configurationController->getConnection(),
        );
        $this->searchController = new \App\Controllers\SearchController(
            $this->configurationController->getConnection(),
        );

        $this->routeController = new \App\Controllers\RouteController(
            $this->adminController,
            $this->crudController,
            $this->detailController,
            $this->kachelController,
            $this->loginController,
            $this->searchController,
        );

        $this->routeController->configureRoutes(
            $this->configurationController->getConnection(),
        );

        $this->routeController->receive(
            $this->configurationController->getConnection(),
        );
    }
}