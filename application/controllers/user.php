<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 用户信息
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-18
 * @updated     2011-10-29
 * @version		1.0
 */

class User extends CI_Controller
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
		$this->load->model('commonmodel', 'c');
		$this->load->model('usermodel', 'u');
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
		$params = array(
						'select' => 'uid,username,group,job,lastdate,lastip,operation,dateline,status',
						'from' => $this->tableName,
						'table' => $this->tableName,
						'url' => $this->c->getUrl('user/index')
					);

		$username = $this->input->get('username', TRUE);
		
		if(!empty($username))
		{
			$params['like'] = array('key' => 'username', 'value' => $username, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();		
		$this->load->view('user/index', $data);
	}

	/**
	* 用户添加
	*
	* @access public
	* @return void
	*/
	
	public function add()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'username', 'label' => '用户名', 'rules' => 'required|min_length[2]'),
					array('field' => 'password', 'label' => '密码', 'rules' => 'required|min_length[6]|matches[confirm]'),
					array('field' => 'confirm', 'label' => '确认密码', 'rules' => 'required|min_length[6]|matches[password]'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('matches', '两次输入的%s不一致');
		
		$data = array('password' => $this->config->item('initialize'), 'pathinfo' => $this->c->getPathInfo(), 'action' => 1);

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->u->insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("用户资料添加'.$str.'!");window.parent.$.colorbox.close();</script>';
		}

		$this->load->view('user/action', $data);
	}
	
	/**
	* 资料更新
	*
	* @access public
	* @return void
	*/
	
	public function update()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'username','label' => '用户名', 'rules' => 'required|min_length[2]'),
					array('field' => 'password','label' => '密码', 'rules' => 'min_length[6]|matches[confirm]'),
					array('field' => 'confirm','label' => '确认密码', 'rules' => 'min_length[6]|matches[password]'),
					array('field' => 'status','label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('matches', '两次输入的%s不一致');
		
		$data = $this->u->getUserInfo();

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->u->update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("用户资料更新'.$str.'!");window.parent.$.colorbox.close();</script>';
		}

		$this->load->view('user/action', $data);
	}
	
	/**
	* 用户审核
	*
	* @access public
	* @return void
	*/
	
	public function verify()
	{
		$status = (int)$this->uri->segment(4);		
		$data['status'] = (empty($status)) ? 1 : 0;		
		$params = array('where' => array('uid' => (int)$this->uri->segment(3)));
		$query = $this->c->update($this->tableName, $data, $params);
		
		if($query)
		{
			$data = array('operation' => $this->session->userdata('username'), 'dateline' => time());
			$this->c->update($this->tableName, $data, $params);
		}
		
		echo '<script type="text/javascript">window.history.go(-1);</script>';
		
	}
	
	/**
	* 删除用户
	*
	* @access public
	* @return void
	*/
	
	public function delete()
	{
		$params = array('where' => array('uid' => (int)$this->uri->segment(3)));
		$this->c->delete($this->tableName, $params);	
		redirect('/user', 'refresh');
	}
	
}
