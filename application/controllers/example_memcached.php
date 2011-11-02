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

class Example_memcached extends CI_Controller 
{	
	function Example_memcached()
	{
		parent::__construct();
	}
	
	function test()
	{
		// Load library
		$this->load->library('memcached_library');
		
		// Lets try to get the key
		$results = $this->memcached_library->get('test');
		
		// If the key does not exist it could mean the key was never set or expired
		if (!$results) 
		{
			// Modify this Query to your liking!
			$query = $this->db->get('users', 7000);
			
			// Lets store the results
			$this->memcached_library->add('test', $query->result());
			
			// Output a basic msg
			echo "Alright! Stored some results from the Query... Refresh Your Browser";
		}
		else 
		{
			// Output
			var_dump($results);
			
			// Now let us delete the key for demonstration sake!
			// $this->memcached_library->delete('test');
		}
		
	}
	
	function stats()
	{
		$this->load->library('memcached_library');
		
		echo $this->memcached_library->getversion();
		echo "<br/>";
		
		// We can use any of the following "reset, malloc, maps, cachedump, slabs, items, sizes"
		$p = $this->memcached_library->getstats("sizes");
		
		var_dump($p);
	}
}