<?php

/**
 * Ferramenta para auxiliar na criação da base de módulo para o CodeIgniter com HMVC.
 * @author Georde Henrique
 * @link https://github.com/Georde/Codeigniter-HMVC-Geosan
 * @copyright Copyright (c) 2016, Georde Henrique (https://github.com/Georde)
 * @license	http://opensource.org/licenses/MIT	MIT License
 */

class Geosan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request()) {
            echo "Está é uma ferramenta de linha de comando";
            exit();
            return false;
        }

        $this->load->helper('file');
    }

    public function _remap($method, $params = array())
    {
        switch ($method) {
            case 'modulo':
                $this->modulo(
                    isset($params[0]) ? $params[0] : Null,
                    isset($params[1]) ? $params[1] : 'MX_Controller'
                );
                break;
            case 'controller':
                $this->controller(
                    isset($params[0]) ? $params[0] : Null,
                    isset($params[1]) ? $params[1] : Null,
                    isset($params[2]) ? $params[2] : 'MX_Controller'

                );
                break;
            case 'model':
                $this->model(
                    isset($params[0]) ? $params[0] : Null,
                    isset($params[1]) ? $params[1] : Null,
                    isset($params[2]) ? $params[2] : Null,
                    isset($params[3]) ? $params[3] : Null,
                    isset($params[4]) ? $params[4] : 'CI_Model'
                );
                break;

            default:
                $this->index();
                break;
        }
        return true;
    }

    public function index()
    {
        echo "\n\033[32mUso:\n\033[0m";
        echo " modulo	        Criar modulo\n";
        echo " controller	Criar controller\n";
        echo " model		Criar model\n";
        return true;
    }

    protected function createController($name, $extendsName)
    {
        $name = explode('/', $name)[count(explode('/', $name)) - 1]; // Find the end of array
        $data = "<?php\n\nclass " . $name . " extends " . $extendsName . " {\n";
        $data .= "\n	public function __construct()\n";
        $data .= "	{\n";
        $data .= "		parent::__construct();\n";
        $data .= "	}\n";
        $data .= "\n    public function index()\n";
        $data .= "	{\n";
        $data .= "	    $"."t"."h"."i"."s->load->view('index');\n";
        $data .= "	}\n";
        $data .= "}";
        return $data;
    }

    protected function createModel($name, $table, $primaryKey, $extendsName)
    {
        $name = explode('/', $name)[count(explode('/', $name)) - 1];
        $data = "<?php\n\nclass " . $name . "_model extends " . $extendsName . " {\n";
        if (isset($table)) {
            $data .= '	protected $table = \'' . $table . "';\n";
        }
        if (isset($primaryKey)) {
            $data .= '	protected $primaryKey = \'' . $primaryKey . "';\n";
        }
        $data .= "\n	public function __construct()\n";
        $data .= "	{\n";
        $data .= "		parent::__construct();\n";
        $data .= "	}\n";
        $data .= "}";
        return $data;
    }

    public function modulo($name = Null, $extendsName = 'MX_Controller')
    {
        if (!isset($name)) {
            echo "\033[33mParâmetros:\n\033[0m";
            echo " nome		Nome do Modulo a ser criado (serão criadas as pastas controllers, models e views)\n";
            echo "\033[33mExamplo:\n\033[0m";
            echo " geosan modulo usuarios (Cria o modulo usuarios e as pastas controllers, views e models)\n";
            return false;
        }

        $dir = APPPATH . "modules/" . strtolower($name);
        $dirController = APPPATH . "modules/" . strtolower($name) . "/controllers/";
        $dirModel = APPPATH . "modules/" . strtolower($name) . "/models/";
        $dirViews = APPPATH . "modules/" . strtolower($name) . "/views/";
        $dirJs = APPPATH . "modules/" . strtolower($name) . "/js/";

        if (!file_exists($dir))
        {
            if (!is_dir($dir))
            {
                mkdir($dir);
            }
            if (!is_dir($dirController))
            {
                mkdir($dirController);
            }
            if (!is_dir($dirModel))
            {
                mkdir($dirModel);
            }
            if (!is_dir($dirViews))
            {
                mkdir($dirViews);
                touch($dirViews . 'index.php');
                $index = fopen($dirViews . "index.php", "a");
                $escreve = fwrite($index, "<!DOCTYPE html>\n<html lang='pt_BR'>\n<head>\n\t<meta charset='UTF-8'>\n\t<title>Index</title>\n</head>\n\n<body>\n\t<h1 align='center'>Index</h1>\n</body>\n</html>");
                fclose($index);
            }   
            if (!is_dir($dirJs))
            {
                mkdir($dirJs);
            }

            if (!write_file($dirController . ucfirst($name) . '.php',
                $this->createController(ucfirst($name), $extendsName)))
            {
                echo "Não foi possível criar o controller.\n";
                return false;
            }

            if (!write_file($dirModel . ucfirst($name) . '_model.php',
                $this->createModel(ucfirst($name), $name, "id".ucfirst($name), 'CI_Model')))
            {
                echo "Não foi possível criar o model.\n";
                return false;
            }
            echo "\n\033[32mO modulo foi criado com sucesso!\n\033[0m";
            return true;

        }else
        {
            echo "\n\033[31mÔps... O modulo ".$name." já existe.\n\033[0m";
            return false;
        }

    }

    public function controller($modulo = null, $name = Null, $extendsName = 'MX_Controller')
    {

        if (!isset($name) || !isset($modulo)) {
            echo "\033[33mParâmetros:\n\033[0m";
            echo " modulo		Nome do Modulo onde será criado o controller\n";
            echo " nome		Nome do Controller a ser criado\n";
            echo "\033[33mExamplo:\n\033[0m";
            echo " geosan controller usuarios admin (Cria o controller admin dentro do modulo usuarios)\n";
            return false;
        }

        $dir = APPPATH . "modules/" . strtolower($modulo);
        $dirController = APPPATH . "modules/" . strtolower($modulo) . "/controllers/";
        if (!file_exists($dir))
        {
            echo "\n\033[31mÔps... O modulo ".$modulo." não existe.\n\033[0m";
            return false;
        }

        if (file_exists($dirController . ucfirst($name) . '.php'))
        {
            echo "\n\033[31mÔps... O controller ".$name." já existe.\n\033[0m";
            return false;
        }

        if (!write_file($dirController . ucfirst($name) . '.php',
            $this->createController(ucfirst($name), $extendsName)))
        {
            echo "\n\033[31mÔps... Ocorreu um erro ao tentar criar o controller ".$name.".\n\033[0m";
            return false;
        }
        echo "\n\033[32mO controller ".$name." foi criado com sucesso!\n\033[0m";

        return true;
    }

    public function model($module = NULL, $name = Null, $table = Null, $primaryKey = Null, $extendsName = 'CI_Model')
    {
        if (!isset($module) || !isset($name)) {
            echo "\033[33mParâmetros:\n\033[0m";
            echo " modulo		     Nome do Modulo onde será criada o model\n";
            echo " nome		     Nome do Model a ser criada\n";
            echo " tabela		     Nome da tabela (opcional)\n";
            echo " chave primária	     Nome da chave primaria (opcional)\n";
            echo "\033[33mExamplo:\n\033[0m";
            echo " geosan model usuarios admin admins idAdmin (Cria o model admin dentro do modulo usuarios, com a tabela admins e a chave primaria idAdmin)\n";
            return false;
        }

        $dirModels = APPPATH . "modules/" . strtolower($module) . "/models/";

        $dir = APPPATH . "modules/" . strtolower($module);

        if (!file_exists($dir))
        {
            echo "\n\033[31mÔps... O modulo ".$module." não existe.\n\033[0m";
            return false;
        }

        if (file_exists($dirModels . ucfirst($name) . '_model.php'))
        {
            echo "\n\033[31mÔps... O model ".$name." já existe.\n\033[0m";
            return false;
        }

        if (!write_file($dirModels . ucfirst($name) . '_model.php',
            $this->createModel(ucfirst($name), (!isset($table)?$name : $table), (!isset($primaryKey)? "id".ucfirst($name) : $primaryKey), $extendsName)))
        {
            echo "\n\033[31mÔps... Ocorreu um erro ao tentar criar o model ".$name.".\n\033[0m";
            return false;
        }
        echo "\n\033[32mO model ".$name." foi criado com sucesso!\n\033[0m";
        return true;
    }

}
