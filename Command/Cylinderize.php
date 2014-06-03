<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Process\Cylinderize as CylinderizeProcess;

class Cylinderize extends Command
{
    protected function configure()
    {
        $this->setName('process:cylinderize');
        $this->addArgument('input', InputArgument::REQUIRED, "the input file");
        $this->addArgument('background', InputArgument::REQUIRED, "the background file");
        $this->addArgument('output', InputArgument::REQUIRED, "the output file");
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile  = new \SplFileInfo($input->getArgument('input'));
        $background = new \SplFileInfo($input->getArgument('background'));
        $outputFile = new \SplFileInfo($input->getArgument('output'));
        
        $process = new CylinderizeProcess($inputFile);
        $process->setBackground($background);
        $process->setOutput($outputFile);
        
        $cylinderizeProcess = $process->getProcess();
        
        $output->writeln("running command {$cylinderizeProcess->getCommandLine()}");
        
        $output->writeln($cylinderizeProcess->run());
    }
}
