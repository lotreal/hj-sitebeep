<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	private $tableName = 'report'; // 传感器、探针
	
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
	
    public function insert($data)
    {
        $this->proxy->delete($this->tableName, array(
                'where' => array(
                    'sid' => (int)$data['sid'],
                    'cid' => (int)$data['cid'],
                                 )
                                                     )
                             );
        $detail = $data['report'];
        $report = array(
            'sid' => (int)$data['sid'],
            'cid' => (int)$data['cid'],
            'url' => $detail['url'],
            'status' => $detail['http_code'],
            'detail' => serialize($detail),
            'created' => time(),
                        );
		return $this->proxy->insert($this->tableName, $report);
    }

	public function getAll()
	{
        $query = $this->db->get($this->tableName, 10);
        return $query->result();
	}
}
