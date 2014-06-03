<?php

namespace Process;

use Symfony\Component\Process\Process;
use Predis\Client;

class Queue
{
    /**
     * @var Client
     */
    private $redis;
    
    const PROCESS_QUEUE = 'process-queue';
    
    public function __construct(Client $redis)
    {
        $this->redis          = $redis;
    }
    
    public function enqueue(Process $process)
    {
        $this->redis->lpush(self::PROCESS_QUEUE, serialize($process));
    }
    
    /**
     * @return Process
     */
    public function dequeue()
    {
        return unserialize($this->redis->rpop(self::PROCESS_QUEUE));
    }
}
