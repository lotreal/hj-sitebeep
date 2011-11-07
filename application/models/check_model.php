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

	public function getCheckName($id)
	{
		if(empty($id))
		{
			return '';
		}

		$data = array();

		$params = array(
					'select' => 'cname',
					'from'   => $this->tableName,
					'where'  => array('id' => $id),
					'limit'  => 1
				);
		
		$data = $this->proxy->getOne($params);
		return (empty($data)) ? '' : $data['cname'];
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
