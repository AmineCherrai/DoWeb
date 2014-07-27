<?php

if(!defined('ROOT'))exit('No direct script access allowed');

/*
|---------------------------------------------------------
|					ERROR CONFIGURATION
|---------------------------------------------------------
*/

/*
|
| change this to false if you want to hide errors and store them in the log file
|
*/
$config['environment']	= false;

/*
|
| set log file.
|
*/
$config['log_file'] = SYSTEM.'logs'.DS.'error.log';


/*
|---------------------------------------------------------
|					WWW CONFIGURATION
|---------------------------------------------------------
*/

/*
|
| change this to your domain name (eg http://domain.name/)
| NOTE: don't forget the slash at the end
|
*/
$config['website'] = 'http://doweb.local/';

$config['domain'] = 'doweb.local';


/*
|
| set the public directory.
|
*/
$config['public_path'] = 'WWW';


/*
|
| set css directory.
|
*/
$config['css_path'] = $config['website'].$config['public_path'].'/css/';


/*
|
| set javascript directory.
|
*/
$config['js_path'] = $config['website'].$config['public_path'].'/js/';


/*
|
| set jQuery directory.
|
*/
$config['jq_path'] = $config['js_path'].'jq/';

/*
|
| set image directory.
|
*/
$config['img_path'] = $config['website'].$config['public_path'].'/img/';

/*
|---------------------------------------------------------
|					PATHE CONFIGURATION
|---------------------------------------------------------
*/

/*
|
| set the CONTROLLER directory
|
*/
$config['controllers_path'] = APPLICATION.'Controllers'.DS;

/*
|
| set the CONTROLLER PATH SUFFIX
|
*/
$config['controller_path_suffix'] = '_Controller';

/*
|
| set the CONTROLLER CLASS SUFFIX
|
*/
$config['controller_class_suffix'] = '_Controller';


/*
|
| set the MODEL directory
|
*/
$config['models_path'] = APPLICATION.'Models'.DS;

/*
|
| set the CONTROLLER PATH SUFFIX
|
*/
$config['model_path_suffix'] = '_Model';

/*
|
| set the CONTROLLER CLASS SUFFIX
|
*/
$config['model_class_suffix'] = '_Model';

/*
|
| set the VIEWS directory
|
*/
$config['views_path'] = APPLICATION.'Views'.DS.'default_view'.DS;

/*
|
| set the VIEWS EXTENSION
|
*/
$config['views_ext'] = '.html';

#EOF