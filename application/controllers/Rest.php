<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/REST_Controller.php';

require APPPATH . '/libraries/jwt/JWT.php';
require APPPATH . '/libraries/jwt/BeforeValidException.php';
require APPPATH . '/libraries/jwt/ExpiredException.php';
require APPPATH . '/libraries/jwt/SignatureInvalidException.php';
use \Firebase\JWT\JWT;
// use Restserver\Libraries\REST_Controller;
class Rest extends CI_Controller {
    private $client_id = 'test_ci'; 
    private $secretkey = 'muhammad_taufiq_hidayat'; 

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

    
	
	public function get_token(){
        $client_id = $this->input->get('client_id');
        $secretkey = $this->input->get('secretkey');
		$date = new DateTime();
        if ($client_id==$this->client_id and $secretkey==$this->secretkey ) {
            $payload['client_id'] = $client_id;
            $payload['iat'] = $date->getTimestamp(); //waktu di buat
            $payload['exp'] = $date->getTimestamp() + 3600; //satu jam
            $output['token'] = JWT::encode($payload,$this->secretkey);
			header('Content-Type: application/json');
			echo json_encode($output);
        } else {
			http_response_code(401);
			$response = array(
				'messages' 		=> false
				,'data' 		=> 'invalid client id'
			);
			header('Content-Type: application/json');
			echo json_encode($response);
        }
       
	   
    }

    
  
   
    public function cektoken(){
        $this->load->model('loginmodel');
        $jwt = $this->input->get_request_header('Authorization');
        try {
            $decode = JWT::decode($jwt,$this->secretkey,array('HS256'));
            if ($decode->client_id==$this->client_id) {
                return true;
            }else{
				http_response_code(401);
				 $response = array(
				'messages' 		=> false
				,'data' 		=> 'invalid token'
				);
				header('Content-Type: application/json');
				return json_encode($response);
			}
        } catch (Exception $e) {
            exit('Wrong Token');
        }
    }

}
?>