<?php
namespace Rules;

/**
 * Description of FileExistsRule
 *
 * @author tomasz
 */
class FileExistsRule implements RulesInterface{
    
    protected $filename;
    
    public function isSatisfiedby(array $params):bool {
        if (!isset($params[1])) {
            return false;
        }
        $this->filename = $params[1];
        return file_exists($this->filename);
    }
    
    public function getErrorText() {
        return sprintf("File %s does not exist.", $this->filename);
    }
}
