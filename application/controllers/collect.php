<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collect extends CI_Controller 
{
    private $sensor;
    private $check;
	/**
	* 初始化
	*
	* @access public
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sensor_model', 's');
		$this->load->model('check_model', 'c');
	}

	public function index()
	{
		$sid = (int)$this->uri->segment(2);
		$cid = (int)$this->uri->segment(3);

		$sid = (int)$this->input->get('sid');
		$cid = (int)$this->input->get('cid');

        // var_dump($sid);
        $this->sensor = $this->s->getSensor($sid);
        $this->check = $this->c->getCheck($cid);
        if ($this->sensor && $this->check)
            $this->do_check($this->sensor[0], $this->check[0]);
	}

    function do_check($sensor, $check) {
        $url = $sensor->url;
        $url.= '?u='.rawurlencode($check->url);
        $url.= '&s='.$sensor->id;
        $url.= '&c='.$check->id;

        $report = $this->do_collect($url);
        $data = unserialize($report);
        // $data = analysis($report);
        var_dump($data);
        die($url);


        $data = unserialize($report);
        // $data = analysis($report);
        var_dump($data);
    }

    function do_collect($url) {
        $ch = curl_init(); // create cURL handle (ch)
        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }

        $options = array
            (
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT => 'WWWBEEP Sensor'
             );
        curl_setopt_array($ch, $options);
        $server_output = curl_exec($ch);

        if(!curl_errno($ch)) {
            return $server_output;
        } else {
            die(curl_error($ch));
        }

        curl_close($ch);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */