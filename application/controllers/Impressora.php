<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Impressora
 *
 * @package helpdesk
 * @since 0.1
 */
class Impressora extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption', 'pagination'));
        $this->load->model(array('impressora_model', 'empresa_model'));
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

        $data['title'] = 'Módulo';
        $data['err_form'] = '';
        //$data['impressora'] = $this->impressora_model->get_impressora();

        $config = array(
            'per_page' => 8,
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
        $config['base_url'] = base_url() . "impressora";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->impressora_model->get_num_impressora_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

        $data['impressora'] = $this->impressora_model->get_impressora_all('desc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('impressora/impressora.php', $data);
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

        $data['title'] = 'Módulo - inserir';
        $data['err_form'] = '';
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'impressora_nome',
                'label' => 'Nome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|is_unique[impressora.impressora_nome]'
            ),
            array(
                'field' => 'impressora_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->impressora_model->set_impressora($_POST))
                {
                    redirect('impressora');
                }
                else
                {
                    $data['err_form'] = 'Ocorreu um erro ao enviar OS dados';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('impressora/impressora_inserir.php', $data);
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

        $data['title'] = 'Módulo - editar';
        $data['err_form'] = '';
        $data['impressora'] = $this->impressora_model->get_impressora($id);
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'impressora_nome',
                'label' => 'Nome',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|callback_check_exists[$id]"
            ),
            array(
                'field' => 'impressora_empresa',
                'label' => 'Empresa',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required"
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->impressora_model->update_impressora($_POST, $id))
                {
                    redirect('impressora');
                }
                else
                {
                    $data['err_form'] = 'Ocorreu um erro ao enviar OS dados';
                }
            }
            else
            {
                $data['err_form'] = validation_errors();
            }
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('impressora/impressora_editar.php', $data);
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

        if(!$this->impressora_model->get_impressora_nome_exists($param_1, $id) == 0)
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