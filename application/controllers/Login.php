<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login
 *
 * @package helpdesk
 * @since 0.1
 */
class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation', 'encryption'));
		$this->load->model('usuario_model');
	}

	/**
     * index
     *
     * @access public
     */
	public function index()
	{
		$data['title'] = 'Login';

		$data['err_form'] = '';

		$config_form_validation = array(
			array(
				'field' => 'login_email',
				'label' => 'E-mail',
				'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[50]|valid_email'
			),
			array(
				'field' => 'login_senha',
				'label' => 'Senha',
				'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[6]|max_length[30]'
			)
		);

		if(!empty($_POST))
		{
			$this->form_validation->set_rules($config_form_validation);

			if($this->form_validation->run())
			{
				if($usuario = $this->usuario_model->get_usuario_email($_POST['login_email']))
				{
					if($this->encryption->decrypt($usuario[0]->usuario_senha) == $_POST['login_senha'])
					{
						$_SESSION['logado'] = TRUE;
						$_SESSION['usuario_id'] = $usuario[0]->usuario_id;
						$_SESSION['usuario_email'] = $_POST['login_email'];
						$_SESSION['usuario_acesso'] = $usuario[0]->usuario_acesso;
						$_SESSION['usuario_p_nome'] = $usuario[0]->pessoa_p_nome;
						$_SESSION['usuario_empresa'] = $usuario[0]->pessoa_empresa;

						
						date_default_timezone_set('America/Sao_Paulo');

		                $_POST['incidente_data'] = date('Y-m-d');
		                $_POST['incidente_hora_a'] = date('Y-m-d H:i:s');
		                $_POST['incidente_usuario'] = $_SESSION['usuario_id'];

						$dados = array(
							'log_auditoria_data' => date('Y-m-d'),
							'log_auditoria_hora' => date('Y-m-d H:i:s'),
							'log_auditoria_usuario' => $_SESSION['usuario_id'],
							'log_auditoria_operacao' => 1,
							'log_auditoria_historico' => $_SERVER['REMOTE_ADDR']
							);

						if(! $this->log_model->set_log_auditoria($dados))
						{
							echo 'Ocorreu um erro ao salvar os dados, contate o administrador do sistema!';

							return;
						}

						redirect('home');
					}
					else
					{
						$data['err_form'] = 'Dados de login incorretos';
					}
				}
				else
				{
					$data['err_form'] = 'Dados de login incorretos';
				}
			}
			else
			{
				$data['err_form'] = validation_errors();
			}
		}

	$this->load->view('login/login.php', $data);

	}

	/**
     * logout
     *
     * @access public
     */
	public function logout()
	{
		session_destroy();

		date_default_timezone_set('America/Sao_Paulo');

        $_POST['incidente_data'] = date('Y-m-d');
        $_POST['incidente_hora_a'] = date('Y-m-d H:i:s');
        $_POST['incidente_usuario'] = $_SESSION['usuario_id'];

		$dados = array(
			'log_auditoria_data' => date('Y-m-d'),
			'log_auditoria_hora' => date('Y-m-d H:i:s'),
			'log_auditoria_usuario' => $_SESSION['usuario_id'],
			'log_auditoria_operacao' => 2,
			'log_auditoria_historico' => $_SERVER['REMOTE_ADDR']
			);

		if(! $this->log_model->set_log_auditoria($dados))
		{
			echo 'Ocorreu um erro ao salvar os dados, contate o administrador do sistema!';

			return;
		}

		redirect('login');
	}
}