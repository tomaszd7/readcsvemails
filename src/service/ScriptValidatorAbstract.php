<?php


namespace Service;

use Rules\RulesInterface;

/**
 * Description of ScriptValidatorAbstract
 *
 * @author tomasz
 */
abstract class ScriptValidatorAbstract {
    
    const LOG_ERRORS = 0;
    const THROW_ERRORS = 1;
    protected $errorLogging;
    
    protected $rules = [];


    public function __construct(int $errorLoggin) {
        $this->errorLogging = $errorLoggin;
        $this->addRules();
    }
    
    protected abstract function addRules();

    protected function addRule(RulesInterface $rule) {
        $this->rules[] = $rule;
    }
    
    /**
     * check if all running parameters are met before reading file
     * @param array $params
     * @return type string
     * @throws Exception
     */
    public function validate(array $params) {
        // checking rules as first error breaks program 
        // so it is important to add rules in correct order

        foreach ($this->rules as $rule) {
            if ($rule->isSatisfiedby($params)) {
                continue;
            }
            
            // return error in case of logging 
            if (self::LOG_ERRORS === $this->errorLogging) {
                return "ERROR: " . $rule->getErrorText();
            }
            throw new \Exception($rule->getErrorText());            
        }
    }
}
