<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 报表统计
 *
 * @author		Longjianghu 215241062@qq.com
 * @copyright   Copyright © 2011 - 2012 Longjianghu. All Rights Reserved
 * @created     2011-10-26
 * @updated     2011-10-29
 * @version		1.0
 */

class Report extends CI_Controller
{

	private $orderTableName = 'orders'; // 订单表
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
		$this->load->model('reportmodel', 'r');
		$this->c->checkLogin();
		$this->load->helper('newsubstr');
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
	* 订单分析
	*
	* @access public
	* @return void
	*/
	 
	public function order()
	{
		$params = array(
						'select' => 'id,order_sn,sitename,username,channel,childer,addtime,signin',
						'from' => $this->orderTableName,
						'table' => $this->orderTableName,
						'url' => $this->c->getUrl('report/order'),
						'order_by' => 'id desc'
					);
		
		$channel = $this->input->get('channel', TRUE);
		
		if(!empty($channel))
		{
			$params['like'] = array('key' => 'channel', 'value' => $channel, 'flag' => null);
		}
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();
		$data['pid'] = $this->r->getOrderData(); // 按渠道统计
		$data['column'] = $this->r->getOrderData(1); // 按网站统计
		$this->load->view('report/order', $data);
	}
	
	/**
	* 转化分析
	*
	* @access public
	* @return void
	*/
	 
	public function transform()
	{
		$params = array(
						'select' => 'tid,transform,number',
						'from' => $this->transformTableName,
						'table' => $this->transformTableName,
						'where' => array('sid' => $this->session->userdata('sid')),
						'url' => $this->c->getUrl('report/transform'),
						'order_by' => 'rank desc'
					);
		
		$data = $this->c->pages($params);
		$data['pathinfo'] = $this->c->getPathInfo();
		$data['pid'] = $this->r->getTransFromData(); // 按渠道统计
		$data['column'] = $this->r->getTransFromData(1); // 按网站统计
		$this->load->view('report/transform', $data);
	}
	
	/**
	* 转化趋势
	*
	* @access public
	* @return void
	*/
	
	public function transformList()
	{
		$params = array(
						'select' => 'id,channel,childer,username,keyword,ipaddress,area,isp,brower,version,referer,dateline',
						'from' => $this->transformdataTableName,
						'table' => $this->transformdataTableName,
						'where' => array(
										'tid' => (int)$this->uri->segment(3),
										'sid' => $this->session->userdata('sid')
									),
						'url' => $this->c->getUrl('report/transformDetail'),
						'order_by' => 'id desc'
					);
					
		$data = $this->c->pages($params);
		$data['line'] = $this->r->getTransFromData(3); // 按渠道统计
		$data['action'] = 1;
		$this->load->view('report/transform',$data);
	}
	
	/**
	* 转化详情
	*
	* @access public
	* @return void
	*/
	
	public function transformDetail()
	{
		$params = array(
						'from' => $this->transformdataTableName,
						'where' => array('id' => (int)$this->uri->segment(3))
					);
					
		$data = $this->c->getOne($params);
		$data['action'] = 2;
		$this->load->view('report/transform',$data);
	}	
}
