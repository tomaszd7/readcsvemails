<?php

namespace Factory;

use Service\ScriptValidator;
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
        return self::getInstance(ScriptValidator::THROW_ERRORS);
    }
    
    public static function getReadCsvEmailsCommandWithLogExceptions() {
        return self::getInstance(ScriptValidator::LOG_ERRORS);
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
