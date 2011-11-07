<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 会员登录
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-17
 * @updated     2011-10-29
 * @version		1.0
 */

class User_model extends CI_Model
{

	private $tableName = 'user'; // 用户
	
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
    * 获取会员信息
    * 
    * @access public
    * @return array
    */

    public function getUserInfo()
    {
		$data = array();
		$query = FALSE;
	
		$params = array(
					'select' => 'uid,username,lastdate,lastip',
					'from'   => $this->tableName,
					'where'  => array(
									'username' => $this->input->post('username'),
									'password' => md5($this->input->post('password').$this->config->item('encrypt')),
									'status' => 1
								),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);

		if(!empty($data))
		{
			$query = $this->setLoginInfo($data['uid']);			
			$this->session->set_userdata($data);
		}

		return $query;
    }
	
    /**
    * 更新会员登录信息
    * 
    * @access public
	* @param  int $uid 会员ID
    * @return array
    */
	 
	public function SetLoginInfo($uid)
	{
		$data = $where = array();
		
		$data = array(
					'lastdate' => time(),
					'lastip'   => $this->input->ip_address()
				);
		
		$params = array('where' => array('uid' => (int)$uid));
		$query = $this->c->update($this->tableName, $data, $params);
		return $query;		
	}
}
