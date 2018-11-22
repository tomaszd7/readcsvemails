<?php

namespace Command;

use \Service\ScriptValidatorAbstract;
use Service\FileNamer;
use Service\CsvFileReader;
use Service\ArrayFileWriter;
use Service\EmailsService;

/**
 * Description of Command
 *
 * @author tomasz
 */
abstract class Command {

    /**
     * @var EmailsService
     */
    protected $emailService;

    /**
     * @var FileNamer
     */
    protected $fileNamer;

    /**
     * @var ArrayFileWriter
     */
    protected $fileWriter;

    /**
     * @var CsvFileReader
     */
    protected $fileReader;

    /**
     * @var ScriptValidator
     */
    protected $scriptValidator;
    
    protected $infos = [];

    public function __construct(
            // this should be in interfaces or abstracts not final classes 
            // but I added it for IDE hinting and simplification
            ScriptValidatorAbstract $scriptValidator,
            CsvFileReader $fileReader,
            ArrayFileWriter $fileWriter,
            FileNamer $fileNamer,
            EmailsService $emailService
            ) 
    {          
        $this->scriptValidator = $scriptValidator;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->fileNamer = $fileNamer;
        $this->emailService = $emailService;
    }

    public abstract function run(array $params);
    
    public function getInfos() {
        return $this->infos;
    }
}
