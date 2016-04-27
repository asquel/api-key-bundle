<?php

$file = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException("Install dependencies using composer to run the test suite.");
}
$autoload = require $file;
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($autoload, 'loadClass'));
\Symfony\Component\Validator\Validation::createValidatorBuilder()->enableAnnotationMapping();


$kernelDir = __DIR__ . '/fixtures/app';
$evt = 'test';