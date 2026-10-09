@echo off
setlocal
cd /d "%~dp0"
set "PHP_EXE=C:\xampp\php\php.exe"
if not exist "%PHP_EXE%" (
  echo XAMPP PHP was not found at C:\xampp\php\php.exe.
  echo Install XAMPP or update PHP_EXE in this file to a PHP build with mysqli and intl enabled.
  pause
  exit /b 1
)
"%PHP_EXE%" -d extension=php_intl.dll -S 127.0.0.1:8083 -t public vendor\codeigniter4\framework\system\rewrite.php
pause
endlocal
