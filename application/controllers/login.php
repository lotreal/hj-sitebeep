<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 用户登录
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-17
 * @updated     2011-10-29
 * @version		1.0
 */

class Login extends CI_Controller
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
	}
	
	/**
	* 首页
	*
	* @access public
	* @return void
	*/
	 
	public function index()
	{
		$this->checkLogin();
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'username', 'label' => '用户名', 'rules' => 'required|min_length[3]'),
					array('field' => 'password', 'label' => '密码', 'rules' => 'required|min_length[5]'),
					array('field' => 'captcha', 'label' => '验证码', 'rules' => 'callback_validate'),         
				);
		
		$this->form_validation->set_rules($config); 
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$this->load->model('loginmodel', 'l');
			$query = $this->l->getUserInfo();

			if($query)
			{
				redirect('/admin', 'refresh');
			}
			else
			{
				redirect('/login', 'refresh');
			}
		}
	}
	
	/**
	* 验证码校验
	*
	* @access	public
	* @return	boolean
	*/
	 
	public function validate($param)
	{
		$query = FALSE;
		
		if ($param == $this->session->userdata('captcha'))
		{			
			$query = TRUE;
		}
		
		$this->form_validation->set_message('validate', '你输入的%s不正确');
		return $query;		
	}
	
	/**
	* 验证码生成
	*
	* @access	public
	* @return	boolean
	*/
	 
	public function captcha()
	{
		$this->load->library('captcha/simplecaptcha');
		$this->simplecaptcha->createimage();
	}

	/**
	* 注销登录
	*
	* @access	public
	* @return	boolean
	*/
	 
	public function logout()
	{
		$this->c->logout();
	}
	
	/**
	* 登录检测
	*
	* @access public
	* @return boolean
	*/
	 
	public function checkLogin()
	{
		$uid = $this->session->userdata('uid');
		
		if(!empty($uid))
		{
			redirect('/admin', 'refresh');
		}
	}
}
