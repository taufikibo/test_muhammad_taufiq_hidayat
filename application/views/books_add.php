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
        <li class="active"><a href="<?php echo base_url() ?>books">Books</a></li>
        <li ><a href="<?php echo base_url() ?>authors/index">Authors</a></li>
        <li><a href="<?php echo base_url() ?>user/logout">Logout</a></li>
      </ul>
     
    </div>
  </div>
</nav>

<br>
<br>
<br>
<div class="container">
<h2>Add books</h2>
  <div class="row">
  <div class="col-12 col-md-8">
  <div class="form-group">
    <label for="nama">Nama Books</label>
    <input type="text" class="form-control" id="nama_books" placeholder="nama">
	<small id="nama_books_" style="color:red" class="form-text"></small>
  </div>
  <div class="form-group">
    <label for="tahun">tahun</label>
    <input type="text" class="form-control" id="tahun" placeholder="tahun">
	<small id="tahun_" style="color:red" class="form-text"></small>
  </div>
 <div class="form-group">
    <label for="tahun">Authors</label>
   <div id="dynamic_div"></div>
  </div>
 

  <input type="submit" id="submit" class="button" value="Submit">
</div>

</div>
</div>
  


<br><br>
</body>
<footer>

<script type="text/javascript">

var arr = <?php echo json_encode($authors); ?>;

arr.forEach( function (obj)
{
    $('#dynamic_div').append('<input name="myCheckboxes[]" type="checkbox" value="'+obj.id+'"/> '+obj.nama_authors +'<br/>');
});
$(document).ready(function () {
	$("#submit").click(function () {
		// alert();
       var nama_books     = $("#nama_books").val();
       var tahun     = $("#tahun").val();
	   var myCheckboxes = new Array();
		var authors = "";
		$(":checkbox").each(function () {
			var ischecked = $(this).is(":checked");
			if (ischecked) {
				authors += $(this).val() + "|";
			}
		});
		// alert(authors);
		$('#nama_books_').html("");
		$('#tahun_').html("");
		if(nama_books == ''){
			$('#nama_books_').html("nama_books harus diisi");
		}else if(tahun == ''){
			$('#tahun_').html("tahun harus diisi");
		
		} else{
				
			
			$.ajax({
				url:"<?php echo base_url();?>books/add_api",
				type:"POST",
				data: {nama_books: nama_books, tahun: tahun, authors:authors},
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
						alert("books berhasil dibuat");     
						window.location = "<?php echo base_url();?>books/index";

					}		
					
				}
			});
		}
   });
   
  
   
   
});
	   
</script>
</footer>
</html>