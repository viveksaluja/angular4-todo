<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comman_modal extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function insert($table,$data)
  	{
  		$this->db->insert($table,$data);
  		$insert_id = $this->db->insert_id();
  		if( $insert_id != 0)
  			$output = array (1,$insert_id);
  		else
  			$output = array (0);
  		return $output;
  	}

    public function getTable($tbl)
  	{
  		$this->db->select('*');
      $this->db->from($tbl);
      $result = $this->db->get();
      $result = $result->result();
      return $result;
  	}

    public function deleteMultiple($table,$where,$values)
    {
      $this->db->where_in($where, $values);
      $this->db->delete($table);
      $db_error = $this->db->error();
  		if ($db_error['code'] == 0)
  			return '1';
  		else
  			return '0';
    }
        
  }
?>
