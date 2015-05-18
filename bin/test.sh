#!/usr/bin/env bash

marshaller="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"

$marshaller/vendor/bin/phpspec run -f dot && $marshaller/vendor/bin/phpunit && $marshaller/vendor/bin/php-cs-fixer fix --dry-run --config=sf23 .
