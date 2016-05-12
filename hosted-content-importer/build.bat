@ECHO OFF
REM Run this file from \trunk\

curl -s -o classes\parsedown\Parsedown.php -O https://raw.githubusercontent.com/erusev/parsedown/master/Parsedown.php

DEL /F /Q caches\*.cache
DEL /F /Q classes\parsedown\readme.md
DEL /F /Q build.sh
DEL /F /Q build.bat
