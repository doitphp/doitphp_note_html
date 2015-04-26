//管理员登陆表单验证
function loginRequest(){
	var user = $('#user_name').val();
	var pw = $('#user_password').val();
	var code = $('#vd_code').val();
	if(user==''){
		$('#user_name').css('border', '1px solid #D54E21');
		alert('请填写管理员帐号!');
		$('#user_name').focus();
		return false;
	}
	if(pw==''){
		$('#user_password').css('border', '1px solid #D54E21');
		alert('密码不能为空!');
		$('#user_password').focus();
		return false;
	}
	if(code == ''){
		$('#vd_code').css('border', '1px solid #D54E21');
		alert('验证码不能为空!');
		$('#vd_code').focus();
		return false;
	}
	return true;
}
//发表留言表单验证
function addpostRequest(){
	var user = $('#username').val();
	var title = $('#title').val();
	var content = $('#content').val();
	if(user==''){
		$('#username').css('border', '1px solid #D54E21');
		alert('请填写用户名!');
		$('#username').focus();
		return false;
	}
	if(title==''){
		$('#title').css('border', '1px solid #D54E21');
		alert('留言标题不能为空!');
		$('#title').focus();
		return false;
	}
	if(content == ''){
		$('#content').css('border', '1px solid #D54E21');
		alert('留言内容不能为空!');
		$('#content').focus();
		return false;
	}
	return true;
}
//编辑留言表单验证
function editpostRequest(){
	var title = $('#title').val();
	var content = $('#content').val();
	if(title==''){
		$('#title').css('border', '1px solid #D54E21');
		alert('留言标题不能为空!');
		$('#title').focus();
		return false;
	}
	if(content == ''){
		$('#content').css('border', '1px solid #D54E21');
		alert('留言内容不能为空!');
		$('#content').focus();
		return false;
	}
	return true;
}
//回复留言表单验证
function replypostRequest(){
	var content = $('#content').val();
	if(content == ''){
		$('#content').css('border', '1px solid #D54E21');
		alert('回复内容不能为空!');
		$('#content').focus();
		return false;
	}
	return true;
}
//处理ajax返回数据
function showResponse(json){
	if(json.status==true){
		//当有信息提示时
		if(json.msg!='') {
			alert(json.msg);
		}
		//当有网址跳转或页面刷新时
		if(json.data.target!=''){
			if(json.data.target=='refresh'){
				location.reload();
			} else {
				location.href=json.data.target;
			}
		}
	} else {
		if(json.msg!='') {
			alert(json.msg);
		}
	}

	return true;
}
//删除留言
function removePost(postId){
	if(!confirm('您确认要删除该留言？')){
		return false;
	}
	apiUrl = $('#removePostUrl').val();
	$.post(apiUrl, {id:postId}, showResponse, 'json');
}