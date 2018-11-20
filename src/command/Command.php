<?php

namespace Command;

use Service\ScriptValidator;
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

    public function __construct(
            // this should be in interfaces not final classes but I added it for IDE hinting
            // and for simplification
            ScriptValidator $scriptValidator,
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

    public abstract function run(int $paramsCount, array $params);
}
