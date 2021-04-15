<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
<style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url() ?>user/index">Home</a></li>
        <li><a href="<?php echo base_url() ?>books">Books</a></li>
        <li><a href="<?php echo base_url() ?>authors/index">Authors</a></li>
        <li><a href="<?php echo base_url() ?>user/logout">Logout</a></li>
      </ul>
     
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Welcome</h1>      
    <p><?php echo $this->session->userdata('username'); ?></p>
  </div>
</div>
  


<br><br>
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