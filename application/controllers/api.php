<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * API接口
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-27
 * @updated     2011-10-29
 * @version		1.0
 */

class Api extends CI_Controller
{

	private $ordersTableName = 'orders'; // 订单
	private $transformTableName = 'transform'; // 转化项目
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
		$this->load->model('commonmodel', 'c');
		$this->load->model('apimodel', 'a');
	}
	
	/**
	* 首页
	*
	* @access public
	* @return void
	*/
	 
	public function index()
	{

	}
	
	/**
	* 转化接口
	*
	* @access public
	* @return void
	*/
	 
	public function transform()
	{
		$this->load->library('user_agent');

		$data = array(
					'sid' => (int)$this->input->get('st'), // 网站ID
					'pin' => $this->a->getPinCode(), // 识别码
					'user_agent' => $this->agent->agent_string(), // 浏览器信息
					'is_agent' => $this->agent->is_referral(),  // 代理上网
					'is_mobile' => $this->agent->is_mobile(),  // 移动设备
					'terminal' => $this->agent->mobile(),  // 设备名称
					'platform' => $this->agent->platform(),  // 操作系统
					'ipaddress' => $this->input->ip_address(),  // IP地址
					'area' => $this->a->getClientInfo(),  // 地区
					'isp' => $this->a->getClientInfo(1),  // 服务提供商
					'brower' => $this->agent->browser(),  // 浏览器
					'version' => $this->agent->version(),  // 浏览器版本
					'language' => $this->a->getLanguage(),  // 语言环境
					'screen_w' => (int)$this->input->get('sw'),  // 屏幕宽度
					'screen_h' => (int)$this->input->get('sh'),  // 屏幕高度
					'screen_c' => (int)$this->input->get('co'),  // 屏幕颜色
					'is_flash' => (int)$this->input->get('fl'),  // 是否支持 Flash
					'is_cookie' => (int)$this->input->get('ck'),  // 是否支持 Cookie
					'is_java' => (int)$this->input->get('ja'),  // 是否支持 JAVA
					'timezone' => (int)$this->input->get('tz'),  // 时区
					'plugin' => (int)$this->input->get('pn'),  // 插件数量
					'referer' => $this->input->get('rf'),  // 访问来源
					'current' => $this->agent->referrer(),  // 当前页
					'window_w' => (int)$this->input->get('ww'),  // 窗口宽度
					'window_h' => (int)$this->input->get('wh'),  // 窗口高度
					'page_w' => (int)$this->input->get('pw'),  // 页面宽度
					'page_h' => (int)$this->input->get('ph'),  // 页面高度
					'charset' => $this->input->get('ca'),  // 字符编码					
					'click_x' => (int)$this->input->get('mx'),  // 点击坐标-x
					'click_y' => (int)$this->input->get('my'),  // 点击坐标-y
					'screen_n' => (int)$this->input->get('sn'),  // 第几屏
					'parent' => (int)$this->input->get('sn'),  // 来源渠道ID
					'childer' => (int)$this->input->get('sc'),  // 子渠道
					'uid' => (int)$this->input->get('ma'),  // 推广人员ID
					'tid' => (int)$this->input->get('tf'),  // 转化项目ID
					'dateline' => time() // 访问时间		
				);
				
		if(!empty($data['referer']))
		{
			$data['keyword'] = $this->a->getKeyWord($data['referer']); // 关键字	
		}
		
		if(!empty($data['sid']))
		{
			$data['sitename'] = $this->a->getSiteName($data['sid']);  // 网站名称
		}
		
		if(!empty($data['tid']))
		{
			$data['transform'] = $this->a->getTransformName($data['tid']);  // 转化项目
		}
		
		if(!empty($data['uid']))
		{
			$data['username'] = $this->a->getUserName($data['uid']); // 推广人员
		}
		
		if(!empty($data['parent']))
		{
			$data['channel'] = $this->a->getChannelName($data['parent']); // 渠道名称
		}

		if(!empty($data['sid']) && !empty($data['tid']))
		{
			$this->a->insert($this->transformdataTableName, $data);
		}
		
		header("Content-type: image/gif");
	}
	
	/**
	* 订单接口
	*
	* @access public
	* @return void
	*/
	 
	public function order()
	{
		$data = array(
					'sid' => (int)$this->input->get('st'), // 网站ID
					'order_sn' => $this->input->get('od', TRUE), // 订单号
					'parent' => (int)$this->input->get('mc'), // 渠道
					'childer' => (int)$this->input->get('sc'), // 子渠道
					'uid' => (int)$this->input->get('ma'), // 市场推广人员					
					'addtime' => time()
				);
		
		if(!empty($data['sid']))
		{
			$data['sitename'] = $this->a->getSiteName($data['sid']); // 网站名称
		}
	
		if(!empty($data['uid']))
		{
			$data['username'] = $this->a->getUserName($data['uid']); // 会员姓名
		}
		
		if(!empty($data['parent']))
		{
			$data['channel'] = $this->a->getChannelName($data['parent']); // 渠道名称
		}
		
		if(!empty($data['sid']))
		{
			$this->c->insert($this->ordersTableName, $data);
		}
			
		header("Content-type: image/gif");
	}
	
	/**
	* 点击量监测
	*
	* @access public
	* @return void
	*/
	 
	public function click()
	{

	}
}
