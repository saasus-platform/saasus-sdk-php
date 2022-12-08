#!/bin/bash

cd `dirname $0`

../vendor/bin/phpunit -v ../test/SdkTest.php
