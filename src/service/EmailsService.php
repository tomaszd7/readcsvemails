<?php

namespace Service;

/**
 * Description of EmailsService
 *
 * @author tomasz
 */
class EmailsService {

    /**
     * validator instance
     * @var type EmailValidator
     */
    protected $validator;
    
    /**
     *
     * @var type array
     */
    protected $validEmails;
    protected $invalidEmails;
    
    public function __construct(EmailValidator $validator) {
        $this->validator = $validator;
    }
    
    public function process(array $emails) {
        
        foreach ($emails as $email) {
           // taking only first column in case more data is provided
           if (is_array($email)) {
               $email = $email[0];
           }
                      
           if (is_string($email) && $this->validator->validate($email)) {
              $this->validEmails[] = $email;
           } else {
              $this->invalidEmails[] = $email;
           }
       }  
    }
    
    public function getValidEmails() {
       return $this->validEmails;
    }

    public function getInvalidEmails() {
       return $this->invalidEmails;
    }    
}
