<?php

error_reporting(E_ALL & ~E_DEPRECATED);

use IanRothmann\AINinja\Tests\IntegrationTestCase;
use IanRothmann\AINinja\Tests\UnitTestCase;

uses(IntegrationTestCase::class)->in('Integration');
uses(UnitTestCase::class)->in('Unit');
