<?php
/**
 * 挂件：管理员登陆与注销
 *
 * @author tommy
 * @copyright Copyright (C) www.doitphp.com 2015 All rights reserved.
 * @version $Id: loginStatus 1.0 2015-04-26 06:56:12Z tommy $
 * @package Widget
 * @since 1.0
 */

class loginStatusWidget extends Widget {

	/**
	 * main method
	 *
	 * @access public
	 *
	 * @param array $params 参数
	 *
	 * @return void
	 */
	public function renderContent($params = null) {

		//get admin login status
		$loginInfo = $this->getCookie('adminLoginInfo');
		if (isset($loginInfo['status']) && $loginInfo['status']) {
			$message = '欢迎：' . $loginInfo['username'] . ' ' . Html::link('退出', $this->createUrl('index/logout'));
		} else {
			$message = Html::link('管理员登录', $this->createUrl('index/login'));
		}

		echo $message;
	}

}