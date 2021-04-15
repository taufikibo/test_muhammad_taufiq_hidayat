<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Api
{
	
	public $data = array();
	protected $result;
    protected $client_id = "test_ci";
    protected $secretkey = "muhammad_taufiq_hidayat";
	protected $_HEADER = array();	var $CI = NULL;
	function __construct()
	{
        //Do your magic here
        $this->CI =& get_instance();
		// $this->_HEADER[] = "Content-type: application/x-www-form-urlencoded";
	}
	
	public function getToken($main_url){
		$path = 'rest/get_token/'.'?client_id='.$this->client_id.'&secretkey='.$this->secretkey;

		$ch = curl_init();

		// Set query data here with the URL
		curl_setopt($ch, CURLOPT_URL, $main_url.$path); 
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$content = trim(curl_exec($ch));
		curl_close($ch);
		// print $content;
		$result = json_decode($content,true);
		return $result['token'];
		
	}
	
	public function curl_get($main_url,$token){
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: '.$token);;

		$ch = curl_init();

		// Set query data here with the URL
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $main_url); 
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$content = trim(curl_exec($ch));
		curl_close($ch);
		// print $content;
		
		$result = json_decode($content,true);
		return $result;
		
	}
	
    public function curl_post($main_url,$data,$token)
    {
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
			'Authorization: '.$token);;
		
		
		$ch = curl_init();
		$query = http_build_query($data);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $main_url);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		
		// Set request method to POST
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// Set query data here with CURLOPT_POSTFIELDS
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		
		$content = trim(curl_exec($ch));
		curl_close($ch);
		return $content;
		
	}
	
	public function get_api($url)
    {
      

     
      $request_headers = array();
      $request_headers[] = 'Content-Type: application/json';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $data = curl_exec($ch);

      if (curl_errno($ch))
        {
        print "Error: " . curl_error($ch);
        }
        else
        {
        // Show me the result

        $transaction = json_decode($data, TRUE);

        curl_close($ch);

        return $transaction['data'];

      }
    }

}