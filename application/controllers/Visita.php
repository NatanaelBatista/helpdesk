<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Visita
 *
 * @package helpdesk
 * @since 0.1
 */
class Visita extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'pagination'));
        $this->load->model(array('visita_model', 'empresa_model'));
	}

    /**
     * auditoria
     *
     * @access public
     */
    public function index()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif(!($_SESSION['usuario_acesso'] == 2 || $_SESSION['usuario_acesso'] == 3))
        {
            redirect('home');
        }

        $data['title'] = 'Visitas a filiais';
        $data['err_form'] = '';

        $config = array(
            'per_page' => 10,
            'uri_segment' => 3,
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
        $config['base_url'] = base_url() . "visita";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->visita_model->get_num_visita_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(3) ? $this->uri->segment(3) : 0);

        $data['visita'] = $this->visita_model->get_visita_all('desc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('visita/visita.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /**
     * visualizar
     *
     * @access public
     */
    public function visualizar($id)
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }
        elseif(!($_SESSION['usuario_acesso'] == 2 || $_SESSION['usuario_acesso'] == 3))
        {
            redirect('home');
        }

        $data['title'] = 'Visitas a filiais';
        $data['err_form'] = '';
        $data['visita'] = $this->visita_model->get_visita($id);
        $data['empresa'] = $this->empresa_model->get_empresa();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('visita/visita_visualizar.php', $data);
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
            $_SESSION['err'] = "Acesso negado!";
            $this->session->mark_as_flash('err');

            redirect('visita');
        }

        $data['title'] = 'visita';
        $data['err_form'] = '';
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'visita_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'visita_data',
                'label' => 'Data',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required'
            ),
            array(
                'field' => 'visita_servico',
                'label' => 'Serviço Realizado',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[1000]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->visita_model->set_visita($_POST))
                {
                    redirect('visita');
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
        $this->load->view('visita/visita_inserir.php', $data);
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
            $_SESSION['err'] = "Acesso negado!";
            $this->session->mark_as_flash('err');

            redirect('visita');
        }

        $data['title'] = 'visita';
        $data['err_form'] = '';
        $data['visita'] = $this->visita_model->get_visita($id);
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'visita_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'visita_data',
                'label' => 'Data',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required'
            ),
            array(
                'field' => 'visita_servico',
                'label' => 'Serviço Realizado',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[1000]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->visita_model->update_visita($_POST, $id))
                {
                    redirect('visita');
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
        $this->load->view('visita/visita_editar.php', $data);
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

        if(!$this->visita_model->get_visita_nome_exists($param_1, $id) == 0)
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