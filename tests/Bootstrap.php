<?php
error_reporting(E_ALL);

$root    = realpath(dirname(dirname(__FILE__)));
$library = "$root/library";

echo $root;



set_include_path(implode(PATH_SEPARATOR, array(
    $library,
    get_include_path(),
)));

if (!file_exists($root . '/vendor/autoload.php')) {
    throw new Exception(
        'Please run "php composer.phar install --dev" in root directory '
        . 'to setup unit test dependencies before running the tests'
    );
}
require $root . '/vendor/autoload.php';

unset($root, $library, $path);