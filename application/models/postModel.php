<?php
/**
 * 留言内容管理
 *
 * @author tommy
 * @copyright Copyright (C) www.doitphp.com 2015 All rights reserved.
 * @version $Id: postModel.php 1.0 2015-04-26 06:44:56Z tommy $
 * @package Model
 * @since 1.0
 */

class postModel extends Model {

	/**
	 * 发表留言
	 *
	 * @access public
	 *
	 * @param string $postTitle 留言标题
	 * @param string $postAuthor 留言者的用户名
	 * @param string $postContent 留言内容
	 *
	 * @return boolean
	 */
	public function addPost($postTitle, $postAuthor, $postContent) {

		//参数分析
		if (!$postTitle || !$postAuthor || !$postContent) {
			$this->setErrorInfo('错误的参数调用');
			return false;
		}

		//写入数据, 区区一个发表留言操作，也无数据排重要求
		$insertArray = array(
		'post_title'   => $postTitle,
		'post_author'  => $postAuthor,
		'post_content' => $postContent,
		'post_time'    => date('Y-m-d H:i:s'),
		);

		return $this->insert($insertArray);
	}

	/**
	 * 编辑留言内容
	 *
	 * @access public
	 *
	 * @param integer $postId 留言ID
	 * @param string $postTitle 留言标题
	 * @param string $postContent 留言内容
	 *
	 * @return boolean
	 */
	public function editPost($postId, $postTitle, $postContent) {

		//参数分析
		$postId = (int)$postId;
		if(!$postId || !$postTitle || !$postContent) {
			$this->setErrorInfo('错误的参数调用');
			return false;
		}

		//查询是否有该留言Id的数据
		$postInfo = $this->find($postId, array('post_id'));
		if (!$postInfo) {
			$this->setErrorInfo('对不起，所要编辑的留言ID不存在！');
			return false;
		}

		//更改数据
		$updateArray = array(
		'post_title'   => $postTitle,
		'post_content' => $postContent,
		);

		return $this->update($updateArray, 'post_id=?', $postId);
	}

	/**
	 * 编辑留言
	 *
	 * @access public
	 *
	 * @param integer $postId 留言Id
	 *
	 * @return boolean
	 */
	public function removePost($postId) {

		//参数分析
		$postId = (int)$postId;
		if(!$postId) {
			$this->setErrorInfo('错误的参数调用');
			return false;
		}

		return $this->delete('post_id=?', $postId);
	}

	/**
	 * 回复留言
	 *
	 * @access public
	 *
	 * @param integer $postId 留言ID
	 * @param string $replyContent 管理员回复内容
	 *
	 * @return boolean
	 */
	public function replyPost($postId, $replyContent) {

		//参数分析
		$postId = (int)$postId;
		if(!$postId || !$replyContent) {
			$this->setErrorInfo('错误的参数调用');
			return false;
		}

		//查询是否有该留言Id的数据
		$postInfo = $this->find($postId, array('post_id'));
		if (!$postInfo) {
			$this->setErrorInfo('对不起，所要编辑的留言ID不存在！');
			return false;
		}

		//更改数据
		$updateArray = array(
		'reply_content' => $replyContent,
		'reply_time'    => date('Y-m-d H:i:s'),
		);

		return $this->update($updateArray, 'post_id=?', $postId);
	}

	/**
	 * 根据留言ID获取留言内容
	 *
	 * @access public
	 *
	 * @param integer $postId 留言ID
	 *
	 * @return array
	 */
	public function getPostInfo($postId) {

		//参数分析
		$postId = (int)$postId;
		if(!$postId) {
			$this->setErrorInfo('错误的参数调用');
			return false;
		}

		return $this->find($postId);
	}

	/**
	 * 获取留言列表
	 *
	 * @access public
	 *
	 * @param string $orderDesc 列表排序条件
	 * @param integer $page 当前页数
	 * @param integer $listNum 每页显示的留言的数目
	 *
	 * @return array
	 */
	public function getPostList($orderDesc = 'post_id DESC', $page = 1, $listNum = 10) {

		$listArray =$this->order($orderDesc)->pageLimit($page, $listNum)->getAll();

		return (!$listArray) ? array() : $listArray;
	}

	/**
	 * 获取留言总数目
	 *
	 * @access public
	 * @return integer
	 */
	public function getPostNums() {

		return $this->count('post_id');
	}

	/**
	 * 定义数据表主键
	 *
	 * @access protected
	 * @return array
	 */
	protected function primaryKey() {
		return 'post_id';
	}

	/**
	 * 定义数据表字段信息
	 *
	 * @access protected
	 * @return array
	 */
	protected function tableFields() {
		return array (
  0 => 'post_id',
  1 => 'post_title',
  2 => 'post_author',
  3 => 'post_content',
  4 => 'post_time',
  5 => 'reply_content',
  6 => 'reply_time',
);
	}

	/**
	 * 定义数据表名称
	 *
	 * @access protected
	 * @return array
	 */
	protected function tableName() {
		return 'posts';
	}

}