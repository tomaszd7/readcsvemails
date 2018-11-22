<?php

namespace Rules;

/**
 *
 * @author tomasz
 */
interface RulesInterface {
    public function isSatisfiedby(array $params): bool;
    
    public function getErrorText();
            
}
