<?php
namespace Rules;

/**
 * Description of ConsoleRule
 *
 * @author tomasz
 */
class ConsoleRule implements RulesInterface{
    
    public function isSatisfiedby(array $params):bool {
        return "cli" === \php_sapi_name();
    }
    
    public function getErrorText() {
        return "This program runs only in console.";
    }
}
