<?php  /// Moodle Configuration File 

unset($CFG);
$CFG = new stdClass();
//=========================================================================
// 1. DATABASE SETUP
//=========================================================================
//GET database configuration from azure 
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = $connectstr_dbhost;
$CFG->dbname    = $connectstr_dbname;
$CFG->dbuser    = $connectstr_dbusername;
$CFG->dbpass    = $connectstr_dbpassword;
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
);

//=========================================================================
// 1.5. SECRET PASSWORD SALT
//=========================================================================
// User password salt is very important security feature, it is created
// automatically in installer, you have to uncomment and modify value
// on the next line if you are creating config.php manually.
//
$CFG->passwordsaltmain = password_hash( $connectstr_dbusername, PASSWORD_DEFAULT);

// After changing the main salt you have to copy old value into one
// of the following settings - this allows migration to the new salt
// during the next login of each user.
//
// $CFG->passwordsaltalt1 = '';
// $CFG->passwordsaltalt2 = '';
// $CFG->passwordsaltalt3 = '';
// ....
// $CFG->passwordsaltalt19 = '';
// $CFG->passwordsaltalt20 = '';


//=========================================================================
// 2. WEB SITE LOCATION
//=========================================================================
// Now you need to tell Moodle where it is located. Specify the full
// web address to where moodle has been installed.  If your web site
// is accessible via multiple URLs then choose the most natural one
// that your students would use.  Do not include a trailing slash
// NOTE: The WPI Installer uses the following lines to guess the url being used,
// You should modify this to use a full url if you are running a production server.
$app = 'PlaceHolderForDbApp';
$CFG->wwwroot   = rtrim(strtolower($app),"/");
//=========================================================================
// 4. DATA FILES LOCATION
//=========================================================================
// Now you need a place where Moodle can save uploaded files.  This
// directory should be readable AND WRITEABLE by the web server user
// (usually 'nobody' or 'apache'), but it should not be accessible
// directly via the web.
//
// - On hosting systems you might need to make sure that your "group" has
//   no permissions at all, but that "others" have full permissions.
//
// - On Windows systems you might specify something like 'c:\moodledata'
// NOTE: the WPI uses a folder within the webroot however it is protected by the settings in the web.config file
// If you are running this in production, it would be a good idea to move this directory outside the webroot
$CFG->dataroot  = str_replace('\\','/',dirname(__FILE__).'\moodledata');

//=========================================================================
// 5. DATA FILES PERMISSIONS
//=========================================================================
// The following parameter sets the permissions of new directories
// created by Moodle within the data directory.  The format is in
// octal format (as used by the Unix utility chmod, for example).
// The default is usually OK, but you may want to change it to 0750
// if you are concerned about world-access to the files (you will need
// to make sure the web server process (eg Apache) can access the files.
// NOTE: the prefixed 0 is important, and don't use quotes.

$CFG->directorypermissions = 00777;

//=========================================================================
// 6. DIRECTORY LOCATION  (most people can just ignore this setting)
//=========================================================================
// A very few webhosts use /admin as a special URL for you to access a
// control panel or something.  Unfortunately this conflicts with the
// standard location for the Moodle admin pages.  You can fix this by
// renaming the admin directory in your installation, and putting that
// new name here.  eg "moodleadmin".  This will fix admin links in Moodle.

$CFG->admin = 'admin';

//=========================================================================
// 7. OTHER MISCELLANEOUS SETTINGS (ignore these for new installations)
//=========================================================================

//allow Windows to find the openssl.cnf file during use of Mnet 
$CFG->opensslcnf = getenv('PHPRC').'extras\openssl\openssl.cnf';

require_once(dirname(__FILE__) . '/lib/setup.php'); // Do not edit

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
