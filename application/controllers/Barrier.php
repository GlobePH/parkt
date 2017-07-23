<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barrier extends CI_Controller
{
  public function __construct()
  {
	parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
  	$this->load->library('session');
  	$this->load->helper('security');
  	$this->load->helper('form');
  	$this->load->helper('url');
  	$this->load->helper('html');
  	$this->load->database();
  	$this->load->model('Barrier_model');
  }

  public function landing_page(){
    $markers = [
      [
        'name' => '32nd Street, 5th Avenue',
        'latitude' => 14.553685692191547,
        'longitude' => 121.04884922504425,
        'slots' => 70,
        'available_slots' => 70,
        'operating_hours' => '10:00 AM - 9:00 PM',
        'weekday_category' => 'Flat Rate',
        'weekday_price' => 'Php 45',
        'weekend_category' => 'Increasing Rate',
        'weekend_price' => 'Php 50 + Php 10 per hour',
      ],
      [
        'name' => '32nd Street, 3rd Avenue',
        'latitude' => 14.554468428198884,
        'longitude' => 121.0470387339592,
        'slots' => 30,
        'available_slots' => 0,
        'operating_hours' => '8:00 AM - 12:00 AM',
        'weekday_category' => 'Increasing Rate',
        'weekday_price' => 'Php 40 + Php 50 per hour',
        'weekend_category' => 'Flat Rate',
        'weekend_price' => 'Php 50',
      ],
      [
        'name' => 'Home Depot Parking Back',
        'latitude' => 14.55493443388976,
        'longitude' => 121.05088233947754,
        'slots' => 80,
        'available_slots' => 73,
        'operating_hours' => '8:00 AM - 10:00 PM',
        'weekday_category' => 'Flat Rate',
        'weekday_price' => 'Php 50',
        'weekend_category' => 'Increasing Rate',
        'weekend_price' => 'Php 50 + Php 30 per hour',
      ],
      [
        'name' => 'Home Depot Parking Back',
        'latitude' => 14.554298381308962,
        'longitude' => 121.05009108781815,
        'slots' => 20,
        'available_slots' => 18,
        'operating_hours' => '8:00 AM - 10:00 PM',
        'weekday_category' => 'Flat Rate',
        'weekday_price' => 'Php 50',
        'weekend_category' => 'Increasing Rate',
        'weekend_price' => 'Php 50 + Php 30 per hour',
      ],
    ];
  	$data = array(
  		'markers' => $markers
  		);
  	$this->load->view('landing_page.php', $data);
  }

  public function add_marker()
  {
  	$barrier_id = $this->security->xss_clean($this->input->post("ajax_barrier_id"));
  	$barrier_key = $this->security->xss_clean($this->input->post("ajax_barrier_key"));
  	$barrier_longitude = $this->security->xss_clean($this->input->post("ajax_longitude"));
  	$barrier_latitude = $this->security->xss_clean($this->input->post("ajax_latitude"));
  	$barrier_salt = $this->rand_string(64);
  	$barrier_password = hash('sha256', $barrier_key.$barrier_salt);
  	$data = array(
       	'barrier_id' => $barrier_id,
       	'barrier_password' => $barrier_password,
       	'barrier_salt' => $barrier_salt,
       	'barrier_longitude' => $barrier_longitude,
       	'barrier_latitude' => $barrier_latitude,
  		'barrier_status' => 1
    		);
  	$this->Barrier_model->insert_marker($data);
  }

  public function update_marker()
  {
  	$barrier_id = $this->security->xss_clean($this->input->post("ajax_barrier_id"));
  	$this->Barrier_model->update_marker($barrier_id);
  }

  public function async_update_marker()
  {
    $markers = [
      [
        'name' => '32nd Street, 5th Avenue',
        'latitude' => 14.553685692191547,
        'longitude' => 121.04884922504425,
        'slots' => 70,
        'available_slots' => 70,
        'operating_hours' => '10:00 AM - 9:00 PM',
      ],
      [
        'name' => '32nd Street, 3rd Avenue',
        'latitude' => 14.554468428198884,
        'longitude' => 121.0470387339592,
        'slots' => 30,
        'available_slots' => 20,
        'operating_hours' => '8:00 AM - 12:00 AM',
      ],
      [
        'name' => 'Home Depot Parking Back',
        'latitude' => 14.55493443388976,
        'longitude' => 121.05088233947754,
        'slots' => 80,
        'available_slots' => 73,
        'operating_hours' => '8:00 AM - 10:00 PM',
      ],
      [
        'name' => 'Home Depot Parking Back',
        'latitude' => 14.554298381308962,
        'longitude' => 121.05009108781815,
        'slots' => 20,
        'available_slots' => 18,
        'operating_hours' => '8:00 AM - 10:00 PM',
      ],
    ];
    echo json_encode($markers);
    try {
      $entityBody = file_get_contents('php://input');
      echo $entityBody;
    } catch (Exception $e) {
      echo "";
    }
    echo($_POST);
    echo($_REQUEST);
  	// echo json_encode($this->Barrier_model->get_markers_async());
  }

  public function delete_marker()
  {
  	$barrier_id = $this->security->xss_clean($this->input->post("ajax_barrier_id"));
  	$this->Barrier_model->delete_marker($barrier_id);
  }

  public function test_page()
  {
  	$markers = $this->Barrier_model->get_markers();
  	$marker = $this->Barrier_model->get_marker('barrier_01');
  	$data = array(
  		'markers' => $markers,
  		'marker' => $marker
  		);
  	$this->load->view('test_page.php', $data);
  }

  public function alert()
  {
  	$barrier_id = $this->security->xss_clean($this->input->post('barrier_id'));
  	$barrier_key = $this->security->xss_clean($this->input->post('barrier_key'));
  	$marker = $this->Barrier_model->get_marker($barrier_id);
  	if($marker['barrier_password'] == hash('sha256', $barrier_key.$marker['barrier_salt'])){
  		$this->Barrier_model->alert_marker($barrier_id);
  	}
  }

  public function rand_string($length)
  {
  	$str="";
  	$chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  	$size = strlen($chars);
  	for($i = 0;$i < $length;$i++) {
  	  $str .= $chars[rand(0,$size-1)];
  	}
  	return $str;
  }
}
