<?php
namespace Geosan\Structure;

class FileStructure{

	private $structureFile;

	public function controller(){
		return $this->getFile("Controller");
	}

	public function model(){
		return $this->getFile("Model");
	}

	public function view(){
		return $this->viewEmpty();
	}

	public function viewEmpty(){
		return $this->getFile("View");
	}

	public function viewHtml(){
		return $this->getFile("ViewHtml");
	}

	public function helper(){
		return $this->getFile("Helper");
	}

	public function migration(){
		return $this->getFile("Migration");
	}

	public function core(){
		return $this->getFile("Core");
	}

	public function coreExtend(){
		return $this->getFile("CoreExtend");
	}

	private function getFile($file){
		if(is_null($this->structureFile))
			$this->structureFile = file_get_contents(__DIR__."/Files/{$file}.php");

		return $this->structureFile;
	}
}
?>