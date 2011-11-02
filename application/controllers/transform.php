<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 项目转化
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-25
 * @updated     2011-10-29
 * @version		1.0
 */

class Transform extends CI_Controller
{

	private $tableName = 'transform'; // 项目转化
	
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
		$this->load->model('transformmodel', 't');
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
						'select' => 'tid,transform,describe,rank,operation,dateline,status',
						'from' => $this->tableName,
						'table' => $this->tableName,
						'url' => $this->c->getUrl('transform/index'),
						'where' => array('sid' => $this->session->userdata('sid'))
					);

		$transform = $this->input->get('transform', TRUE);
		
		if(!empty($transform))
		{
			$params['like'] = array('key' => 'transform', 'value' => $transform, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['sid'] = $this->session->userdata('sid');
		$data['pathinfo'] = $this->c->getPathInfo();
		$this->load->view('transform/index', $data);
	}
	
	/**
	* 转化添加
	*
	* @access public
	* @return void
	*/
	
	public function add()
	{
		$this->load->library('form_validation');

		$config = array(
					array('field' => 'transform', 'label' => '转化名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');		
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data = array('action' => 1);
		
		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->t->insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("转化项目添加'.$str.'!");window.parent.$.colorbox.close();</script>';
		}

		$this->load->view('transform/action', $data);
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
					array('field' => 'transform', 'label' => '转化名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');		
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data = array('data' => $this->t->getTransFormInfo());
		
		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->t->update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("转化项目更新'.$str.'!");window.parent.$.colorbox.close();</script>';
		}

		$this->load->view('transform/action', $data);
	}
	
	/**
	* 转化审核
	*
	* @access public
	* @return void
	*/
	
	public function verify()
	{
		$status = (int)$this->uri->segment(4);		
		$data['status'] = (empty($status)) ? 1 : 0;		
		$params = array('where' => array('tid' => (int)$this->uri->segment(3)));
		$query = $this->c->update($this->tableName, $data, $params);
		
		if($query)
		{
			$data = array('operation' => $this->session->userdata('username'), 'dateline' => time());
			$this->c->update($this->tableName, $data, $params);
		}
		
		echo '<script type="text/javascript">window.history.go(-1);</script>';
		
	}
	
	/**
	* 删除转化
	*
	* @access public
	* @return void
	*/
	
	public function delete()
	{
		$params = array('where' => array('tid' => (int)$this->uri->segment(3)));
		$this->c->delete($this->tableName, $params);	
		echo '<script type="text/javascript">window.history.go(-1);</script>';
	}
	
	/**
	* 获取推广代码
	*
	* @access public
	* @return void
	*/
	
	public function getCode()
	{
		$data = array('data' => $this->t->getTransFormInfo() ,'sid' => $this->session->userdata('sid'));
		$this->load->view('transform/code', $data);
	}
	
	/**
	* 显示排序校验
	*
	* @access public
	* @return boolean
	*/
	 
	public function validate($param)
	{
		$rank = (int)$param;		
		return ($rank >=0 && $rank <= 65535) ? TRUE : FALSE;
	}
	
}
