#DoitPHP NOTE V2.3 (视图格式:HTML)

     这是用DoitPHP V2.3开发的一个简单的留言本程序。
作为DoitPHP V2.3的演示实例，一花一世界，一叶一菩提。麻雀虽小，五脏俱全。功能虽少，用于演示足矣。

注：DoitPHP NOTE V2.3 有两个版本: 
  一个是视图文件格式为PHP的，一个是视图文件格式为HTML的。

运行要求：
1、PHP5.2.0以上版本支持
2、SPL PHP扩展支持
3、Mysql Pdo扩展支持


一、安装
1、新建数据库，将根目录下 db.sql文件导入数据库。
2、更改数据库连接参数
具体如下：

配置文件：application/config/application.php 第66行

//数据库连接参数
$config['db'] = array(
	'dsn' => 'mysql:host=localhost;dbname=doitphpnote',
	'username' => 'root',
	'password' => '',
);

对于上面这部分内容如何改，就不用我再废话了吧？

二、管理员帐户及密码
默认设置 管理员：doitphp 密码： 123456
具体在项目的主配置文件上面有设置，可自行更改。