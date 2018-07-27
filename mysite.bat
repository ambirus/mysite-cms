@echo off

rem -------------------------------------------------------------
rem  MySite CMS command line bootstrap script for Windows.
rem
rem  @author Ambirus <ambirus1@gmail.com>
rem  @link http://mysite-cms.ru/
rem  @copyright Copyright (c) 2018 MySite CMS
rem -------------------------------------------------------------

@setlocal

set MYSITE_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" "%MYSITE_PATH%mysite" %*

@endlocal