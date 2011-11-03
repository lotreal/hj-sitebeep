<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 通用模型
 *
 * 网站通用模型:在CI基础上重新封装了数据库操作方法，以及其它常用方法
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-17
 * @updated     2011-10-29
 * @version		1.0
 */

class Commonmodel extends CI_Model
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
	}
	
    /**
    * 数据写入
    * 
    * @access public
    * @param  string $table 表名
    * @param  array  $data  用户数据
    * @return bool
    */

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return ($this->db->insert_id()) ? TRUE : FALSE;
    }

    /**
    * 数据更新
    *
    * @access public
    * @param  string $table 表名
    * @param  array  $data  用户数据
    * @param  array  $where 更新条件
    * @return bool
    */

    public function update($table, $data, $where)
    {
        $this->_condition($where);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() >= 0) ? TRUE : FALSE;
    }
	
    /**
    * 更新指定的值
    *
    * @access public
    * @param  string $table 表名
    * @param  array  $data  用户数据
    * @param  array  $where 更新条件
    * @return bool
    */
	
	public function set($table, $data, $where)
	{
		$this->db->set($data['key'], $data['key'].'+'.$data['value'], FALSE);
		$this->db->where($where);
		$this->db->update($table);
		return ($this->db->affected_rows() >= 0) ? TRUE : FALSE;
	}

    /**
    * 数据删除
    *
    * @access public
    * @param  string $table 表名
    * @param  array  $where 删除条件
    * @return bool
    */

    public function delete($table, $where)
    {
        $this->_condition($where);
        $this->db->delete($table);
        return ($this->db->affected_rows()) ? TRUE : FALSE;
    }
	
    /**
	* 获取符合条件的记录
    *
    * @access public
    * @param  string $params 搜索条件
    * @return array
    */

    public function getAll($params)
    {
        $this->_condition($params);
        return $this->db->get()->result_array();
    }

    /**
    * 获取符合条件的单条记录
    *
    * @access public
    * @param  string $params 搜索条件
    * @return array
    */

    public function getOne($params)
    {
        $this->_condition($params);
        $data = $this->db->get()->result_array();
        return (!empty($data) && isset($data[0])) ? $data[0] : null;
    }

    /**
    * 获取符合条件的记录数
    *
    * @access public
    * @param  string $params 搜索条件
    * @return number
    */

    public function countAll($params)
    {
        $this->_condition($params);
        return $this->db->count_all_results();
    }
	
	/**
    * 网站通用分页
    * 
    * @access public
    * @param  array  $params 搜索条件
    * @return array
    */

    public function pages($params)
    {
        $this->load->library('pagination');
        $config['base_url']       = site_url($params['url']);
        $config['total_rows']     = $this->countAll($params);
        $config['per_page']       = $this->config->item('number');
        $config['num_links']      = 4;
        $config['full_tag_open']  = '<div class="pages">';
        $config['first_link']     = '首页';
        $config['prev_link']      = '上一页';
        $config['next_link']      = '下一页';
        $config['last_link']      = '尾页';
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open']   = '<a href="javascript:void(0);" title="你正在浏览当前页面" id="selected">';
        $config['cur_tag_close']  = '</a>';	
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		
        unset($params['from']);        
		$this->_condition($params);		
        $this->pagination->initialize($config);
        $data['data'] = $this->db->get($params['table'], $config['per_page'], (int)$this->input->get('page'))->result_array();
		$data['rows'] = $config['total_rows'];
        $data['link'] = $this->pagination->create_links();
        return $data;
    }
	
    /**
    * 根据条件生成SQL查询条件
    * 
    * @access private
    * @param  array   $params 搜索条件
    * @return void
    */

    private function _condition($params)
    {
        if (isset($params['select']))
        {
			if(is_array($params['select']))
			{
				$this->db->select($params['select']['fields'],FALSE);
			}
			else
			{
				$this->db->select($params['select']);
			}            
        }

        if (isset($params['from']))
        {
            $this->db->from($params['from']);
        }

        if (isset($params['where']))
        {
            $this->db->where($params['where']);
        }

        if (isset($params['or_where']))
        {
            $this->db->or_where($params['or_where']);
        }

        if (isset($params['join']))
        {
            $this->db->join($params['join']['key'], $params['join']['value'], $params['join']['flag']);
        }

        if (isset($params['where_in']))
        {
            $this->db->where_in($params['where_in']['key'], $params['where_in']['value']);
        }

        if (isset($params['like']))
        {
            $this->db->like($params['like']['key'], $params['like']['value'], $params['like']['flag']);
        }

        if (isset($params['order_by']))
        {
            $this->db->order_by($params['order_by']);
        }

        if (isset($params['group_by']))
        {
            $this->db->group_by($params['group_by']);
        }
		
        if (isset($params['having']))
        {
            $this->db->having($params['group_by']);
        }

        if (isset($params['limit']))
        {
            $this->db->limit($params['limit']);
        }
    }
	
	/**
	* 获取URL
	*
	* @access public
	* @param  string $segment URL片断
	* @return string
	*/
	
	public function getUrl($segment ='')
	{
		$output = array();		
		$url = parse_url($_SERVER['REQUEST_URI']);
	
		if(isset($url['query']))
		{
			$output = array();			
			parse_str($url['query'], $output);			
			unset($output['page']);
		}
		
		if(!empty($output))
		{
			$segment = $segment.'?'.http_build_query($output);
		}
		
		unset($url);
		return $segment;		
	}
	
	/**
	* 登录检测
	*
	* 检测用户是否登录，如果没有登录跳转至登录页
	*
	* @access public
	* @return boolean
	*/
	 
	public function checkLogin()
	{
		$uid = $this->session->userdata('uid');
		
		if(empty($uid))
		{
			echo '<script type="text/javascript">window.top.location.href="'.site_url('login').'"</script>';
		}
	}
	
	/**
    * 面包屑导航
    *
    * @access public
    * @return string
    */
	
	public function getPathInfo()
	{
		$str = '你的位置：'.anchor('admin', '管理系统', array('title' => '管理系统首页','target' => '_parent')).' >>';
		$url = $this->uri->segment_array();

		if($url[1] == 'config')
		{
			$str .=  ' '.anchor($url[1], '系统配置', 'title="系统配置"').' >>';	
		}
			
		if($url[1] == 'user')
		{
			$str .=  ' '.anchor($url[1], '用户管理', 'title="用户管理"').' >>';	
		}
		
		if($url[1] == 'channel')
		{
			$str .=  ' '.anchor($url[1], '渠道管理', 'title="渠道管理"').' >>';	
			
			if(isset($url[2]) && $url[2] == 'category')
			{
				$str .=  ' '.anchor($url[1].'/'.$url[2], '渠道分类', 'title="渠道分类"').' >>';	
			}
		}
		
		if($url[1] == 'website')
		{
			$str .=  ' '.anchor($url[1], '网站管理', 'title="网站管理"').' >>';	
			
			if(isset($url[2]) && $url[2] == 'category')
			{
				$str .=  ' '.anchor($url[1].'/'.$url[2], '网站分类', 'title="网站分类"').' >>';	
			}
		}
		
		if($url[1] == 'transform')
		{
			$str .=  ' '.anchor($url[1], '转化项目', 'title="转化项目"').' >>';	
		}

		if($url[1] == 'report')
		{
			$str .=  ' '.anchor($url[1], '报表统计', 'title="报表统计"').' >>';
			
			if(isset($url[2]) && $url[2] == 'order')
			{
				$str .=  ' '.anchor($url[1].'/'.$url[2], '订单分析', 'title="订单分析"').' >>';	
			}
			
			if(isset($url[2]) && $url[2] == 'transform')
			{
				$str .=  ' '.anchor($url[1].'/'.$url[2], '转化分析', 'title="转化分析"').' >>';	
			}
		}
		
		return rtrim($str,'>>');
	}
	
	/**
    * 注销登录
    *
    * @access public
	* @param  integer $flag 0：php跳转 1：JS跳转
    * @return void
    */

    public function logout($flag = 0)
    {
        $this->session->sess_destroy();
		
		if($flag)
		{
			redirect('/', 'refresh');
		}
		
		echo '<script type="text/javascript">window.top.location.href="'.site_url('/').'"</script>';
		
    }
	
	/**
    * 程序调试方法
    *
    * @access public
    * @param  object  $data  用户数据
    * @param  integer $flag  使用方法
    * @param  integer $break 是否中断程序执行
    * @return void
    */

    public function p($data = null, $flag = 0, $break = 1)
    {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><pre>';
		
        if ($flag)
        {
            var_dump($data);
        }
        else
        {
            print_r($data);
        }
		
		if($break)
		{
			exit();
		}
        
    }
}
