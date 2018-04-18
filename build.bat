@ECHO OFF
REM Run this file from \trunk\

curl -s -o hosted-content-importer\classes\parsedown\Parsedown.php -O https://raw.githubusercontent.com/erusev/parsedown/master/Parsedown.php
curl -s -o hosted-content-importer\classes\parsedown\LICENSE.txt -O https://raw.githubusercontent.com/erusev/parsedown/master/LICENSE.txt

DEL /F /Q hosted-content-importer\caches\*.cache
DEL /F /Q hosted-content-importer\classes\parsedown\readme.md
REM DEL /F /Q build.sh
REM DEL /F /Q build.bat
