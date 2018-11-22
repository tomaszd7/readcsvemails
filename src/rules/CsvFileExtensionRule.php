<?php
namespace Rules;

/**
 * Description of CsvFileExtensionRule
 *
 * @author tomasz
 */
class CsvFileExtensionRule implements RulesInterface{
    
    public function isSatisfiedby(array $params):bool {
        if (!isset($params[1])) {
            return false;
        }
        
        return ".csv" === substr($params[1], -4);
    }
    
    public function getErrorText() {
        return "Argument has to be a CSV file.";
    }
}
