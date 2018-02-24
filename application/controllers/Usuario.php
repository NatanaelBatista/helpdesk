<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pessoa
 *
 * @package helpdesk
 * @since 0.1
 */
class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption', 'pagination'));
        $this->load->model(array('usuario_model', 'pessoa_model', 'acesso_model'));
	}

    /**
     * index
     *
     * @access public
     */
    public function index()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif($_SESSION['usuario_acesso'] != 2)
        {
            redirect('home');
        }

        $data['title'] = 'Usuario';
        $data['err_form'] = '';

        $config = array(
            'per_page' => 10,
            'uri_segment' => 2,
            'full_tag_open' => '<ul class="pagination paginacao" style="margin: auto;">',
            'full_tag_close' => '</ul>',
            'first_link' => FALSE,
            'last_link' => FALSE,
            'first_tag_open' => '<li class="paginate_button page-item page-link">',
            'first_tag_close' => '</li>',
            'prev_link' => 'Anterior',
            'prev_tag_open' => '<li class="paginate_button page-item previous page-link" id="dataTable_previous">',
            'prev_tag_close' => '</li>',
            'next_link' => 'Próxima',
            'next_tag_open' => '<li class="paginate_button page-item next page-link" id="dataTable_next">',
            'next_tag_close' => '</li>',
            'last_tag_open' => '<li class="paginate_button page-item page-link">',
            'last_tag_close' => '</li>',
            'cur_tag_open' => '<li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li class="paginate_button page-item page-link">',
            'num_tag_close' => '</li>'
        );

        // url da página na qual será feira a paginação
        $config['base_url'] = base_url() . "usuario";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->usuario_model->get_num_usuario_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

        $data['usuario'] = $this->usuario_model->get_usuario_all('asc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('usuario/usuario.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /**
     * inserir
     *
     * @access public
     */
    public function inserir()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif($_SESSION['usuario_acesso'] != 2)
        {
            redirect('home');
        }

        $data['title'] = 'Usuario - inserir';
        $data['err_form'] = '';
        $data['pessoa'] = $this->pessoa_model->get_pessoa();
        $data['acesso'] = $this->acesso_model->get_acesso();

        $config_form_validation = array(
            array(
                'field' => 'usuario_pessoa',
                'label' => 'Pessoa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'usuario_acesso',
                'label' => 'Acesso',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'usuario_email',
                'label' => 'E-mail',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|valid_email|is_unique[usuario.usuario_email]'
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
                $_POST['usuario_senha'] = $this->encryption->encrypt($_POST['usuario_senha']);

                if($last_id = $this->usuario_model->set_usuario($_POST))
                {
                    redirect('usuario');
                }
                else
                {
                    echo 'Ocorreu um erro ao enviarmos dados';

                    return;
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('usuario/usuario_inserir.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /**
     * editar
     *
     * @access public
     */
    public function editar($id)
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif($_SESSION['usuario_acesso'] != 2)
        {
            redirect('home');
        }

        $data['title'] = 'Usuario - editar';
        $data['err_form'] = '';
        $data['usuario'] = $this->usuario_model->get_usuario($id);
        $data['pessoa'] = $this->pessoa_model->get_pessoa();
        $data['acesso'] = $this->acesso_model->get_acesso();

        $config_form_validation = array(
            array(
                'field' => 'usuario_pessoa',
                'label' => 'Pessoa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'usuario_acesso',
                'label' => 'Acesso',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'usuario_email',
                'label' => 'E-mail',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|valid_email|callback_check_exists[$id]"
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->usuario_model->update_usuario($_POST, $id))
                {
                    redirect('usuario');
                }
                else
                {
                    $data['err_form'] = 'Ocorreu um erro ao enviarmos dados';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('usuario/usuario_editar.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    public function redefinir_senha($id)
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }

        $data['title'] = 'Redefinir senha';
        $data['err_form'] = '';
        $data['success'] = '';

        $senha = $this->encryption->encrypt('motofacil');

        if($this->usuario_model->redefinir_senha($senha, $id))
        {
            redirect('usuario');
        }
        else
        {
            $data['err_form'] = 'Ocorreu um erro ao enviar os dados';
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('configuracao/alterar_senha.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /**
     * check_exists
     *
     * Método callbeck que verifica a existência de um valor indicado
     *
     * @access public
     * @param $param_1 string
     * @param int $id
     * @return boolean
     */
    public function check_exists($param_1, $id)
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif($_SESSION['usuario_acesso'] != 2)
        {
            redirect('home');
        }

        if(!$this->usuario_model->get_usuario_email_exists($param_1, $id) == 0)
        {
            $this->form_validation->set_message('check_exists', 'Já existe um(a) {field} com esse valor');
            
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}