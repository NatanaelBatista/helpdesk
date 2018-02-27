<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Configuracao
 *
 * @package helpdesk
 * @since 0.1
 */
class Configuracao extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption'));
        $this->load->model(array('configuracao_model'));
	}
    
    /**
     * alterar_senha
     *
     * @access public
     */
    public function alterar_senha()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }

        $data['title'] = 'Alterar senha';
        $data['err_form'] = '';
        $data['success'] = '';

        $config_form_validation = array(
            array(
                'field' => 'usuario_senha_a',
                'label' => 'Senha Antiga',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[6]|max_length[30]'
            ),
            array(
                'field' => 'usuario_senha',
                'label' => 'Senha',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[6]|max_length[30]'
            ),
            array(
                'field' => 'usuario_c_senha',
                'label' => 'Confirme a senha',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|matches[usuario_senha]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                $senha = $this->configuracao_model->get_usuario_senha($_SESSION['usuario_id']);

                if($this->encryption->decrypt($senha[0]->usuario_senha) == $_POST['usuario_senha_a'])
                {
                    $usuario_senha = $this->encryption->encrypt($_POST['usuario_senha']);

                    if($last_id = $this->configuracao_model->update_senha($usuario_senha, $_SESSION['usuario_id']))
                    {
                        $data['success'] = 'Senha alterada para <b style="color: #000;">'.$_POST['usuario_senha'].'</b>';
                    }
                    else
                    {
                        $data['err_form'] = 'Ocorreu um erro ao enviar os dados';
                    }
                }
                else
                {
                    $data['err_form'] = 'Senha antiga incorreta';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('configuracao/alterar_senha.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
}