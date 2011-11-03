<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checks extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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

        foreach($data as $site => $report) {
            $lc = $report['last_check'];
            $tdiff = time() - $lc['time'];
            
            $report['rp_sum'] = "{$site}: ". ($report['last_check']['status'] == 200 ? '在线' : '离线'). "<p>上次检测：{$lc['id']} 在 {$tdiff} 秒前通过 {$lc['type']} 方式检测。</p>";
        }
        return $data;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */