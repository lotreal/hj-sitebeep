<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checks extends CI_Controller 
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

	public function index()
	{
		$data = array(
					'uid' => $this->session->userdata('uid'),
					'username' => $this->session->userdata('username'),
					'lastdate' => $this->session->userdata('lastdate'),
					'lastip' => $this->session->userdata('lastip'),
                    'overview' => $this->loadFromText(),
				);

		$this->load->view('checks/index', $data);
	}

    function loadFromText()
    {
        $dbfile = FCPATH.'a/db';
        if (file_exists($dbfile)) {
            $data = unserialize(file_get_contents($dbfile));
        } else {
            die('db error');
            $data = array();
        }
        // var_dump($data);        
        $overview = array();
        foreach($data as $site => $report) {
            $lc = $report['last_check'];
            $tdiff = time() - $lc['time'];
            $http_code = $lc['detail']['http_code'];
            $overview[$site] = array(
                'timestamp' => $tdiff.' 秒前',
                'http_code' => $http_code,
                'status' => $http_code == 200 ? '在线' : '离线',
                'location' => $lc['sensor']['name'],
                'detail' => $lc['detail'],
            );
        }
        return $overview;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */