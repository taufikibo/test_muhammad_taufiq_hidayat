<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function index()
	{
		if(!$this->session->userdata('username')){
            redirect('');
        }

		$this->load->view('books');
	}
	
	public function add()
	{
		if(!$this->session->userdata('username')){
            redirect('');
        }
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_authors_check';
		$get = $this->api->curl_get($main_url,$token);
		$data['authors'] = $get;
		$this->load->view('books_add',$data);
	}
	
	public function add_api()
	{
		$arr = array();
		$arr['nama_buku'] 		= $this->input->post('nama_books');
		$arr['tahun'] 			= $this->input->post('tahun');
		$arr['authors'] 		= $this->input->post('authors');
		
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/insert_books';
		$insert = $this->api->curl_post($main_url,$arr,$token);
		// print_r($token);
		print_r($insert);
		// echo "asd";
		
		// echo json_decode($insert);
		
	}
	
	public function edit_api()
	{
		$arr = array();
		$arr['nama_buku'] 		= $this->input->post('nama_books');
		$arr['tahun'] 		= $this->input->post('tahun');
		$arr['authors'] 		= $this->input->post('authors');
		$id 		= $this->input->post('id');
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/update_books/'.$id;
		$insert = $this->api->curl_post($main_url,$arr,$token);
		// print_r($token);
		print_r($insert);
		// echo "asd";
		
		// echo json_decode($insert);
		
	}
	
	public function delete_books($id)
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		// echo $token;
		$main_url = base_url().'api/execute/delete_books/'.$id;
		$delete = $this->api->curl_get($main_url,$token);
		redirect('books');
		
	}
	
	public function get_books()
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_books';
		$get = $this->api->curl_get($main_url,$token);
		// print_r($token);
		// print_r($insert);
		// echo "asd";
		
		echo json_encode($get);
		
	}
	
	public function edit_books($id)
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_books/'.$id;
		$get = $this->api->curl_get($main_url,$token);
		// print_r($token);
		// print_r($insert);
		// echo "asd";
		$data['dta'] = $get;

		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_authors_edit_book/'.$id;
		$get = $this->api->curl_get($main_url,$token);
		$data['authors_check'] = $get;
		
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_authors_check/';
		$get = $this->api->curl_get($main_url,$token);
		$data['authors'] = $get;
		
		$this->load->view('books_edit',$data);
		
	}
}
