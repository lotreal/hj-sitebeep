<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sensor_model extends CI_Model
{
	private $tableName = 'sensor'; // 传感器、探针
	
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

	public function getSensorName($sid)
	{
		if(empty($sid))
		{
			return '';
		}
		
		$data = array();
	
		$params = array(
					'select' => 'sname',
					'from'   => $this->tableName,
					'where'  => array('id' => $sid),
					'limit' => 1
				);
		
		$data = $this->proxy->getOne($params);
		return (empty($data)) ? '' : $data['sname'];
	}
	
	public function getSensor($sid)
	{
        $this->db->from($this->tableName);
        $this->db->where('id', $sid);
        return $this->db->get()->result();
	}

    /**
    * 
    * @access public
    * @return array
    */
	public function getSensors()
	{
        $query = $this->db->get($this->tableName, 10);
        return $query->result();
	}
}
