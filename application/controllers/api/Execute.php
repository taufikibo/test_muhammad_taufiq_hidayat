<?php
require APPPATH . 'controllers/Rest.php';   
// require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;
// use \Libraries\REST_Controller;
class Execute extends Rest {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
	   $this->cektoken();
    }
       
    
	public function get_authors($id = 0)
	{
		// echo "asd";
        if(!empty($id)){
            $dta = $this->db->get_where("authors", ['id' => $id]);
        }else{
            $dta = $this->db->get("authors");
			
        }
		
		$data = [];
		foreach($dta->result() as $r) {
			$data[] = array(
					$r->id,
					$r->nama_authors,
					$r->telepon
			);
		}
	
		$result = array(
				
					"recordsTotal" => $dta->num_rows(),
					"recordsFiltered" => $dta->num_rows(),
					"data" => $data
				);
		echo json_encode($result);
		
         
	}
	
	public function get_authors_check()
	{
		 $dta = $this->db->get("authors");
		
		$data = [];
		foreach($dta->result() as $r) {
			$data[] = array(
					'id'=>$r->id,
					'nama_authors'=>$r->nama_authors,
					'telepon'=>$r->telepon
			);
		}
		echo json_encode($data);
		
         
	}
	
	public function get_authors_edit_book($id)
	{
		 $dta = $this->db->get_where("authors_books", ['id_books' => $id]);
		
		$data = [];
		foreach($dta->result() as $r) {
			$data[] = array(
					$r->id_authors=>"1"
			);
		}
		echo json_encode($data);
		
         
	}
	
	public function get_books($id = 0)
	{
		// echo "asd";
        if(!empty($id)){
            $dta = $this->db->get_where("books", ['id' => $id]);
        }else{
            $dta = $this->db->get("books");
			
        }
		
		$data = [];
		foreach($dta->result() as $r) {
			$data[] = array(
					$r->id,
					$r->nama_buku,
					$r->tahun
			);
		}
	
		$result = array(
				
					"recordsTotal" => $dta->num_rows(),
					"recordsFiltered" => $dta->num_rows(),
					"data" => $data
				);
		echo json_encode($result);
		
         
	}
	
	public function insert_users()
	{
		// echo "asd";
        $input = $this->input->post();
        $this->db->insert('users',$input);
     
		$response = array(
			'messages' 		=> true
			,'data' 		=> 'users created successfully.'
		);
		header('Content-Type: application/json');
		echo json_encode($response);
         
	}
	
	
	public function insert_authors()
	{
		// echo "asd";
        $input = $this->input->post();
        $this->db->insert('authors',$input);
     
		$response = array(
			'messages' 		=> true
			,'data' 		=> 'authors created successfully.'
		);
		header('Content-Type: application/json');
		echo json_encode($response);
         
	}
	public function update_authors($id)
    {
        $input = $this->input->post();
        $this->db->update('authors', $input, array('id'=>$id));
     
		$response = array(
			'messages' 		=> true
			,'data' 		=> 'authors updated successfully.'
		);
		header('Content-Type: application/json');
		echo json_encode($response);
    }
	public function insert_books()
	{
		// echo "asd";
        $input = $this->input->post();
		$authors =  $input['authors'];
		// die();
		$data = array(
				'nama_buku'=>$input['nama_buku'],
				'tahun'=>$input['tahun'],
		);
        $this->db->insert('books',$data);
		$id = $this->db->insert_id();
		
		$exp = explode('|',$authors);
		for($i=0;$i<count($exp)-1;$i++)
		{
			$data2 = array(
				'id_authors'=>$exp[$i],
				'id_books'=>$id,
			);
			$this->db->insert('authors_books',$data2);
		}
		
		$response = array(
			'messages' 		=> true
			,'data' 		=> 'books created successfully.'
		);
		header('Content-Type: application/json');
		echo json_encode($response);
         
	}
	
	public function update_books($id)
    {
        // echo "asd";
        $input = $this->input->post();
		$authors =  $input['authors'];
		// die();
		$data = array(
				'nama_buku'=>$input['nama_buku'],
				'tahun'=>$input['tahun'],
		);
        $this->db->update('books', $data, array('id'=>$id));
        $this->db->delete('authors_books', array('id_books'=>$id));
		
		$exp = explode('|',$authors);
		for($i=0;$i<count($exp)-1;$i++)
		{
			$data2 = array(
				'id_authors'=>$exp[$i],
				'id_books'=>$id,
			);
			$this->db->insert('authors_books',$data2);
		}
		$response = array(
			'messages' 		=> true
			,'data' 		=> 'books updated successfully.'
		);
		header('Content-Type: application/json');
		echo json_encode($response);
    }
	
	
	
	
	public function delete_authors($id)
    {
        $this->db->delete('authors', array('id'=>$id));
        $this->db->delete('authors_books', array('id_authors'=>$id));
       
        $this->response(['authors deleted successfully.'], 200);
    }
	public function delete_books($id)
    {
        $this->db->delete('books', array('id'=>$id));
        $this->db->delete('authors_books', array('id_books'=>$id));
       
        $this->response(['books deleted successfully.'], 200);
    }
	
    public function user_login(){
		$this->cektoken();
        $this->load->model('loginmodel');
        $username = $this->input->post('username'); 
        $pass = $this->input->post('password'); 
		// echo $pass;
        $dataadmin = $this->loginmodel->is_valid($username);
        if ($dataadmin) {
			// echo md5($pass)."==".$dataadmin->password;
            if (md5($pass)==$dataadmin->password) {
               
                $messages = true;
				
				// $this->session->set_userdata(array('username'=> $username,'role'=> $dataadmin->role));
				// echo $this->session->userdata('username');
                $data = "login berhasil";
            } else {
				http_response_code(401);
                $messages = false;
                $data = "invalid  password";
            }
        } else {
			http_response_code(401);
           $messages = false;
           $data = "invalid username ";
        }
		
		$response = array(
			'messages' 		=> $messages
			,'data' 		=> $data
		);
		header('Content-Type: application/json');
		echo json_encode($response);
    }
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('products',$input);
     
        $this->response(['Product created successfully.'], 200);
    } 
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('products', $input, array('id'=>$id));
     
        $this->response(['Product updated successfully.'], 200);
    }
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        $this->db->delete('products', array('id'=>$id));
       
        $this->response(['Product deleted successfully.'], 200);
    }
    	
}