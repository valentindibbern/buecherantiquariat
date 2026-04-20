<?php
declare(strict_types=1);

class MainController
{
    private ConfigurationController $configurationController;
    private DetailController $detailController;
    private KachelController $kachelController;
    private RouteController $routeController;
    private SearchController $searchController;
    private LoginController $loginController;
    private AdminController $adminController;

    public function __construct()
    {
        $this->configurationController = new ConfigurationController();
        $this->configurationController->configure();

        $this->detailController = new DetailController(
            $this->configurationController->getConnection(),
        );
        $this->kachelController = new KachelController(
            $this->configurationController->getConnection(),
        );
        $this->searchController = new SearchController(
            $this->configurationController->getConnection(),
        );
        $this->loginController = new LoginController(
            $this->configurationController->getConnection(),
        );
        $this->adminController = new AdminController();
        $this->routeController = new RouteController(
            $this->detailController,
            $this->kachelController,
            $this->searchController,
            $this->loginController,
            $this->adminController,
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
