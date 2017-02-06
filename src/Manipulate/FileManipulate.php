<?php
namespace Geosan\Manipulate;

class FileManipulate
{

    private $fileName;
    private $filePath;
    private $fileContent;
    private $fileReplace;
    private $fileReplaceTable;
    private $fileArrayReplace;
    private $prefixPath;

    const REPLACE_DEFAULT = "REPLACE_NAME_HERE";
    const REPLACE_TABLE = "REPLACE_NAME_TABLE";

    public function createFile($fileName, $fileContent, $prefixPath, $replace = true, $arrayReplace = false)
    {
        $this->fileName = $fileName;
        $this->fileContent = $fileContent;
        $this->prefixPath = $prefixPath;

        if ($replace === true) {
            $this->fileReplace = self::REPLACE_DEFAULT;
            $this->fileReplaceTable = self::REPLACE_TABLE;
        } elseif ($replace != false and !$replace === true) {
            $this->fileReplace = $replace;
            $this->fileReplaceTable = $replace;
        }

        if ($arrayReplace !== false and is_array($arrayReplace) and count($arrayReplace) > 0)
            $this->fileArrayReplace = $arrayReplace;


        $explodePath = explode('/', $fileName);
        $countBars = count($explodePath);

        if ($countBars == 1)
            return $this->renderFile();

        for ($i = 0; $i < $countBars; $i++) {
            if ($i == ($countBars - 1)) {
                $this->fileName = $explodePath[$i];
                break;
            }

            $this->filePath .= $explodePath[$i] . "/";

            if (file_exists($this->prefixPath . $this->filePath))
                continue;

            mkdir($this->prefixPath . $this->filePath);
        }

        return $this->renderFile();
    }

    private function renderFile()
    {
        $fileFullPath = $this->prefixPath;


        if (!is_null($this->filePath))
            $fileFullPath .= $this->filePath;

        $fileFullPath .= $this->fileName . ".php";
        $fileContent = $this->fileContent;


        if (file_exists($fileFullPath))
            return "exist";

        if (!is_null($this->fileReplace) && !is_null($this->fileReplaceTable)){
            $fileContent = str_replace($this->fileReplace, $this->fileName, $fileContent);
            $fileContent = str_replace($this->fileReplaceTable, strtolower($this->fileName), $fileContent);
        }


        if (!is_null($this->fileArrayReplace)) {
            foreach ($this->fileArrayReplace as $ref => $value)
                $fileContent = str_replace($ref, $value, $fileContent);

        }

        $handleNewFile = fopen($fileFullPath, "w");
        fwrite($handleNewFile, $fileContent);
        fclose($handleNewFile);

        return true;
    }

    public function addInFile($contentAdd, $filePath)
    {
        if (file_put_contents($filePath, $contentAdd, FILE_APPEND))
            return true;

        return 'failed';
    }
}