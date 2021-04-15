<html>
<head>
<link rel="stylesheet" href='<?php echo base_url(); ?>assets/bootstrap.min.css'>
<script src='<?php echo base_url(); ?>assets/bootstrap.bundle.min.js'></script>
<script src='<?php echo base_url(); ?>assets/jquery.min.js'></script>
<link rel="stylesheet" href='<?php echo base_url(); ?>assets/style.css'>

</head>

<body>
<div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box">
                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-space">
                        <div class="login">
                            <div class="group"> <label for="user" class="label">Username</label> <input id="user_l" type="text" class="input" placeholder="Enter your username">
							<small id="user_l_" style="color:red" class="form-text"></small>
							</div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass_l" type="password" class="input" data-type="password" placeholder="Enter your password">
							<small id="pass_l_" style="color:red" class="form-text"></small>
							</div>
                            
                            <div class="group"> <input type="submit" id="submit_login" class="button" value="Sign In"> </div>
                            <div class="hr"></div>
                           
                        </div>
                        <div class="sign-up-form">
                            <div class="group"> <label for="user" class="label">Username</label> <input id="username" type="text" class="input" placeholder="Create your Username">
							<small id="username_" style="color:red" class="form-text"></small>
							</div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="password" type="password" class="input" data-type="password" placeholder="Create your password">
							<small id="pass_" style="color:red" class="form-text"></small>
							</div>
                            <div class="group"> <label for="pass" class="label">Repeat Password</label> <input id="repass" type="password" class="input" data-type="password" placeholder="Repeat your password">
							<small id="repass_" style="color:red" class="form-text"></small>
							</div>
                            <div class="group"> <label for="pass" class="label">Role</label> 
								<select name="role" class="form-control" id="role">
								<option value="admin">Admin</option>
								<option value="user">User</option>
								
								</select>
								<small id="role_" style="color:red" class="form-text"></small>
							</div>
                            <div class="group"> <input type="submit" id="submit_regist" class="button" value="Sign Up"> </div>
                            <div class="hr"></div>
                            <div class="foot"> <label for="tab-1">Already Member?</label> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer>
<script type="text/javascript">
$(document).ready(function () {
	$("#submit_login").click(function () {
		// alert();
       var username     = $("#user_l").val();
       var password     = $("#pass_l").val();
       
		$('#user_l_').html("");
		$('#pass_l_').html("");
		if(username == ''){
			status = '1';
			$('#user_l_').html("Username harus diisi");
		}else if(password == ''){
			$('#pass_l_').html("password harus diisi");
			status = '1';
		
		} else{
				
			
			$.ajax({
				url:"<?php echo base_url();?>user/login",
				type:"POST",
				data: {username: username, password: password},
				dataType:"text",
				cache:false,
				success:function(data)
				{
					var obj = JSON.parse(data); 
					// alert(obj.messages);
					if(obj.messages!=true)
					{
						alert(obj.data);
					}else{
						alert("login berhasil");     
						window.location = "<?php echo base_url();?>user/index";

					}		
					
				}
			});
		}
   });
   
   
   $("#submit_regist").click(function () {
		// alert();
       var username     = $("#username").val();
       var password     = $("#password").val();
       var repass    	= $("#repass").val();
       var role  		= $("#role").val();
       
		$('#username_').html("");
		$('#password_').html("");
		$('#repass_').html("");
		$('#role_').html("");
		if(username == ''){
			status = '1';
			$('#username_').html("Username harus diisi");
		}else if(password == ''){
			$('#password_').html("password harus diisi");
			status = '1';
		}else if(repass !=  password){
			status = '1';
			$('#repass_').html("re password harus sama dengan password");
		}else if(role == ''){
			$('#role_').html("role harus diisi");
			status = '1';
		} else{
				
			
			$.ajax({
				url:"<?php echo base_url();?>user/regist",
				type:"POST",
				data: {username: username, password: password, role:role},
				dataType:"text",
				cache:false,
				success:function(data)
				{
					var obj = JSON.parse(data); 
					// alert(obj.messages);
					if(obj.messages!=true)
					{
						alert('terjadi kesalahan');
					}else{
						alert("registrasi berhasil, silahkan login");  
						$("#username").val("")
						$("#password").val("")
						$("#repass").val("")

					}					
					
				}
			});
		}
   });
   
   
});
	   
</script>
</footer>
</html>