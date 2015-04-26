<?php
/**
 * 留言列表页及管理员登陆相关
 *
 * @author tommy
 * @copyright Copyright (C) www.doitphp.com 2015 All rights reserved.
 * @version $Id: IndexController.php 1.0 2015-04-26 06:49:25Z tommy $
 * @package Controller
 * @since 1.0
 */

class IndexController extends Controller {

	/**
	 * 验证码内容的session名
	 *
	 * @var string
	 */
	const CAPTCHA_SESSION_NAME = 'captcha_session_name';

	/**
	 * postModel实例化对象
	 *
	 * @var object
	 */
	protected $_postModel = null;

	/**
	 * 首页,即留言的列表页
	 *
	 * @access public
	 * @return void
	 */
	public function indexAction() {

		//获取参数
		$page = (int)$this->get('page', 1);

		//从项目主配置文件中获取所设置的 每页显示的留言列表数
		$perPageListNum = Configure::get('pagination.perListNum');

		//分页处理
		$totalNum    = $this->_postModel->getPostNums();
		$pageListObj = $this->instance('Pagination');

		//assign params
		$this->assign(array(
		'postList'       => $this->_postModel->getPostList('post_id Desc', $page, $perPageListNum),
		'loginStatus'    => $this->_parseLoginStatus(),
		'paginationCss'  => $pageListObj->loadCss('classic'),
		'paginationHtml' => $pageListObj->total($totalNum)->url($this->getSelfUrl() . '/page/')->page($page)->num($perPageListNum)->hide(true)->output(),
		'page'           => $page,
		));

		//display pages
		$this->display();
	}

	/**
	 * 管理员登陆页
	 *
	 * @access public
	 * @return void
	 */
	public function loginAction() {

		//当管理员登陆时，无须重复登陆，直接跳转到首页
		if ($this->_parseLoginStatus()) {
			$this->redirect($this->getActionUrl('index'));
		}

		//分析ajax调用的JS代码
		$javaScript = Script::ajaxFormSubmit('#login_form', 'loginRequest', 'showResponse', 'json');

		//assign params
		$this->assign('javaScript', $javaScript);

		//display page
		$this->display();
	}

	/**
	 * 管理员退出页
	 *
	 * @access public
	 * @return void
	 */
	public function logoutAction() {

		//cookie重值
		$this->setCookie('adminLoginInfo', array(), '-3600');

		//跳转至登陆页
		$this->redirect($this->getActionUrl('login'));
	}

	/**
	 * ajax调用：处理管理员登陆数据
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_loginAction() {

		//当管理员登陆时，无须处理
		if ($this->_parseLoginStatus()) {
			$this->ajax(true, '管理员已登陆, 无须重复登陆');
		}

		//获取参数及判断
		$pinCode  = $this->post('pincode');
		if (!$pinCode) {
			$this->ajax(false, '对不起，验证码不能为空!');
		}
		$pinCode  = strtolower($pinCode);

		$userName = $this->post('username');
		$password = $this->post('password');
		if (!$userName || !$password) {
			$this->ajax(false, '对不起，用户 名或密码不能为空！');
		}

		//分析验证验证码内容
		$sessionValue = Session::get(self::CAPTCHA_SESSION_NAME);
		if (!$sessionValue) {
			$this->ajax(false, '对不起，错误的网址调用！');
		}
		$sessionValue = strtolower($sessionValue);

		if ($pinCode != $sessionValue) {
			$this->ajax(false, '验证码不正确！请重新输入');
		}

		//从配置文件中获取管理员的用户名及密码
		$adminUserName = Configure::get('admin.username');
		$adminPassword = Configure::get('admin.password');

		if ($userName != $adminUserName || $password != $adminPassword) {
			$this->ajax(false, '对不起，管理员帐号或密码错误！请重新输入');
		}

		//设置cookie值
		$loginInfo = array('username'=>$userName, 'status'=>true);
		$this->setCookie('adminLoginInfo', $loginInfo);

		$this->ajax(true, '登陆成功！', array('target'=>$this->getActionUrl('index')));
	}

	/**
	 * 验证码内容显示
	 *
	 * @access public
	 * @return void
	 */
	public function captchaAction() {

		$this->instance('Captcha')->setSessionName(self::CAPTCHA_SESSION_NAME)->show();
	}

	/**
	 * 发表留言
	 *
	 * @access public
	 * @return void
	 */
	public function addAction() {

		//分析ajax调用的JS代码
		$javaScript = Script::ajaxFormSubmit('#addpost_form', 'addpostRequest', 'showResponse', 'json');

		//assign params
		$this->assign('javaScript', $javaScript);

		//display page
		$this->display();
	}

	/**
	 * Ajax调用页：发表留言
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_addpostAction() {

		//get params
		$title    = $this->post('title');
		$userName = $this->post('username');
		$content  = $this->post('content');

		if (!$title || !$userName || !$content) {
			$this->ajax(false, '对不起，错误的参数调用！');
		}

		if (!$this->_postModel->addPost($title, $userName, $content)) {
			$errorMsg = $this->_postModel->getErrorInfo();
			$errorMsg = (!$errorMsg) ? '对不起，操作失败！请重新操作' : $errorMsg;

			$this->ajax(false, $errorMsg);
		}

		$this->ajax(true, '操作成功！', array('target'=>$this->getActionUrl('index')));
	}

	/**
	 * 判断分析管理员登陆状态
	 *
	 * @access protected
	 * @return void
	 */
	protected function _parseLoginStatus() {

		$loginInfo = $this->getCookie('adminLoginInfo');

		$result = (isset($loginInfo['status']) && $loginInfo['status']) ? true : false;

		//重新种一下登陆cookie, 免得管理员一直在操作，版刻后出现登陆超时的现象
		if ($result) {
			$this->setCookie('adminLoginInfo', $loginInfo);
		}

		return $result;
	}

	/**
	 * 前函数(完成模板公共标签的赋值操作)
	 *
	 * @access protected
	 * @return void
	 */
	protected function init() {

		//set layout template
		$this->setLayout('main');

		//postModel实例化
		$this->_postModel = $this->model('post');

		//assign params
		$this->assign('assetUrl', $this->getAssetUrl());

		//分析并设置视图文件中的页面标题(title)
		$titleArray = array(
		'index' => 'DoitPHPNote V2.3',
		'login' => '管理员登陆',
		'add'   => '发表留言',
		);

		$actionName = Doit::getActionName();
		$title = isset($titleArray[$actionName]) ? $titleArray[$actionName] : 'DoitPHPNote';

		$this->assign('title', $title);
	}
}