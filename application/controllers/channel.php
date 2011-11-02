<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 渠道管理
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-23
 * @updated     2011-10-29
 * @version		1.0
 */

class Channel extends CI_Controller
{

	private $tableName = 'channel'; // 渠道
	private $catTableName = 'channel_category'; // 渠道分类
	
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
		$this->load->model('channelmodel', 'cha');
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
						'select' => 'cid,channel,category,describe,rank,operation,dateline,status',
						'from' => $this->tableName,
						'table' => $this->tableName,
						'url' => $this->c->getUrl('channel/index'),
						'where' => array('sid' => $this->session->userdata('sid'))
					);

		$channel = $this->input->get('channel', TRUE);
		
		if(!empty($channel))
		{
			$params['like'] = array('key' => 'channel', 'value' => $channel, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['sid'] = $this->session->userdata('sid');
		$data['pathinfo'] = $this->c->getPathInfo();
		$this->load->view('channel/index', $data);
	}
	
	/**
	* 渠道分类
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
						'url' => $this->c->getUrl('channel/category'),
						'where' => array('sid' => $this->session->userdata('sid'))
					);

		$category = $this->input->get('category', TRUE);
		
		if(!empty($category))
		{
			$params['like'] = array('key' => 'category', 'value' => $category, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();		
		$this->load->view('channel/category', $data);
	}
	
	/**
	* 渠道添加
	*
	* @access public
	* @return void
	*/
	
	public function add()
	{
		$this->load->library('form_validation');   

		$config = array(
					array('field' => 'channel', 'label' => '渠道名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'cat_id', 'label' => '渠道分类', 'rules' => 'required|integer'),
					array('field' => 'pageurl', 'label' => '访问地址', 'rules' => 'callback_pageurl'),
					array('field' => 'parent', 'label' => '渠道参数', 'rules' => 'integer'),
					array('field' => 'childer', 'label' => '子渠道参数', 'rules' => 'integer'),
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
		
		$data = array('category' => $this->cha->getAllCategory(), 'sid' => $this->session->userdata('sid'), 'action' => 1);

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->cha->insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("渠道资料添加'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('channel/action', $data);
	}
	
	/**
	* 渠道分类添加
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
		
		$data = array('category' => $this->cha->getCategory(), 'action' => 1);

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->cha->cat_insert();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("分类资料添加'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('channel/cat_action', $data);
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
					array('field' => 'channel', 'label' => '渠道名称', 'rules' => 'required|min_length[2]'),
					array('field' => 'cat_id', 'label' => '渠道分类', 'rules' => 'required|integer'),
					array('field' => 'pageurl', 'label' => '访问地址', 'rules' => 'callback_pageurl'),
					array('field' => 'parent', 'label' => '渠道参数', 'rules' => 'integer'),
					array('field' => 'childer', 'label' => '子渠道', 'rules' => 'integer'),
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
		
		$data = array('category' => $this->cha->getAllCategory(), 'data' => $this->cha->getChannelInfo());

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->cha->update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("渠道资料更新'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('channel/action', $data);
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
		
		$data['data'] = $this->cha->getCategoryInfo();
		$data['category'] = $this->cha->getCategory();

		if ($this->form_validation->run() == TRUE)
		{
			$query = $this->cha->cat_update();
			$str = ($query) ? '成功' : '失败';
			echo '<script type="text/javascript">alert("分类资料更新'.$str.'!");window.parent.$.colorbox.close();</script>';
		}
		
		$this->load->view('channel/cat_action', $data);
	}
	
	/**
	* 渠道审核
	*
	* @access public
	* @return void
	*/
	
	public function verify()
	{
		$status = (int)$this->uri->segment(4);		
		$data['status'] = (empty($status)) ? 1 : 0;		
		$params = array('where' => array('cid' => (int)$this->uri->segment(3)));		
		$query = $this->c->update($this->tableName, $data, $params);

		if($query)
		{
			$data = array('operation' => $this->session->userdata('username'), 'dateline' => time());
			$this->c->update($this->tableName, $data, $params);
		}		
		
		echo '<script type="text/javascript">window.history.go(-1);</script>';		
	}
	
	/**
	* 渠道分类审核
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
	* 删除渠道
	*
	* @access public
	* @return void
	*/
	
	public function delete()
	{
		$params = array('where' => array('cid' => (int)$this->uri->segment(3)));
		$this->c->delete($this->tableName, $params);	
		echo '<script type="text/javascript">window.history.go(-1);</script>';
	}
	
	/**
	* 删除渠道分类
	*
	* @access public
	* @return void
	*/
	
	public function cat_delete()
	{	
		$params = array('where' => array('cat_id' => (int)$this->uri->segment(3)));
		$this->c->delete($this->catTableName, $params);	
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
		$data = array('url' => $this->cha->getChannelUrl());	
		$this->load->view('channel/code', $data);
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
		return (preg_match('|http:\/\/\w+.\w+.\w+/$|', $param)) ? TRUE : FALSE;
	}
	
}
