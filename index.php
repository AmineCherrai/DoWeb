<?php

/** move to the current directory */
if(defined('STDIN'))chdir(dirname(__FILE__));

/** define DIRECTORY SEPARATOR whether it is Slash or a Backslash */
define('DS', DIRECTORY_SEPARATOR);

/** define ROOT DIRECTORY */
define('ROOT', rtrim(realpath(dirname(__FILE__)),DS).DS);

/** define SYSTEM DIRECTORY */
define('SYSTEM', ROOT.'system'.DS);

/** define APPLICATION DIRECTORY */
define('APPLICATION', ROOT.'application'.DS);

/** include System configuration file */
require(realpath(SYSTEM.'Configuration'.DS.'config.php'));

/** include Startup file and run the framework */
require(realpath(SYSTEM.'Core'.DS.'Startup.php'));


#EOF