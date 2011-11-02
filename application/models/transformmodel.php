<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 转化项目
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-25
 * @updated     2011-10-29
 * @version		1.0
 */

class Transformmodel extends CI_Model
{

	private $tableName = 'transform'; // 转化项目
	
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
	
   /**
    * 数据添加
    * 
    * @access public
    * @return array
    */

    public function insert()
    {
		$data = array(
					'transform' => $this->input->post('transform', TRUE),
					'describe' => $this->input->post('describe', TRUE),
					'rank' => (int)$this->input->post('rank'),					
					'status' => $this->input->post('status'),
					'sid' => $this->session->userdata('sid'),
					'auditor' => $this->session->userdata('username'),
					'audittime' => time()					
				);

		if(empty($data['sid']))
		{
			return FALSE;
		}

		return $this->c->insert($this->tableName, $data);		
    }
	
   /**
    * 数据更新
    * 
    * @access public
    * @return array
    */

    public function update()
    {
		$data = array(
					'transform' => $this->input->post('transform', TRUE),
					'describe' => $this->input->post('describe', TRUE),
					'rank' => (int)$this->input->post('rank'),
					'status' => $this->input->post('status'),
					'sid' => $this->session->userdata('sid'),
					'operation' => $this->session->userdata('username'),
					'dateline' => time()					
				);
				
		if(empty($data['sid']))
		{
			return FALSE;
		}
		
		$params = array('where' => array('tid' => (int)$this->input->post('tid')));
		return $this->c->update($this->tableName, $data, $params);		
    }
	
    /**
    * 获取转化信息
    * 
    * @access public
    * @return array
    */
	
	public function getTransFormInfo()
	{
		$data = array();
		
		$params = array(
					'select' => 'tid,transform,describe,rank,status',
					'from'   => $this->tableName,
					'where'  => array('tid' => (int)$this->uri->segment(3)),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return $data;
	}
}
