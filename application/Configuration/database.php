<?php

if(!defined('ROOT'))exit('No direct script access allowed');

/*
|---------------------------------------------------------
|					DB CONFIGURATION
|---------------------------------------------------------
|
| this version of DoWeb uses PDO to manipulate the database
| ['environment']	true if you want to display database errors, false if you don't want.
| ['use_db']		true if you are using database, false if you are not.
| ['db_driver']		mysql , sqlite...(deppend on what your php support and what database you use)
| ['db_host']		change this to your database host
| ['db_user']		change this to your database user
| ['db_password']	change this to your database password
| ['db_name']		change this to your database name
|
*/

$config['use_db']		=	 true;
$config['db_driver']	=	'mysql';
$config['db_host']		=	'localhost';
$config['db_user']		=	'root';
$config['db_password']	=	'0rt@';
$config['db_name']		=	'doweb_db';

#EOF
