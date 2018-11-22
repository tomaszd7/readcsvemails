<?php


namespace Service;

use \Rules\ConsoleRule;
use \Rules\OneParameterRule;
use \Rules\CsvFileExtensionRule;
use \Rules\FileExistsRule;

/**
 * Description of ScriptValidator
 *
 * @author tomasz
 */
class ScriptValidator extends ScriptValidatorAbstract{
    
    protected function addRules() {
        $this->addRule(new ConsoleRule());
        $this->addRule(new OneParameterRule());
        $this->addRule(new CsvFileExtensionRule());
        $this->addRule(new FileExistsRule());
    }    

}
