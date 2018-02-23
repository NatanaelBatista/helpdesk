<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pessoa
 *
 * @package helpdesk
 * @since 0.1
 */
class Pessoa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('pessoa_model', 'empresa_model', 'cargo_model'));
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

        $data['title'] = 'pessoa';
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
        $config['base_url'] = base_url() . "pessoa";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->pessoa_model->get_num_pessoa_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

        $data['pessoa'] = $this->pessoa_model->get_pessoa_all('asc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('pessoa/pessoa.php', $data);
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

        $data['title'] = 'pessoa';
        $data['err_form'] = '';
        $data['cargo'] = $this->cargo_model->get_cargo();
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'pessoa_p_nome',
                'label' => 'Primeiro nome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'pessoa_sobrenome',
                'label' => 'Sobrenome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'pessoa_cargo',
                'label' => 'Cargo',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'pessoa_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->pessoa_model->set_pessoa($_POST))
                {
                    redirect('pessoa');
                }
                else
                {
                    $data['err_form'] = 'Ocorreu um erro ao enviar os dados';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('pessoa/pessoa_inserir.php', $data);
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

        $data['title'] = 'pessoa';
        $data['err_form'] = '';
        $data['pessoa'] = $this->pessoa_model->get_pessoa($id);
        $data['cargo'] = $this->cargo_model->get_cargo();
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'pessoa_p_nome',
                'label' => 'Primeiro nome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'pessoa_sobrenome',
                'label' => 'Sobrenome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'pessoa_cargo',
                'label' => 'Cargo',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'pessoa_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->pessoa_model->update_pessoa($_POST, $id))
                {
                    redirect('pessoa');
                }
                else
                {
                    $data['err_form'] = 'Ocorreu um erro ao enviar os dados';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('pessoa/pessoa_editar.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /*
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

        if(!$this->pessoa_model->get_pessoa_nome_exists($param_1, $id) == 0)
        {
            $this->form_validation->set_message('check_exists', 'Já existe um(a) {field} com esse valor');
            
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    */
}