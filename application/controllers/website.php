<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 网站管理
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-24
 * @updated     2011-10-29
 * @version		1.0
 */

class Website extends CI_Controller
{
	private $tableName = 'website'; // 网站
	private $catTableName = 'website_category'; // 网站分类
	
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
		$this->load->model('websitemodel', 'w');
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
						'select' => 'sid,sitename,category,pageurl,rank,operation,dateline,status',
						'from' => 'website',
						'table' => 'website',
						'url' => $this->c->getUrl('website/index'),
						'order_by' => 'rank desc'
					);

		$sitename = $this->input->get('sitename', TRUE);
		
		if(!empty($sitename))
		{
			$params['like'] = array('key' => 'sitename', 'value' => $sitename, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();
		$this->load->view('website/index', $data);
	}
	
	/**
	* 网站分类
	*
	* @access public
	* @return void
	*/
	 
	public function category()
	{
		$params = array(
						'select' => 'cat_id,category,parent,rank,operation,dateline,status',
						'from' => $this->catTableName,
						'table' => $this->catTableName,
						'url' => $this->c->getUrl('website/category'),
						'order_by' => 'rank desc'
					);

		$category = $this->input->get('category', TRUE);
		
		if(!empty($category))
		{
			$params['like'] = array('key' => 'category', 'value' => $category, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();		
		$this->load->view('website/category', $data);
	}	

	/**
	* 网站添加
	*
	* @access public
	* @return void
	*/
	
	public function add()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'sitename', 'label' => '网站名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'cat_id', 'label' => '网站分类', 'rules' => 'required|integer'),
					array('field' => 'pageurl', 'label' => '访问地址', 'rules' => 'callback_pageurl'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('pageurl', '%s格式错误');
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data = array('category' => $this->w->getAllCategory(), 'action' => 1);

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->w->insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("网站资料添加'.$str.'!");window.top.frames["sidebar"].location.reload();window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('website/action', $data);
	}
	
	/**
	* 分类添加
	*
	* @access public
	* @return void
	*/
	
	public function cat_add()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'category', 'label' => '分类名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'parent_id', 'label' => '上级分类', 'rules' => 'required|integer'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data = array('category' => $this->w->getCategory(), 'action' => 1);

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->w->cat_insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("分类资料添加'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('website/cat_action', $data);
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
					array('field' => 'sitename', 'label' => '网站名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'cat_id', 'label' => '网站分类', 'rules' => 'required|integer'),
					array('field' => 'pageurl', 'label' => '访问地址', 'rules' => 'callback_pageurl'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('pageurl', '%s格式错误');
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data = array('data' => $this->w->getSiteInfo(), 'category' => $this->w->getAllCategory());

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->w->update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("网站资料更新'.$str.'!");window.top.frames["sidebar"].location.reload();window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('website/action', $data);
	}
	
	/**
	* 分类资料更新
	*
	* @access public
	* @return void
	*/
	
	public function cat_update()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'category', 'label' => '分类名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'parent_id', 'label' => '上级分类', 'rules' => 'required|integer'),
					array('field' => 'rank', 'label' => '显示排序', 'rules' => 'callback_validate'),
					array('field' => 'status', 'label' => '审核状态', 'rules' => 'required|integer')					
				);
		
		$this->form_validation->set_rules($config); 
		$this->form_validation->set_error_delimiters('<em>', '</em>');
		$this->form_validation->set_message('required', '%s不能为空');
		$this->form_validation->set_message('integer', '%s必须是数字');
		$this->form_validation->set_message('min_length', '%s字符长度不足');
		$this->form_validation->set_message('validate', '只能输入0-65535之间的数字');
		
		$data['data'] = $this->w->getCategoryInfo();
		$data['category'] = $this->w->getCategory();

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->w->cat_update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("分类资料更新'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('website/cat_action', $data);
	}
		
	/**
	* 网站审核
	*
	* @access public
	* @return void
	*/
	
	public function verify()
	{
		$status = (int)$this->uri->segment(4);		
		$data['status'] = (empty($status)) ? 1 : 0;		
		$params = array('where' => array('sid' => (int)$this->uri->segment(3)));		
		$query = $this->c->update($this->tableName, $data, $params);			
		
		if($query)
		{
			$data = array('operation' => $this->session->userdata('username'), 'dateline' => time());
			$this->c->update($this->tableName, $data, $params);
		}
		
		echo '<script type="text/javascript">window.history.go(-1);</script>';		
	}
	
	/**
	* 网站分类审核
	*
	* @access public
	* @return void
	*/
	
	public function cat_verify()
	{
		$status = (int)$this->uri->segment(4);		
		$data['status'] = (empty($status)) ? 1 : 0;		
		$params = array('where' => array('cat_id' => (int)$this->uri->segment(3)));		
		$query = $this->c->update($this->catTableName, $data, $params);

		if($query)
		{
			$data = array('operation' => $this->session->userdata('username'), 'dateline' => time());
			$this->c->update($this->catTableName, $data, $params);
		}
		
		echo '<script type="text/javascript">window.history.go(-1);</script>';		
	}
	
	/**
	* 删除网站
	*
	* @access public
	* @return void
	*/
	
	public function delete()
	{
		$params = array('where' => array('sid' => (int)$this->uri->segment(3)));
		$this->c->delete($this->tableName, $params);	
		redirect('/website', 'refresh');
	}
	
	/**
	* 删除网站分类
	*
	* @access public
	* @return void
	*/
	
	public function cat_delete()
	{	
		$params = array('where' => array('cat_id' => (int)$this->uri->segment(3)));
		$this->c->delete($this->catTableName, $params);	
		redirect('/website', 'refresh');
	}
	
	/**
	* 获取推广代码
	*
	* @access public
	* @return void
	*/
	
	public function getCode()
	{
		$data = $this->w->getSiteInfo();
		$this->load->view('website/code', $data);
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
	
	/**
	* 访问格式校验
	*
	* @access public
	* @return boolean
	*/
	
	public function pageurl($param)
	{
		return (preg_match('|http:\/\/\w+.\w+.\w+|', $param)) ? TRUE : FALSE;
	}
}
