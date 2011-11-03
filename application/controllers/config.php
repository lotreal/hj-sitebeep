<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 系统配置
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-18
 * @updated     2011-10-29
 * @version		1.0
 */

class Config extends CI_Controller
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
		$data = array('data' => $this->_getConfig(), 'pathinfo' => $this->c->getPathInfo());
		$this->load->view('config', $data);
	}

	/**
	* 配置更新
	*
	* @access public
	* @return void
	*/
	
	public function update()
	{
		$this->load->library('form_validation');
		
		$config = array(
					array('field' => 'sitename', 'label' => '系统名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'shutdown', 'label' => '关闭系统', 'rules' => 'required|integer'),
					array('field' => 'notice', 'label' => '关闭提示', 'rules' => 'required|min_length[2]'),
					array('field' => 'number', 'label' => '列表数量', 'rules' => 'required|integer'),
					array('field' => 'gap', 'label' => '防刷间隔', 'rules' => 'required|integer'),
					array('field' => 'offline', 'label' => '离线时间', 'rules' => 'required|integer'),
					array('field' => 'encrypt', 'label' => '加密字符', 'rules' => 'required|min_length[6]'),
					array('field' => 'initialize', 'label' => '初始化密码', 'rules' => 'required|min_length[6]'),         
				);
		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
						'sitename' => $this->input->post('sitename', TRUE),
						'shutdown' => (int)$this->input->post('shutdown'),
						'notice' => $this->input->post('notice', TRUE),
						'number' => (int)$this->input->post('number'),
						'gap' => (int)$this->input->post('gap'),
						'offline' => (int)$this->input->post('offline'),
						'allow' => $this->input->post('allow', TRUE),
						'astrict' => $this->input->post('astrict', TRUE),
						'encrypt' => $this->input->post('encrypt', TRUE),
						'old' => $this->input->post('old', TRUE),
						'initialize' => $this->input->post('initialize', TRUE)
					);
			
			if($data['encrypt'] != $data['old'])
			{
				$new = array('password'=>md5($data['initialize'].$data['encrypt']));
				$where = array('uid'=>$this->session->userdata('uid'));
				$this->c->update('users', $new, $where);
			}
			
			unset($data['old']);			
			$this->_writeFile($data);					
		}
		
		redirect('/config', 'refresh');
	}
		
	/**
	* 配置文件更新
	*
	* @access private
	* @param  array   $data 系统配置
	* @return void
	*/
	
	private function _writeFile($data)
	{
		$this->load->helper('file');
		$path = APPPATH.'config/MY_config.php';
		$str = '<?php '."\r\n".'$config = array(';

		foreach($data as $k=>$v)
		{
			$str .= "\r\n'".$k.'\'=>\''.$v."',";
		}
		
		$str .= "\r\n);";
		write_file($path, $str);
	}
	
	/**
	* 获取系统配置
	*
	* @access private
	* @return void
	*/
	
	private function _getConfig()
	{
		$config = array(
					'sitename' => $this->config->item('sitename'),
					'shutdown' => $this->config->item('shutdown'),
					'notice' => $this->config->item('notice'),
					'number' => $this->config->item('number'),
					'gap' => $this->config->item('gap'),
					'offline' => $this->config->item('offline'),
					'allow' => $this->config->item('allow'),
					'astrict' => $this->config->item('astrict'),
					'encrypt' => $this->config->item('encrypt'),
					'old' => $this->config->item('old'),
					'initialize' => $this->config->item('initialize')
				);
		
		return $config;
	}
}
