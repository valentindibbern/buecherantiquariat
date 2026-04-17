<?php
declare(strict_types=1);

class MainController
{
    private ConfigurationController $configurationController;
    private DetailController $detailController;
    private KachelController $kachelController;
    private RouteController $routeController;
    private SearchController $searchController;

    public function __construct()
    {
        $this->configurationController = new ConfigurationController();
        $this->detailController = new DetailController(
            $this->configurationController->getConnection(),
        );
        $this->kachelController = new KachelController(
            $this->configurationController->getConnection(),
        );
        $this->searchController = new SearchController(
            $this->configurationController->getConnection(),
        );
        $this->routeController = new RouteController(
            $this->detailController,
            $this->kachelController,
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
