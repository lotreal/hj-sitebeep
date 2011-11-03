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

class Reportmodel extends CI_Model
{

	private $orderTableName = 'orders'; // 订单
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
	}
	
	/**
	* 获取订单图表数据
	*
	* @access public
	* @param  int    $flag 0:cid 渠道ID 1:uid 推广人员ID
	* @return void
	*/
	
	public function getOrderData($flag = 0)
	{		
		$data =  array(
					'chart' => array(
								'showBorder' => 0,
								'bgColor' => 'ffffff',
								'xAxisName' => '渠道',
								'yAxisName' => '订单数',
								'numberSuffix' => '订单'
							)
				);
		
		$params = array(
					'select' => array('fields'=>'`channel` as `label`,count(*) as `value`'),
					'from'   => $this->orderTableName,
					'where' => array('sid' => $this->session->userdata('sid')),
					'group_by'  => 'cid'
				);
		
		if($flag)
		{
			$data['chart']['xAxisName'] = '推广人员';
			$params['select']['fields'] = '`username` as `label`,count(*) as `value`';
			$params['group_by'] = 'uid';
		}
			
		$data['data'] = $this->c->getAll($params);		
		return json_encode($data);
	}
	
	/**
	* 获取转化图表数据
	*
	* @access public
	* @param  int    $flag 0:tid 转化ID 1:uid 推广人员ID 3:按天统计
	* @return void
	*/
	
	public function getTransFromData($flag = 0)
	{		
		$data =  array(
					'chart' => array(
								'showBorder' => 0,
								'bgColor' => 'ffffff',
								'xAxisName' => '日期',
								'yAxisName' => '转化数',								
								'numberSuffix' => '次',
								'canvasPadding' => '10',
								'chartRightMargin' => '30'
							)
				);
		
		$params = array(
					'select' => array('fields'=>'`transform` as `label`,count(*) as `value`'),
					'from'   => $this->transformdataTableName,
					'where' => array('sid' => $this->session->userdata('sid')),
					'group_by'  => 'tid'
				);
		
		if($flag == 1)
		{
			$data['chart']['xAxisName'] = '推广人员';
			$params['select']['fields'] = '`username` as `label`,count(*) as `value`';
			$params['group_by'] = 'uid';
		}
		
		if($flag == 3)
		{
			$params['where']['tid'] = (int)$this->uri->segment(3);
			$params['select'] = array('fields' => 'FROM_UNIXTIME(`dateline`,"%Y-%c-%d")  as `label`,count(*) as `value`');
			$params['group_by'] = 'label';
		}
			
		$data['data'] = $this->c->getAll($params);
		return json_encode($data);
	}
	
	/**
	* 获取转化总数
	*
	* @access public
	* @param  array  $params 原始统计数据
	* @return int
	*/
	
	public function getTransfromTotal($params = null)
	{
		$data = 0;
		
		if(!empty($params) && is_array($params))
		{
			if(isset($params['data']))
			{
				foreach($params['data'] as $v)
				{
					$data += $v['number'];			
				}
			}
		}
		
		unset($params);
		return $data;
	}
	
}
