<?php
declare(strict_types=1);

class MainController
{
    private AdminController $adminController;
    private CRUDController $crudController;
    private ConfigurationController $configurationController;
    private DetailController $detailController;
    private KachelController $kachelController;
    private LoginController $loginController;
    private RouteController $routeController;
    private SearchController $searchController;

    public function __construct()
    {
        $this->configurationController = new ConfigurationController();
        $this->configurationController->configure();

        $this->adminController = new AdminController(
            $this->configurationController->getConnection(),
        );
        $this->crudController = new CrudController(
            $this->configurationController->getConnection(),
        );
        $this->detailController = new DetailController(
            $this->configurationController->getConnection(),
        );
        $this->kachelController = new KachelController(
            $this->configurationController->getConnection(),
        );
        $this->loginController = new LoginController(
            $this->configurationController->getConnection(),
        );
        $this->searchController = new SearchController(
            $this->configurationController->getConnection(),
        );

        $this->routeController = new RouteController(
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
?>
