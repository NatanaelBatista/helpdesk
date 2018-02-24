<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pessoa
 *
 * @package helpdesk
 * @since 0.1
 */
class Log extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption'));
        $this->load->model(array('log_model'));
	}

    /**
     * auditoria
     *
     * @access public
     */
    public function auditoria()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif($_SESSION['usuario_acesso'] != 2)
        {
            redirect('home');
        }

        $data['title'] = 'Log - Auditoria';
        $data['err_form'] = '';
        $data['log_auditoria'] = $this->log_model->get_log_auditoria();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('log/log_auditoria.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
}