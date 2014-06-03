<?php

namespace Process;

use Symfony\Component\Process\Process;

class Manager implements \Countable
{
    /**
     * @var Process[]
     */
    private $processes = array();
    
    public function dispatch(Process $process)
    {
        $this->processes[] = $process;
        
        $process->start();
    }

    public function count()
    {
        return count($this->processes);
    }

    public function terminateAllProcesses()
    {
        foreach ($this->processes as $process) {
            $process->stop();
        }
    }
    
    public function cleanFinishedProcesses()
    {
        foreach ($this->processes as $key => $process) {
            if (!$process->isRunning()) {
                unset($this->processes[$key]);
            }
        }
    }
}
