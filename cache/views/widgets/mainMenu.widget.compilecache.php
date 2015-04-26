<?php if(!defined('IN_DOIT')) exit(); ?>
<div class="nav">
    <ul>
<?php if ($controller == 'index' && $action == 'index') { ?>
        <li class="current">首页</li>
<?php } else { ?>
        <li><a href="<?php echo $this->createUrl('index/index'); ?>">首页</a></li>
<?php } ?>
<?php if ($controller == 'index' && $action == 'add') { ?>
        <li class="current">发表留言</li>
<?php } else { ?>
        <li><a href="<?php echo $this->createUrl('index/add'); ?>">发表留言</a></li>
<?php } ?>
<?php if ($controller == 'post' && $action == 'reply') { ?>
        <li class="current">回复留言</li>
<?php } ?>
<?php if ($controller == 'post' && $action == 'edit') { ?>
        <li class="current">编辑留言</li>
<?php } ?>
<?php if ($controller == 'index' && $action == 'login') { ?>
        <li class="current">管理员登陆</li>
<?php } ?>
    </ul>
</div>