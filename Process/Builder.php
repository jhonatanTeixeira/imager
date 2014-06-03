<?php

namespace Process;

use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Process;

class Builder extends ProcessBuilder
{
    public function getProcess()
    {
        if (!$this->prefix && !count($this->arguments)) {
            throw new LogicException('You must add() command arguments before calling getProcess().');
        }

        $options = $this->options;

        $arguments = $this->prefix ? array_merge(array($this->prefix), $this->arguments) : $this->arguments;
        $script = escapeshellcmd(implode(' ', $arguments));

        if ($this->inheritEnv) {
            $env = $this->env ? $this->env + $_ENV : null;
        } else {
            $env = $this->env;
        }

        return new Process($script, $this->cwd, $env, $this->stdin, $this->timeout, $options);
    }
}
