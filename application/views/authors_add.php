<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src='<?php echo base_url(); ?>assets/jquery.min.js'></script>
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
        <li ><a href="<?php echo base_url() ?>user/index">Home</a></li>
        <li><a href="<?php echo base_url() ?>books">Books</a></li>
        <li class="active"><a href="<?php echo base_url() ?>authors/index">Authors</a></li>
        <li><a href="<?php echo base_url() ?>user/logout">Logout</a></li>
      </ul>
     
    </div>
  </div>
</nav>

<br>
<br>
<br>
<div class="container">
<h2>Add Authors</h2>
  <div class="row">
  <div class="col-12 col-md-8">
  <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" class="form-control" id="nama_authors" placeholder="nama">
	<small id="nama_authors_" style="color:red" class="form-text"></small>
  </div>
  <div class="form-group">
    <label for="telepon">Telepon</label>
    <input type="text" class="form-control" id="telepon" placeholder="telepon">
	<small id="telepon_" style="color:red" class="form-text"></small>
  </div>
 

  <input type="submit" id="submit" class="button" value="Submit">
</div>

</div>
</div>
  


<br><br>
</body>
<footer>
<script type="text/javascript">
$(document).ready(function () {
	$("#submit").click(function () {
		// alert();
       var nama_authors     = $("#nama_authors").val();
       var telepon     = $("#telepon").val();
		$('#nama_authors_').html("");
		$('#telepon_').html("");
		if(nama_authors == ''){
			$('#nama_authors_').html("nama_authors harus diisi");
		}else if(telepon == ''){
			$('#telepon_').html("telepon harus diisi");
		
		} else{
				
			
			$.ajax({
				url:"<?php echo base_url();?>authors/add_api",
				type:"POST",
				data: {nama_authors: nama_authors, telepon: telepon},
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
						alert("authors berhasil dibuat");     
						window.location = "<?php echo base_url();?>authors/index";

					}		
					
				}
			});
		}
   });
   
  
   
   
});
	   
</script>
</footer>
</html>