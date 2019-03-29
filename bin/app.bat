@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../src/Application/Console/app.php
php "%BIN_TARGET%" %*
