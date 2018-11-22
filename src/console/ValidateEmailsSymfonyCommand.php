<?php

namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Symfony\Component\Console\Input\InputArgument;

use Factory\CommandFactory;

/**
 * Description of ValidateEmailsCommand
 *
 * @author tomasz
 */
class ValidateEmailsSymfonyCommand extends Command{
    
    protected function configure()
    {
        $this->setName('validate_emails')
                ->setDescription('Validating emails from csv file.')
                ->setHelp('No help at the moment')
                ->addArgument('filename', InputArgument::REQUIRED, 'Csv filename with emails.');
        
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');
        // pretending we get params from $args
        $params = [null, $filename];

        $command = CommandFactory::getReadCsvEmailsCommandWithLogExceptionsForSymfony();

        $command->run($params);

        foreach ($command->getInfos() as $info) {
            $output->writeln($info);
        }

    }    
}
