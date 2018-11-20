<?php

namespace Command;

use Command\Command;
use Service\FileNamer;

/**
 * Description of ReadCsvEmailsCommand
 *
 * @author tomasz
 */
class ReadCsvEmailsCommand extends Command {

    public function run(int $paramsCount, array $params) {
        $error = $this->scriptValidator->validate($paramsCount, $params);

        if ($error) {
            $this->fileNamer->setDefaults('error');
            $this->fileWriter->save((array) $error, $this->fileNamer->getInfoName());
            exit(1);
        }
        
        $fileNameWithExtension = $params[1];
        $fileNameNoExtension = explode(FileNamer::EXTENSION_CSV, $fileNameWithExtension)[0];

        $this->fileNamer->setDefaults($fileNameNoExtension);
        
        $emails = $this->fileReader->read($fileNameWithExtension);

        $this->emailService->process($emails);
        
        $this->fileWriter->save($this->emailService->getValidEmails(), $this->fileNamer->getValidName());
        $this->fileWriter->save($this->emailService->getInvalidEmails(), $this->fileNamer->getInvalidName());
               
        // save execution info
        $texts = [];
        $texts[] = sprintf("Found %d valid emails and saved into file %s",
                count($this->emailService->getValidEmails()), 
                $this->fileNamer->getValidName());
        $texts[] = sprintf("Found %d invalid emails and saved into file %s",
                count($this->emailService->getInvalidEmails()),
                $this->fileNamer->getInvalidName());
        $texts[] = 'No errors found.';
        $this->fileWriter->save($texts, $this->fileNamer->getInfoName());
                
    }
}
