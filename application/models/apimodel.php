<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * API 接口
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-27
 * @updated     2011-10-29
 * @version		1.0
 */

class Apimodel extends CI_Model
{

	private $websiteTableName = 'website'; // 网站
	private $usersTableName = 'users'; // 用户
	private $channelTableName = 'channel'; // 渠道
	private $transformsTableName = 'transform'; // 转化项目
	private $transformdataTableName = 'transform_data'; // 转化数据	
	
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
    * 获取用户识别码
    * 
    * @access public
    * @return string
    */
	
	public function getPinCode()
	{
		return substr(md5($this->input->ip_address().$this->agent->agent_string()),0,8);
	}
	
    /**
    * 转化数据写入
    * 
    * @access public
	* @param  string $table 表名
	* @param  array  $data  转化数据
    * @return void
    */
	
	public function insert($table, $data)
	{
		$query = $this->c->insert($table, $data);
		
		if($query)
		{
			$value = array('key' => 'number', 'value' => 1);
			$where = array('sid' => $data['sid'], 'tid' => $data['tid']);
			$this->c->set($this->transformsTableName, $value, $where);
		}
	}
	
    /**
    * 获取搜索关键字
    * 
    * @access public
	* @param  string $url URL地址
    * @return string
    */
	
	public function getKeyWord($url)
	{
		$referer = '';
		$data = $query = array();		
		
		$robot = array(
					'soso' => 'w', 'baidu' => 'wd', 'google' => 'q', 'sogou' => 'query',
					'youdao' => 'q', 'bing' => 'q', 'yahoo' => 'q'
				);
				
		$data = parse_url($url);

		if(!empty($data))
		{
			if(isset($data['query']) && !empty($data['query']))
			{
				parse_str($data['query'], $query);
		
				foreach($robot as $k=>$v)
				{
					if(stripos($data['host'], $k))
					{
						$referer = iconv('gbk','utf-8',$query[$robot[$k]]);
						$referer = urldecode($referer);
						break;
					}				
				}
			}
			elseif(isset($data['fragment']) && !empty($data['fragment']))
			{
				parse_str($data['fragment'], $query);
				
				if(isset($query['q']))
				{
					$referer = urldecode($query['q']);
				}				
			}
			
			unset($data, $query);
		}	
		
		return $referer;
	}
	
    /**
    * 获取客户信息
    * 
    * @access public
	* @param  integer $flag 0：所在地区 1：服务提供商
    * @return string
    */
	
	public function getClientInfo($flag = 0)
	{
		$str = '';
		$data = array();		
		$bad = array('对方和您在同一内部网');		
		$ipdata = FCPATH .'ipdata/QQWry.Dat';
		$this->load->helper('convertip');
		$str = convertip($this->input->ip_address(), $ipdata);
		
		if(stripos($str, '@'))
		{
			$data = explode('@', $str);
			
			if(!empty($data) && is_array($data))
			{
				$str = ($flag) ? str_replace($bad, '', $data[1]) : $data[0];
			}

		}
		
		return $str;
	}
		
    /**
    * 获取推广网站名称
    * 
    * @access public
	* @param  integer $sid 网站ID
    * @return array
    */
	
	public function getSiteName($sid)
	{
		$data = array();
		
		$params = array(
					'select' => 'sitename',
					'from' => $this->websiteTableName,
					'where' => array('sid'=> $sid)
				);
		
		$data = $this->c->getOne($params);
		return (!empty($data) && isset($data['sitename'])) ? $data['sitename'] : '';
	}

	/**
    * 获取推广人员姓名
    * 
    * @access public
	* @param  integer $uid 用户ID
    * @return array
    */
	
	public function getUserName($uid)
	{
		$data = array();
		
		$params = array(
					'select' => 'username',
					'from' => $this->usersTableName,
					'where' => array('uid'=> $uid)
				);
		
		$data = $this->c->getOne($params);
		return (!empty($data) && isset($data['username'])) ? $data['username'] : '';
	}
	
	/**
    * 获取渠道名称
    * 
    * @access public
	* @param  integer $parent 渠道ID
    * @return array
    */
	
	public function getChannelName($parent)
	{
		$data = array();
		
		$params = array(
					'select' => 'channel',
					'from' => $this->channelTableName,
					'where' => array('parent'=> $parent)
				);
		
		$data = $this->c->getOne($params);
		return (!empty($data) && isset($data['channel'])) ? $data['channel'] : '';
	}
	
	/**
    * 获取转化项目名称
    * 
    * @access public
	* @param  integer $tid 转化项目ID
    * @return array
    */
	
	public function getTransformName($tid)
	{
		$data = array();
		
		$params = array(
					'select' => 'transform',
					'from' => $this->transformsTableName,
					'where' => array('tid'=> $tid)
				);
		
		$data = $this->c->getOne($params);
		return (!empty($data) && isset($data['transform'])) ? $data['transform'] : '';	
	}
	
	/**
    * 获取语言环境
    * 
    * @access public
    * @return string
    */
	
	public function getLanguage()
	{
		$str = '';
		$data = $this->agent->languages();

		if(!empty($data) && isset($data[0]))
		{
			$str = $data[0];
		}
		
		unset($data);
		return $str;
		
	}
}
