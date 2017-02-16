#!/usr/bin/env php
<?php

chdir(dirname(__FILE__));

$returnStatus = null;

passthru('composer install', $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}

passthru("./vendor/bin/phpunit -c phpunit.xml", $returnStatus);
if ($returnStatus !== 0) {
    exit(1);
}
