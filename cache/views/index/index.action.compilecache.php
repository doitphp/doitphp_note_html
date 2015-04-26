<?php if(!defined('IN_DOIT')) exit(); ?>
<!-- post content -->
<fieldset>
<legend>留言内容：</legend>
<input type="hidden" name="removePostUrl" id="removePostUrl" value="<?php echo $this->createUrl('post/ajax_delete_post'); ?>">
<?php if ($postList == true) { ?>
<?php if (is_array($postList)) { foreach ($postList as $lines) { ?>
<table border="0" cellpadding="0" cellspacing="0" class="border">
  <tbody>
    <tr>
      <td width="60" height="30" align="left" bgcolor="#F5F5F5">ID: <?php echo $lines['post_id']; ?>
      </td>
      <td width="180" align="left" bgcolor="#F5F5F5">留言者：<?php echo $lines['post_author']; ?></td>
      <td align="center" bgcolor="#F5F5F5">&nbsp;</td>
      <td width="210" colspan="3" align="right" bgcolor="#F5F5F5">时间：<?php echo $lines['post_time']; ?></td>
      </tr>
    <tr>
      <td colspan="6" align="left" valign="top">
        <div style="line-height:30px;">标题：<?php echo $lines['post_title']; ?><br>留言内容：<?php echo $lines['post_content']; ?></div>
        <?php if ($lines['reply_content'] == ture) { ?>
        <div class="blue">管理员回复：<?php echo $lines['reply_content']; ?> --[ <?php echo $lines['reply_time']; ?>} ]</div>
        <?php } ?>
        <?php if ($loginStatus == true) { ?>
        <div class="text-align-right">[ <a href="<?php echo $this->createUrl('post/edit', array('id'=>$lines['post_id'], 'page'=>$page)); ?>">编辑</a> ] [ <a href="javascript:void(0);" onClick="removePost('<?php echo $lines['post_id']; ?>');">删除</a> ] [ <a href="<?php echo $this->createUrl('post/reply', array('id'=>$lines['post_id'], 'page'=>$page)); ?>">回复</a> ]</div>
        <?php } ?>
      </td>
      </tr>
  </tbody>
</table>
<?php } } ?>
<?php } else { ?>
<table border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="60" align="center" bgcolor="#FFFFFF">暂时没有要显示的留言内容！</td>
      </tr>
  </tbody>
</table>
<?php } ?>
<?php echo $paginationHtml; ?>
</fieldset>
<!-- /post content -->