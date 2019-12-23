<?php
/**
 * @file Bootstrapping File for Test Suite
 */

use Composer\Autoload\ClassLoader;

$envs_path = __DIR__ . '/../envs.local.php';
if (is_file($envs_path))
{
   include $envs_path;
}

$loader_path = __DIR__ . '/../vendor/autoload.php';
/* @var $loader ClassLoader */
$loader = include $loader_path;
$loader->add('', __DIR__);
