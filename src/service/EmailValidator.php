<?php

namespace Service;

/**
 * Description of EmailValidator
 *
 * @author tomasz
 */
class EmailValidator {
    
    public function validate(string $email) {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }
            
}
