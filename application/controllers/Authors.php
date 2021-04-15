<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authors extends CI_Controller {

	public function index()
	{
		if(!$this->session->userdata('username')){
            redirect('');
        }
		$this->load->view('authors');
	}
	
	public function add()
	{
		if(!$this->session->userdata('username')){
            redirect('');
        }
		$this->load->view('authors_add');
	}
	
	public function add_api()
	{
		$arr = array();
		$arr['nama_authors'] 		= $this->input->post('nama_authors');
		$arr['telepon'] 		= $this->input->post('telepon');
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/insert_authors';
		$insert = $this->api->curl_post($main_url,$arr,$token);
		// print_r($token);
		print_r($insert);
		// echo "asd";
		
		// echo json_decode($insert);
		
	}
	
	public function edit_api()
	{
		$arr = array();
		$arr['nama_authors'] 		= $this->input->post('nama_authors');
		$arr['telepon'] 		= $this->input->post('telepon');
		$id 		= $this->input->post('id');
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/update_authors/'.$id;
		$insert = $this->api->curl_post($main_url,$arr,$token);
		// print_r($token);
		print_r($insert);
		// echo "asd";
		
		// echo json_decode($insert);
		
	}
	
	public function delete_authors($id)
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		// echo $token;
		$main_url = base_url().'api/execute/delete_authors/'.$id;
		$delete = $this->api->curl_get($main_url,$token);
		redirect('authors');
		
	}
	
	public function get_authors()
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_authors';
		$get = $this->api->curl_get($main_url,$token);
		// print_r($token);
		// print_r($insert);
		// echo "asd";
		
		echo json_encode($get);
		
	}
	
	public function edit_authors($id)
	{
		
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/get_authors/'.$id;
		$get = $this->api->curl_get($main_url,$token);
		// print_r($token);
		// print_r($insert);
		// echo "asd";
		$data['dta'] = $get;
		// echo json_encode($get);
		$this->load->view('authors_edit',$data);
		
	}
	
	
}
