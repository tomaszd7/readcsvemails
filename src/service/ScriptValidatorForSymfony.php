<?php


namespace Service;

use Rules\CsvFileExtensionRule;
use Rules\FileExistsRule;

/**
 * Description of ScriptValidatorForSymfony
 *
 * @author tomasz
 */
class ScriptValidatorForSymfony extends ScriptValidatorAbstract{
    
    protected function addRules() {
        $this->addRule(new CsvFileExtensionRule());
        $this->addRule(new FileExistsRule());
    }  
}
