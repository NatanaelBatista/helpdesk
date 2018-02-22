<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        //if($_SESSION['logado'] != TRUE)
        //{
         //   redirect('login');
        //}

        $data['title'] = 'Home';
        $data['err_form'] = '';

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('home/home.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
}