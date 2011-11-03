<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 用户管理
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-18
 * @updated     2011-10-29
 * @version		1.0
 */

class Usermodel extends CI_Model
{

	private $tableName = 'users'; // 用户
	
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
					'username' => $this->input->post('username', TRUE),
					'password' => md5($this->input->post('password').$this->config->item('encrypt')),
					'regdate' => time(),
					'ipaddress' => $this->input->ip_address(),
					'lastdate' => time(),
					'lastip' => $this->input->ip_address(),
					'status' => $this->input->post('status')
				);
		
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
					'operation' => $this->session->userdata('username'),
					'dateline' => time(),
					'status' => (int)$this->input->post('status')
				);

		$password = $this->input->post('password');

		if(!empty($password))
		{
			$data['password'] = md5($password.$this->config->item('encrypt'));
		}
		
		$params = array(
					'where' => array('uid' => (int)$this->input->post('uid'))
				);
				
		$query = $this->c->update($this->tableName, $data, $params); 
		return $query;
    }
	
    /**
    * 获取用户信息
    * 
    * @access public
    * @return array
    */
	
	public function getUserInfo()
	{
		$data = array();		
		$uid = (int)$this->uri->segment(3);

		$params = array(
					'select' => 'uid,username,lastdate,lastip,status',
					'from'   => $this->tableName,
					'where'  => array('uid' => $uid),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return $data;
	}

}
