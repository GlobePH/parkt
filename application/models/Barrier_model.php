<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barrier_model extends CI_Model
{
  function __construct()
  {
   	parent::__construct();
  }

  function insert_marker($data)
  {
   	$this->db->insert('barrier_data', $data);
  }

  function get_markers()
  {
  	$this->db->select('*');
	  $this->db->from('barrier_data');
	  $query = $this->db->get();
	  $markers = $query->result_array();
	  return $markers;
  }

  function get_markers_async()
  {
  	$this->db->select('barrier_id, barrier_latitude, barrier_longitude, barrier_status');
	  $this->db->from('barrier_data');
	  $query = $this->db->get();
	  $markers = $query->result();
	  return $markers;
  }

  function get_marker($barrier_id)
  {
    $this->db->select('*');
    $this->db->from('barrier_data');
    $this->db->where('barrier_id', $barrier_id);
    $query = $this->db->get();
    $temp = $query->result_array();
    $marker = $temp[0];
    return $marker;
  }

  function update_marker($barrier_id)
  {
    $data = array(
      'barrier_status' => 1,
    );
    $this->db->where('barrier_id', $barrier_id);
    $this->db->update('barrier_data', $data);
  }

  function delete_marker($barrier_id)
  {
    $this->db->delete('barrier_data', array('barrier_id' => $barrier_id));
  }

  function alert_marker($barrier_id)
  {
    $data = array(
      'barrier_status' => 0,
    );
    $this->db->where('barrier_id', $barrier_id);
    $this->db->update('barrier_data', $data);
  }

}
