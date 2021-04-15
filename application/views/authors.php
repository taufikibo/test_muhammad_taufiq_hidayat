<html>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

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

<div class="jumbotron">
  <div class="container text-center">
  <a href="<?php echo base_url() ?>authors/add">add Authors</a>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>nama authors</th>
                <th>telepon</th>
                <th>Aksi</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                 <th>id</th>
                <th>nama authors</th>
                <th>telepon</th>
				<th>Aksi</th>
            </tr>
        </tfoot>
    </table>
  </div>
</div>
  


<br><br>
</body>
<footer>
<script type="text/javascript">
$(document).ready(function () {
	$(document).ready(function() {
    $('#example').DataTable( {
		
		"processing": true,
            "bServerSide": false,
            "sAjaxSource": '<?php echo base_url();?>authors/get_authors',
            "sServerMethod": "GET",
            "wPaginationType": "full_numbers",
            "columnDefs": [{
            "targets": 3,
            "render": function ( data, type, row, meta ) {
                var id = row[0];                    
                return '<a href="<?php echo base_url();?>authors/edit_authors/' + id + '">Edit</a>'+
				' | '+
				<?php if($this->session->userdata('role')=='admin'){ ?>
				'<a href="<?php echo base_url();?>authors/delete_authors/' + id + '">Delete</a>'
				<?php }else{?>
				'Only Admin can deleted'
				<?php }?>
				;
            }
        }]
		
        
    } );
} );
   
});
	   
</script>
</footer>
</html>