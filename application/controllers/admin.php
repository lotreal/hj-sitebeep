<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 框架页
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-17
 * @updated     2011-10-29
 * @version		1.0
 */

class Admin extends CI_Controller
{
	/**
	* 初始化
	*
	* @access public
	* @return void
	*/
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('commonmodel', 'c');
		$this->c->checkLogin();
	}
	
	/**
	* 首页
	*
	* @access public
	* @return void
	*/
	 
	public function index()
	{	
		$this->load->view('admin');
	}

	/**
	* 框架头部
	*
	* @access public
	* @return void
	*/
	 
	public function header()
	{	
		$data = array(
					'uid' => $this->session->userdata('uid'),
					'username' => $this->session->userdata('username'),
					'lastdate' => $this->session->userdata('lastdate'),
					'lastip' => $this->session->userdata('lastip')
				);

		$this->load->view('common/header', $data);
	}
	
	/**
	* 侧边栏
	*
	* @access public
	* @return void
	*/
	 
	public function sidebar()
	{
		$this->load->model('loginmodel', 'l');
		$data['data'] = $this->l->getWebsite();
		$this->load->view('common/sidebar', $data);
	}
	
	/**
	* 系统默认页
	*
	* @access public
	* @return void
	*/
	 
	public function main()
	{	
		$this->load->view('common/main');
	}
	
	/**
	* 更改SID
	*
	* 手动更改推广网站session变量sid
	*
	* @access public
	* @return void
	*/
	 
	public function changeSid()
	{
		$sid = (int)$this->input->post('sid');
		$this->session->set_userdata('sid', $sid);
		echo (!empty($sid)) ? 1 : 0;
	}
}
