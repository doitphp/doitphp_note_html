<?php
/**
 * 管理留言内容--编辑，回复和删除
 *
 * @author tommy
 * @copyright Copyright (C) www.doitphp.com 2015 All rights reserved.
 * @version $Id: PostController.php 1.0 2015-04-26 06:53:56Z tommy $
 * @package Controller
 * @since 1.0
 */

class PostController extends Controller {

	/**
	 * postModel实例化对象
	 *
	 * @var object
	 */
	protected $_postModel = null;

	/**
	 * 编辑留言
	 *
	 * @access public
	 * @return void
	 */
	public function editAction() {

		//获取参数
		$postId = (int)$this->get('id');
		if (!$postId) {
			$this->showMsg('错误的网址调用');
		}
		$page = (int)$this->get('page', 1);

		//获取留言信息
		$postInfo  = $this->_postModel->getPostInfo($postId);

		//分析ajax调用的JS代码
		$javaScript = Script::ajaxFormSubmit('#editpost_form', 'editpostRequest', 'showResponse', 'json');

		//assign params
		$this->assign(array(
		'postInfo'     => $postInfo,
		'postListUrl'  => $this->createUrl('index/index', array('page'=>$page)),
		'javaScript'   => $javaScript,
		));

		//display page
		$this->display();
	}

	/**
	 * Ajax调用页：编辑留言
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_editAction() {

		//获取参数
		$postId  = (int)$this->post('id');
		$title   = $this->post('title');
		$content = $this->post('content');
		if (!$postId || !$title || !$content) {
			$this->ajax(false, '错误的参数调用');
		}

		if (!$this->_postModel->editPost($postId, $title, $content)) {
			$errorMsg = $this->_postModel->getErrorInfo();
			$errorMsg = (!$errorMsg) ? '对不起，操作失败！请重新操作' : $errorMsg;

			$this->ajax(false, $errorMsg);
		}

		$this->ajax(true, '操作成功！', array('target'=>'refresh'));
	}

	/**
	 * Ajax调用页：删除留言
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_delete_postAction() {

		//获取参数
		$postId = (int)$this->post('id');
		if (!$postId) {
			$this->ajax(false, '错误的参数调用');
		}

		if (!$this->_postModel->removePost($postId)) {
			$errorMsg = $this->_postModel->getErrorInfo();
			$errorMsg = (!$errorMsg) ? '对不起，操作失败！' : $errorMsg;

			$this->ajax(false, $errorMsg);
		}

		$this->ajax(true, '操作成功！', array('target'=>'refresh'));
	}

	/**
	 * 回复留言
	 *
	 * @access public
	 * @return void
	 */
	public function replyAction() {

		//获取参数
		$postId = (int)$this->get('id');
		if (!$postId) {
			$this->showMsg('错误的网址调用');
		}
		$page = (int)$this->get('page', 1);

		//获取该留言的内容
		$postInfo  = $this->_postModel->getPostInfo($postId);

		//分析ajax调用的JS代码
		$javaScript = Script::ajaxFormSubmit('#relypost_form', 'replypostRequest', 'showResponse', 'json');

		//assign params
		$this->assign(array(
		'postInfo'    => $postInfo,
		'postListUrl' => $this->createUrl('index/index', array('page'=>$page)),
		'javaScript'  => $javaScript,
		));

		//display page
		$this->display();
	}

	/**
	 * Ajax调用页：回复留言
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_replyAction() {

		//获取参数
		$postId  = (int)$this->post('id');
		$content = $this->post('content');
		if (!$postId || !$content) {
			$this->ajax(false, '错误的参数调用');
		}

		if(!$this->_postModel->replyPost($postId, $content)) {
			$errorMsg = $this->_postModel->getErrorInfo();
			$errorMsg = (!$errorMsg) ? '对不起，操作失败！请重新操作' : $errorMsg;

			$this->ajax(false, $errorMsg);
		}

		$this->ajax(true, '操作成功！', array('target'=>'refresh'));
	}

	/**
	 * 前函数(完成判断管理员是否登陆等操作)
	 *
	 * @access protected
	 * @return void
	 */
	protected function init() {

		$actionName = Doit::getActionName();

		//判断管理员是否登陆
		$loginInfo = $this->getCookie('adminLoginInfo');
		if (!isset($loginInfo['status']) || !$loginInfo['status']) {
			$loginUrl = $this->createUrl('index/login');
			//为了便于管理， ajax所调用的页面Action名称统一使用：'ajax_'作为前缀。
			if (substr($actionName, 0, 5) == 'ajax_') {
				$this->ajax(false, '对不起，您未登录或登陆已超时！请进行登陆操作', array('target'=>$loginUrl));
			}
			//跳转至登陆页
			$this->redirect($loginUrl);
		}

		//重新种一下登陆cookie, 免得管理员一直在操作，版刻后出现登陆超时的现象
		$this->setCookie('adminLoginInfo', $loginInfo);

		//postModel实例化
		$this->_postModel = $this->model('post');

		//set layout template
		$this->setLayout('main');

		//对模板标签进行赋值
		$this->assign('assetUrl', $this->getAssetUrl());

		//分析并设置视图文件中的页面标题(title)
		$titleArray = array(
		'edit'   => '编辑留言',
		'reply'  => '回复留言',
		);
		$title = isset($titleArray[$actionName]) ? $titleArray[$actionName] : 'DoitPHPNote';

		$this->assign('title', $title);
	}

}