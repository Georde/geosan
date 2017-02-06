<?php
namespace Geosan\Manipulate;

use Geosan\Structure\PathStructure;
use Geosan\Manipulate\FileManipulate;
use Geosan\Structure\FileStructure;

class CreateManipulate extends PathStructure
{
    public $errorExist = "<error>File just exist</error>";
    public $errorAdded = "<error>Error adding in the file</error>";
    public $successCreate;
    public $successAdded;

    private $fileStructure;
    private $fileManipulate;

    public function __construct()
    {
        $this->fileStructure = new FileStructure();
        $this->fileManipulate = new FileManipulate();
    }

    public function createController($name, $module = null)
    {


        $fileContent = $this->fileStructure->controller();

        if ($module == null) {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathController);
        } else {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathModules . "/" . $module . "/" . $this->pathModuleController);
        }

        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createModel($name, $module = null)
    {
        $fileContent = $this->fileStructure->model();

        if ($module == null) {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathModel);
        } else {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathModules . "/" . $module . "/" . $this->pathModuleModel);
        }


        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createView($name, $module = null, $type = false)
    {
        $methodStructure = "view";
        if ($type != false)
            $methodStructure .= ucfirst($type);

        $fileContent = $this->fileStructure->$methodStructure();

        if ($module == null) {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathView, false);
        } else {
            $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathModules . "/" . $module . "/" . $this->pathModuleView);
        }


        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createHelper($name)
    {
        $fileContent = $this->fileStructure->helper();

        $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathHelper);

        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createMigration($name)
    {
        $fileContent = $this->fileStructure->migration();

        $timezone = "America/Belem";
        if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

        $date = date('YmdHis');

        $createFile = $this->fileManipulate->createFile(ucfirst($name), $fileContent, $this->pathMigration.$date."_");

        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createCore($name, $extends = false, $prefix = false)
    {
        $methodStructure = "core";
        if ($extends != false)
            $methodStructure .= "Extend";


        $fileContent = $this->fileStructure->$methodStructure();

        $extendReplace = array();

        if ($prefix != false)
            $extendReplace['CI'] = strtoupper($prefix);

        $extendReplace['REPLACE_EXTENDS'] = strtoupper($extends);

        $createFile = $this->fileManipulate->createFile($name, $fileContent, $this->pathCore, true, $extendReplace);

        if ($createFile !== true)
            return $this->errorExist;

        return $this->successCreate;
    }

    public function createRoute($route, $controller)
    {
        $fileContent = "\n$" . "route['$route'] = '{$controller}';";

        $addedFile = $this->fileManipulate->addInFile($fileContent, $this->pathRoute);

        if ($addedFile != true)
            return $this->errorAdded;

        return $this->successAdded;
    }
}