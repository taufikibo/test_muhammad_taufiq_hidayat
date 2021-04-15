<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		if(!$this->session->userdata('username')){
            redirect('');
        }
		// $this->session->set_userdata(array('username'=> 'asdasd'));
		// echo $this->session->userdata('username').'ad';
		$this->load->view('beranda');
	}
	
	public function regist()
	{
		$arr = array();
		$arr['username'] 		= $this->input->post('username');
		$arr['password'] 		= md5($this->input->post('password'));
		$arr['role'] 			= $this->input->post('role');
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/insert_users';
		$insert = $this->api->curl_post($main_url,$arr,$token);
		// print_r($token);
		// print_r($insert);
		// echo "asd";
		
		// echo json_decode($insert);
		print_r($insert);
		
	}
	
	public function login()
	{
		$arr = array();
		$arr['username'] 		= $this->input->post('username');
		// echo $this->input->post('password').'<br>';
		$arr['password'] 		= $this->input->post('password');
		$this->load->library('api');
		$token = $this->api->getToken(base_url());
		$main_url = base_url().'api/execute/user_login';
		$login = $this->api->curl_post($main_url,$arr,$token);
		// print_r($login);
		$resp = json_decode($login);
		// var_dump($resp);
		// echo $resp->messages.'asd';
		// die();
		if($resp->messages==1){
			$this->load->model('loginmodel');
			$username = $this->input->post('username'); 
			$pass = $this->input->post('password'); 
			$dataadmin = $this->loginmodel->is_valid($username);
			$this->session->set_userdata(array('username'=> $username,'role'=> $dataadmin->role));
		}
		print_r($login);
		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
		
	}
}
