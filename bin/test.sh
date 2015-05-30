#!/usr/bin/env bash

vendor/bin/phpspec --no-interaction run --format=dot && vendor/bin/phpunit && vendor/bin/php-cs-fixer fix --dry-run --config=sf23 .
