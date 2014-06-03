<?php

namespace Process;

use Process\Builder as ProcessBuilder;

class Cylinderize
{
    /**
     * @var \SplFileInfo
     */
    private $input;
    
    /**
     * @var \SplFileInfo
     */
    private $background;
    
    /**
     * @var \SplFileInfo
     */
    private $output;
    
    public function __construct(\SplFileInfo $input)
    {
        $this->input = $input;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setInput(\SplFileInfo $input)
    {
        $this->input = $input;
    }

    public function setBackground(\SplFileInfo $background)
    {
        $this->background = $background;
    }

    public function setOutput(\SplFileInfo $output)
    {
        $this->output = $output;
    }
    
    /**
     * @return \Symfony\Component\Process\Process
     */
    public function getProcess()
    {
        $builder = new ProcessBuilder(array());
        $builder->setPrefix('./cylinderize');
        $builder->add('-m vertical')
            ->add('-r 73')
            ->add('-l 120')
            ->add('-w 90')
            ->add('-p 5')
            ->add('-n 94')
            ->add('-e 2')
            ->add('-a 100')
            ->add('-v background')
            ->add('-b none')
            ->add('-f none')
            ->add('-o +24+10');
        //$builder->add('-m vertical -r 73 -l 120 -w 90 -p 5 -n 94 -e 2 -s 200 -a 100 -v background -b none -f none -o +24+10');
        $builder->add($this->getInput()->getRealPath());
        $builder->add($this->getBackground()->getRealPath());
        $builder->add($this->getOutput()->getRealPath());
        $builder->setWorkingDirectory('tools');
        
        return $builder->getProcess();
    }
}
