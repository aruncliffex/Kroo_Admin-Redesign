<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);


// define('FIRSTURL', 'http://localhost:8080/kroo_admin/');
define('UPLOADURL', $_SERVER['SERVER_NAME'].':80');
define('SITEURL' , 'http://'.$_SERVER['HTTP_HOST'].'/');
define('HOMEURL' , SITEURL.'dashboard/main/');
define('ASSETS' , SITEURL.'assets/');

define('PLAYER_IMAGE', 'https://thekroo-live-storage.s3.amazonaws.com/playerimages/');
define('S3_PATH', 		'https://thekroo-live-storage.s3.amazonaws.com/');
define('teamlogo', 		'https://thekroo-live-storage.s3.amazonaws.com/teamlogo/');
define('newsimage', 	'https://thekroo-live-storage.s3.amazonaws.com/newsimages/');
define('articleimage', 	'https://thekroo-live-storage.s3.amazonaws.com/articleimage/');
define('leaguelogo', 	'https://thekroo-live-storage.s3.amazonaws.com/leaguelogo/');
define('channellogo', 'https://thekroo-live-storage.s3.amazonaws.com/channellogo/');
define('NOTIFICATION_API_PATH', 'http://api.thekroo.com/');
define('ADMIN_PATH', 'http://admin.thekroo.com/');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//define('API_ACCESS_KEY', 'AIzaSyBQOrzUuXfGG0cpfkLPhwkoqysqQbs_GpE');

//define('API_ACCESS_KEY', 'AIzaSyBEjJhKeXgOT62M0KAfEXG7t1RI9R4-3wo');
define('API_ACCESS_KEY', 'AIzaSyAk_YSjfGNF3Tb5AZLR0YgKFkm4YzCd0aE');



/* End of file constants.php */
/* Location: ./application/config/constants.php */