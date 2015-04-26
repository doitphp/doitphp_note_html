<?php
/**
 * 项目主配置文件
 *
 * @author tommy <streen003@gmail.com>
 * @link http://www.doitphp.com
 * @copyright Copyright (C) Copyright (c) 2012 www.doitphp.com All rights reserved.
 * @license New BSD License.{@link http://www.opensource.org/licenses/bsd-license.php}
 * @version $Id: application.php 1.0 2013-01-11 21:53:32Z tommy <streen003@gmail.com> $
 * @package config
 * @since 1.0
 */

if (!defined('IN_DOIT')) {
    exit();
}

/**
 * 设置时区，默认时区为东八区(中国)时区(Asia/ShangHai)。
 */
//$config['application']['defaultTimeZone'] = 'Asia/ShangHai';

/**
 * 设置URL网址的格式。
 *  Configure::GET_FORMAT为：index.php?router=controller/action&params=value;
 *  Configure::PATH_FORMAT为:index.php/controller/action/params/value。
 * 默认为：Configure::PATH_FORMAT
 */
//$config['application']['urlFormat'] = Configure::GET_FORMAT;

/**
 * 设置是否开启URL路由网址重写(Rewrite)功能。true:开启；false:关闭。默认：关闭。
 */
//$config['application']['rewrite'] = true;

/**
 * 设置是否开启Debug调用功能。true:开启；false:关闭。默认：关闭。
 */
//$config['application']['debug'] = true;

/**
 * 设置是否开启日志记录功能。true:开启；false:关闭。默认：关闭。
 */
//$config['application']['log'] = true;

/**
 * 自定义项目(application)目录路径的设置。注：结尾无需"/"，建议用绝对路径。
 */
//$config['application']['basePath'] = APP_ROOT . '/application';

/**
 * 自定义缓存(cache)目录路径的设置。注：结尾无需"/"，建议用绝对路径。
 */
//$config['application']['cachePath'] = APP_ROOT . '/cache';

/**
 * 自定义日志(log)目录路径的设置。注：结尾无需"/"，建议用绝对路径。
 */
//$config['application']['logPath'] = APP_ROOT . '/logs';

/**
 * 设置视图文件的格式。Configure::VIEW_EXT_HTML为html;Configure::VIEW_EXT_PHP为php。默认为：php。
 */
$config['application']['viewExt'] = Configure::VIEW_EXT_HTML;

//数据库连接参数
$config['db'] = array(
	'dsn' => 'mysql:host=localhost;dbname=doitphpnote',
	'username' => 'root',
	'password' => '',
);

//管理员帐号及密码设置
$config['admin'] = array(
	'username' => 'doitphp',
	'password' => '123456',
);

//分页设置
$config['pagination'] = array(
	//每页显示的留言条数, 默认每页显示10条留言
	'perListNum'=>10,
);