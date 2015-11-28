<?php
/**
 * @package Tarefas
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// BannedIps
	'GET:bannedipses' => array('route' => 'BannedIps.ListView'),
	'GET:bannedips/(:num)' => array('route' => 'BannedIps.SingleView', 'params' => array('id' => 1)),
	'GET:api/bannedipses' => array('route' => 'BannedIps.Query'),
	'POST:api/bannedips' => array('route' => 'BannedIps.Create'),
	'GET:api/bannedips/(:num)' => array('route' => 'BannedIps.Read', 'params' => array('id' => 2)),
	'PUT:api/bannedips/(:num)' => array('route' => 'BannedIps.Update', 'params' => array('id' => 2)),
	'DELETE:api/bannedips/(:num)' => array('route' => 'BannedIps.Delete', 'params' => array('id' => 2)),
		
	// BannedWords
	'GET:bannedwordses' => array('route' => 'BannedWords.ListView'),
	'GET:bannedwords/(:num)' => array('route' => 'BannedWords.SingleView', 'params' => array('id' => 1)),
	'GET:api/bannedwordses' => array('route' => 'BannedWords.Query'),
	'POST:api/bannedwords' => array('route' => 'BannedWords.Create'),
	'GET:api/bannedwords/(:num)' => array('route' => 'BannedWords.Read', 'params' => array('id' => 2)),
	'PUT:api/bannedwords/(:num)' => array('route' => 'BannedWords.Update', 'params' => array('id' => 2)),
	'DELETE:api/bannedwords/(:num)' => array('route' => 'BannedWords.Delete', 'params' => array('id' => 2)),
		
	// Cliente
	'GET:clientes' => array('route' => 'Cliente.ListView'),
	'GET:cliente/(:num)' => array('route' => 'Cliente.SingleView', 'params' => array('codigo' => 1)),
	'GET:api/clientes' => array('route' => 'Cliente.Query'),
	'POST:api/cliente' => array('route' => 'Cliente.Create'),
	'GET:api/cliente/(:num)' => array('route' => 'Cliente.Read', 'params' => array('codigo' => 2)),
	'PUT:api/cliente/(:num)' => array('route' => 'Cliente.Update', 'params' => array('codigo' => 2)),
	'DELETE:api/cliente/(:num)' => array('route' => 'Cliente.Delete', 'params' => array('codigo' => 2)),
		
	// Imoveisb
	'GET:imoveisbs' => array('route' => 'Imoveisb.ListView'),
	'GET:imoveisb/(:num)' => array('route' => 'Imoveisb.SingleView', 'params' => array('id' => 1)),
	'GET:api/imoveisbs' => array('route' => 'Imoveisb.Query'),
	'POST:api/imoveisb' => array('route' => 'Imoveisb.Create'),
	'GET:api/imoveisb/(:num)' => array('route' => 'Imoveisb.Read', 'params' => array('id' => 2)),
	'PUT:api/imoveisb/(:num)' => array('route' => 'Imoveisb.Update', 'params' => array('id' => 2)),
	'DELETE:api/imoveisb/(:num)' => array('route' => 'Imoveisb.Delete', 'params' => array('id' => 2)),
		
	// Language
	'GET:languages' => array('route' => 'Language.ListView'),
	'GET:language/(:num)' => array('route' => 'Language.SingleView', 'params' => array('id' => 1)),
	'GET:api/languages' => array('route' => 'Language.Query'),
	'POST:api/language' => array('route' => 'Language.Create'),
	'GET:api/language/(:num)' => array('route' => 'Language.Read', 'params' => array('id' => 2)),
	'PUT:api/language/(:num)' => array('route' => 'Language.Update', 'params' => array('id' => 2)),
	'DELETE:api/language/(:num)' => array('route' => 'Language.Delete', 'params' => array('id' => 2)),
		
	// LanguageContent
	'GET:languagecontents' => array('route' => 'LanguageContent.ListView'),
	'GET:languagecontent/(:num)' => array('route' => 'LanguageContent.SingleView', 'params' => array('id' => 1)),
	'GET:api/languagecontents' => array('route' => 'LanguageContent.Query'),
	'POST:api/languagecontent' => array('route' => 'LanguageContent.Create'),
	'GET:api/languagecontent/(:num)' => array('route' => 'LanguageContent.Read', 'params' => array('id' => 2)),
	'PUT:api/languagecontent/(:num)' => array('route' => 'LanguageContent.Update', 'params' => array('id' => 2)),
	'DELETE:api/languagecontent/(:num)' => array('route' => 'LanguageContent.Delete', 'params' => array('id' => 2)),
		
	// LanguageKey
	'GET:languagekeies' => array('route' => 'LanguageKey.ListView'),
	'GET:languagekey/(:num)' => array('route' => 'LanguageKey.SingleView', 'params' => array('id' => 1)),
	'GET:api/languagekeies' => array('route' => 'LanguageKey.Query'),
	'POST:api/languagekey' => array('route' => 'LanguageKey.Create'),
	'GET:api/languagekey/(:num)' => array('route' => 'LanguageKey.Read', 'params' => array('id' => 2)),
	'PUT:api/languagekey/(:num)' => array('route' => 'LanguageKey.Update', 'params' => array('id' => 2)),
	'DELETE:api/languagekey/(:num)' => array('route' => 'LanguageKey.Delete', 'params' => array('id' => 2)),
		
	// Plugin
	'GET:plugins' => array('route' => 'Plugin.ListView'),
	'GET:plugin/(:num)' => array('route' => 'Plugin.SingleView', 'params' => array('id' => 1)),
	'GET:api/plugins' => array('route' => 'Plugin.Query'),
	'POST:api/plugin' => array('route' => 'Plugin.Create'),
	'GET:api/plugin/(:num)' => array('route' => 'Plugin.Read', 'params' => array('id' => 2)),
	'PUT:api/plugin/(:num)' => array('route' => 'Plugin.Update', 'params' => array('id' => 2)),
	'DELETE:api/plugin/(:num)' => array('route' => 'Plugin.Delete', 'params' => array('id' => 2)),
		
	// Sessions
	'GET:sessionses' => array('route' => 'Sessions.ListView'),
	'GET:sessions/(:any)' => array('route' => 'Sessions.SingleView', 'params' => array('id' => 1)),
	'GET:api/sessionses' => array('route' => 'Sessions.Query'),
	'POST:api/sessions' => array('route' => 'Sessions.Create'),
	'GET:api/sessions/(:any)' => array('route' => 'Sessions.Read', 'params' => array('id' => 2)),
	'PUT:api/sessions/(:any)' => array('route' => 'Sessions.Update', 'params' => array('id' => 2)),
	'DELETE:api/sessions/(:any)' => array('route' => 'Sessions.Delete', 'params' => array('id' => 2)),
		
	// Shorturl
	'GET:shorturls' => array('route' => 'Shorturl.ListView'),
	'GET:shorturl/(:num)' => array('route' => 'Shorturl.SingleView', 'params' => array('id' => 1)),
	'GET:api/shorturls' => array('route' => 'Shorturl.Query'),
	'POST:api/shorturl' => array('route' => 'Shorturl.Create'),
	'GET:api/shorturl/(:num)' => array('route' => 'Shorturl.Read', 'params' => array('id' => 2)),
	'PUT:api/shorturl/(:num)' => array('route' => 'Shorturl.Update', 'params' => array('id' => 2)),
	'DELETE:api/shorturl/(:num)' => array('route' => 'Shorturl.Delete', 'params' => array('id' => 2)),
		
	// ShorturlFolder
	'GET:shorturlfolders' => array('route' => 'ShorturlFolder.ListView'),
	'GET:shorturlfolder/(:num)' => array('route' => 'ShorturlFolder.SingleView', 'params' => array('id' => 1)),
	'GET:api/shorturlfolders' => array('route' => 'ShorturlFolder.Query'),
	'POST:api/shorturlfolder' => array('route' => 'ShorturlFolder.Create'),
	'GET:api/shorturlfolder/(:num)' => array('route' => 'ShorturlFolder.Read', 'params' => array('id' => 2)),
	'PUT:api/shorturlfolder/(:num)' => array('route' => 'ShorturlFolder.Update', 'params' => array('id' => 2)),
	'DELETE:api/shorturlfolder/(:num)' => array('route' => 'ShorturlFolder.Delete', 'params' => array('id' => 2)),
		
	// SiteConfig
	'GET:siteconfigs' => array('route' => 'SiteConfig.ListView'),
	'GET:siteconfig/(:num)' => array('route' => 'SiteConfig.SingleView', 'params' => array('id' => 1)),
	'GET:api/siteconfigs' => array('route' => 'SiteConfig.Query'),
	'POST:api/siteconfig' => array('route' => 'SiteConfig.Create'),
	'GET:api/siteconfig/(:num)' => array('route' => 'SiteConfig.Read', 'params' => array('id' => 2)),
	'PUT:api/siteconfig/(:num)' => array('route' => 'SiteConfig.Update', 'params' => array('id' => 2)),
	'DELETE:api/siteconfig/(:num)' => array('route' => 'SiteConfig.Delete', 'params' => array('id' => 2)),
		
	// Stats
	'GET:statses' => array('route' => 'Stats.ListView'),
	'GET:stats/(:num)' => array('route' => 'Stats.SingleView', 'params' => array('id' => 1)),
	'GET:api/statses' => array('route' => 'Stats.Query'),
	'POST:api/stats' => array('route' => 'Stats.Create'),
	'GET:api/stats/(:num)' => array('route' => 'Stats.Read', 'params' => array('id' => 2)),
	'PUT:api/stats/(:num)' => array('route' => 'Stats.Update', 'params' => array('id' => 2)),
	'DELETE:api/stats/(:num)' => array('route' => 'Stats.Delete', 'params' => array('id' => 2)),
		
	// Tarefa
	'GET:tarefas' => array('route' => 'Tarefa.ListView'),
	'GET:tarefa/(:num)' => array('route' => 'Tarefa.SingleView', 'params' => array('codigo' => 1)),
	'GET:api/tarefas' => array('route' => 'Tarefa.Query'),
	'POST:api/tarefa' => array('route' => 'Tarefa.Create'),
	'GET:api/tarefa/(:num)' => array('route' => 'Tarefa.Read', 'params' => array('codigo' => 2)),
	'PUT:api/tarefa/(:num)' => array('route' => 'Tarefa.Update', 'params' => array('codigo' => 2)),
	'DELETE:api/tarefa/(:num)' => array('route' => 'Tarefa.Delete', 'params' => array('codigo' => 2)),
		
	// UrlDomain
	'GET:urldomains' => array('route' => 'UrlDomain.ListView'),
	'GET:urldomain/(:num)' => array('route' => 'UrlDomain.SingleView', 'params' => array('id' => 1)),
	'GET:api/urldomains' => array('route' => 'UrlDomain.Query'),
	'POST:api/urldomain' => array('route' => 'UrlDomain.Create'),
	'GET:api/urldomain/(:num)' => array('route' => 'UrlDomain.Read', 'params' => array('id' => 2)),
	'PUT:api/urldomain/(:num)' => array('route' => 'UrlDomain.Update', 'params' => array('id' => 2)),
	'DELETE:api/urldomain/(:num)' => array('route' => 'UrlDomain.Delete', 'params' => array('id' => 2)),
		
	// Users
	'GET:userses' => array('route' => 'Users.ListView'),
	'GET:users/(:num)' => array('route' => 'Users.SingleView', 'params' => array('id' => 1)),
	'GET:api/userses' => array('route' => 'Users.Query'),
	'POST:api/users' => array('route' => 'Users.Create'),
	'GET:api/users/(:num)' => array('route' => 'Users.Read', 'params' => array('id' => 2)),
	'PUT:api/users/(:num)' => array('route' => 'Users.Update', 'params' => array('id' => 2)),
	'DELETE:api/users/(:num)' => array('route' => 'Users.Delete', 'params' => array('id' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
?>