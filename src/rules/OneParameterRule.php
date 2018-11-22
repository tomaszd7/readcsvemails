<?php
namespace Rules;

/**
 * Description of OneParameterRule
 *
 * @author tomasz
 */
class OneParameterRule implements RulesInterface{
    
    public function isSatisfiedby(array $params):bool {
        return 2 === count($params);
    }
    
    public function getErrorText() {
        return "Program requires only 1 parameter.";
    }
}
