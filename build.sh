#!/bin/bash

# Run this file from /trunk/

curl -s -o hosted-content-importer/classes/parsedown/Parsedown.php -O https://raw.githubusercontent.com/erusev/parsedown/master/Parsedown.php

rm -f caches/*.cache
rm -f classes/parsedown/readme.md
rm -f build.sh
