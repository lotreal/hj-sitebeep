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

class Websitemodel extends CI_Model
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
					'sitename' => $this->input->post('sitename', TRUE),
					'cat_id' => (int)$this->input->post('cat_id'),
					'pageurl' => $this->input->post('pageurl', TRUE),
					'describe' => $this->input->post('describe', TRUE),
					'rank' => (int)$this->input->post('rank'),
					'status' => (int)$this->input->post('status'),
					'auditor' => $this->session->userdata('username'),
					'audittime' => time()
				);
				
		$data['category'] = $this->_getCategory($data['cat_id']);
		$query = $this->c->insert($this->tableName, $data);
		
		if($query)
		{
			$this->_setSid();
		}
		
		return $query;
    }
	
    /**
    * 设定session变量sid
    * 
    * @access public
	* @param  integer  $sid 网站ID
    * @return void
    */
	
	private function _setSid()
	{
		$sid = $this->session->userdata('sid');
		
		if(empty($sid))
		{
			$this->session->set_userdata('sid', $this->db->insert_id());
		}
	}
	
    /**
    * 分类数据添加
    * 
    * @access public
    * @return array
    */

    public function cat_insert()
    {
		$data = array(
					'category' => $this->input->post('category', TRUE),
					'parent_id' => (int)$this->input->post('parent_id'),					
					'rank' => (int)$this->input->post('rank'),
					'status' => (int)$this->input->post('status'),
					'auditor' => $this->session->userdata('username'),
					'audittime' => time()
				);
				
		$data['parent'] = $this->_getParent($data['parent_id']);
		return $this->c->insert($this->catTableName, $data);		
    }
	
	/**
    * 获取上级分类名称
    * 
    * @access private
	* @param  integer $cat_id 分类ID
    * @return array
    */
	
	private function _getParent($cat_id)
	{
		if(empty($cat_id))
		{
			return '';
		}
		
		$data = array();
	
		$params = array(
					'select' => 'category',
					'from'   => $this->catTableName,
					'where'  => array('cat_id' => $cat_id),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return (empty($data)) ? '' : $data['category'];
	}
	
	/**
    * 获取分类名称
    * 
    * @access private
	* @param  integer $cat_id 分类ID
    * @return array
    */
	
	private function _getCategory($cat_id)
	{
		if(empty($cat_id))
		{
			return '';
		}
		
		$data = array();
	
		$params = array(
					'select' => 'category',
					'from'   => $this->catTableName,
					'where'  => array('cat_id' => $cat_id),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return (empty($data)) ? '' : $data['category'];
	}
	
	/**
    * 获取一级分类
    * 
    * @access public
    * @return array
    */
	
	public function getCategory()
	{
		$data = array();
		
		$params = array(
					'select' => 'cat_id,category',
					'from'   => $this->catTableName,
					'where' => array('parent' => 0, 'cat_id <>' => (int)$this->uri->segment(3))
				);
		
		$data = $this->c->getAll($params);		
		return $data;
	}
	
	/**
    * 获取网站分类
    * 
    * @access public
    * @return array
    */
	
	public function getAllCategory()
	{
		$data = array();
		
		$params = array(
					'select' => 'cat_id,category',
					'from'   => $this->catTableName,
					'where' => array('status' => 1)
				);
		
		$data = $this->c->getAll($params);		
		return $data;
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
					'sitename' => $this->input->post('sitename', TRUE),
					'cat_id' => (int)$this->input->post('cat_id'),
					'pageurl' => $this->input->post('pageurl', TRUE),
					'describe' => $this->input->post('describe', TRUE),
					'rank' => (int)$this->input->post('rank'),
					'status' => (int)$this->input->post('status'),
					'operation' => $this->session->userdata('username'),
					'dateline' => time(),
				);
				
		$data['category'] = $this->_getCategory($data['cat_id']);
		$params = array('where' => array('sid' => (int)$this->input->post('sid')));
		return $this->c->update($this->tableName, $data, $params);
    }
	
	/**
    * 分类数据更新
    * 
    * @access public
    * @return array
    */

    public function cat_update()
    {
		$data = array(
					'category' => $this->input->post('category'),
					'parent_id' => (int)$this->input->post('parent_id'),
					'rank' => (int)$this->input->post('rank'),
					'operation' => $this->session->userdata('username'),
					'dateline' => time(),
					'status' => (int)$this->input->post('status')
				);
				
		$cat_id = (int)$this->input->post('cat_id');
		$params = array('where' => array('cat_id' => $cat_id));		
		$query = $this->c->update($this->catTableName, $data, $params);
		
		if($query)
		{
			$this->_setCategoryName($cat_id, $data['category']);
			
			if($data['parent_id'] == 0)
			{
				$parent = array(
							'parent' => $this->_getParent($cat_id),
							'operation' => $this->session->userdata('username'),
							'dateline' => time()
						);
				
				$parent_id = array('where' => array('parent_id' => $cat_id));
				$this->c->update($this->catTableName, $parent, $parent_id);	
			}
		}

		return $query;
    }
	
	/**
    * 更新渠道名称
    * 
    * @access private
	* @param  integer $cat_id   分类ID
	* @param  string  $category 分类名称
    * @return array
    */
	
	private function _setCategoryName($cat_id, $category)
	{
		$data = array('category' => $category);
		$params = array('where' => array('cat_id' => $cat_id));
		$this->c->update($this->tableName, $data, $params);
	}
	
    /**
    * 获取网站信息
    * 
    * @access public
    * @return array
    */
	
	public function getSiteInfo()
	{
		$data = array();
		
		$params = array(
					'select' => 'sid,sitename,cat_id,pageurl,describe,rank,status',
					'from'   => $this->tableName,
					'where'  => array('sid' => (int)$this->uri->segment(3)),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return $data;
	}
	
    /**
    * 获取分类信息
    * 
    * @access public
    * @return array
    */
	
	public function getCategoryInfo()
	{
		$data = array();
		
		$params = array(
					'select' => 'cat_id,category,parent_id,rank,status',
					'from'   => $this->catTableName,
					'where'  => array('cat_id' => (int)$this->uri->segment(3)),
					'limit' => 1
				);
		
		$data = $this->c->getOne($params);
		return $data;
	}
}
