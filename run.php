<?php

/* @var $loader Composer\Autoload\ClassLoader */
$loader = require 'vendor/autoload.php';

$loader->setUseIncludePath(true);

$application = new Symfony\Component\Console\Application();

$application->add(new Command\Cylinderize());

$application->run();