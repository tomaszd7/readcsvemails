<?php

namespace Factory;

use \Service\ScriptValidatorAbstract;
use Service\ScriptValidator;
use Service\ScriptValidatorForSymfony;
use Service\FileNamer;
use Service\CsvFileReader;
use Service\ArrayFileWriter;
use Service\EmailsService;
use Command\ReadCsvEmailsCommand;
use Service\EmailValidator;
/**
 * Description of CommandFactory
 *
 * @author tomasz
 */
class CommandFactory {

    public static function getReadCsvEmailsCommandWithThrowExceptions() {
        return self::getInstance(ScriptValidatorAbstract::THROW_ERRORS);
    }
    
    public static function getReadCsvEmailsCommandWithLogExceptions() {
        return self::getInstance(ScriptValidatorAbstract::LOG_ERRORS);
    }
    
    public static function getReadCsvEmailsCommandWithLogExceptionsForSymfony() {
        return new ReadCsvEmailsCommand(
                new ScriptValidatorForSymfony(ScriptValidatorAbstract::LOG_ERRORS),
                new CsvFileReader(),
                new ArrayFileWriter(),
                new FileNamer(),
                new EmailsService(new EmailValidator())
                );        
    }    
    
    protected static function getInstance(int $errorLoggin) {
        return new ReadCsvEmailsCommand(
                new ScriptValidator($errorLoggin),
                new CsvFileReader(),
                new ArrayFileWriter(),
                new FileNamer(),
                new EmailsService(new EmailValidator())
                );
    }
}
