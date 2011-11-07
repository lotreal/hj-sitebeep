<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_model extends CI_Model
{
	private $tableName = 'check'; // 传感器、探针
	
	/**
	* 初始化
	*
	* @access public
	* @return void
	*/
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getCheck($id)
	{
        $this->db->from($this->tableName);
        $this->db->where('id', $id);
        return $this->db->get()->result();
	}

    /**
    * 
    * @access public
    * @return array
    */
	public function getChecks()
	{
        $query = $this->db->get($this->tableName, 10);
        return $query->result();
	}
}
