<?php

$paths = [];

$paths['site']      = dirname(dirname(__DIR__));
$paths['uploads']   = $paths['site'] . '/uploads';
$paths['root']      = $paths['site'] . '/wms';
$paths['logs']      = $paths['root'] . '/logs';
$paths['tmp']       = $paths['root'] . '/tmp';
$paths['resources'] = $paths['root'] . '/resources';
$paths['languages'] = $paths['resources'] . '/languages';
$paths['templates'] = $paths['resources'] . '/templates';
$paths['views']     = $paths['resources'] . '/views';
$paths['data']      = $paths['resources'] . '/data';

return $paths;
