<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Neotv 直播后台</title>

<?php echo  YHtml::cssFile(YHtml::cssUrl('backend/login.css')) ?>

</head>
<body> 
    <div id="login-holder">
        
        <div id="login-info">
            <?php echo  CHtml::beginForm() ?>
            
		<table border="0" cellpadding="0" cellspacing="0" id="login-table">
		<tr>
			<th>用户名:</th>
			<td><input type="text" name="LoginForm[username]"  class="login-inp"/></td>
		</tr>
		<tr>
                    <th>密&nbsp;&nbsp;码:</th>
			<td><input type="password" value="" name="LoginForm[password]"  class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top">
                            <input type="hidden" value="0" name="LoginForm[rememberMe]">
                            <input type="checkbox" name ="LoginForm[rememberMe]" class="checkbox-size" value="1" id="login-check" />
                            <label for="login-check">记住我的登陆信息</label>
                        </td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" class="submit-login"  value="" /></td>
		</tr>
		</table>
            </form>
        </div>
        <div id="login-bottom">
        </div>
       
    </div>
    
    
    
</body>
</html>