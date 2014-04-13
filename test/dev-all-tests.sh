#!/bin/sh

clear
../vendor/bin/phpunit --coverage-html ../coverage/ --configuration=./config/unit-tests.xml

../vendor/bin/coveralls -v 