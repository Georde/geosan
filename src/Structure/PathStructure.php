<?php
namespace Geosan\Structure;

class PathStructure{
	protected $pathApplication = pathApplication.'application/';
	protected $pathModules = pathApplication.'application/modules/';

	protected $pathController = pathApplication.'application/controllers/';
	protected $pathModel = pathApplication.'application/models/';
	protected $pathView = pathApplication.'application/views/';

    protected $pathModuleController = 'controllers/';
	protected $pathModuleModel = 'models/';
	protected $pathModuleView = 'views/';




	protected $pathHelper = pathApplication.'application/helpers/';
	protected $pathMigration = pathApplication.'application/migrations/';
	protected $pathCore = pathApplication.'application/core/';

	protected $pathRoute = pathApplication.'application/config/routes.php';
}