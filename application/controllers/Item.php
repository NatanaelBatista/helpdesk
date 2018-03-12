<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Item
 *
 * @package helpdesk
 * @since 0.1
 */
class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption', 'pagination'));
        $this->load->model(array('item_model', 'tipo_item_model'));
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
        //$data['item'] = $this->item_model->get_item();

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
        $config['base_url'] = base_url() . "item";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->item_model->get_num_item_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

        $data['item'] = $this->item_model->get_item_all('desc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('item/item.php', $data);
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
        $data['tipo_item'] = $this->tipo_item_model->get_tipo_item();

        $config_form_validation = array(
            array(
                'field' => 'item_nome',
                'label' => 'Nome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|is_unique[item.item_nome]'
            ),
            array(
                'field' => 'item_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->item_model->set_item($_POST))
                {
                    redirect('item');
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
        $this->load->view('item/item_inserir.php', $data);
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
        $data['item'] = $this->item_model->get_item($id);
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'item_nome',
                'label' => 'Nome',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|callback_check_exists[$id]"
            ),
            array(
                'field' => 'item_empresa',
                'label' => 'Empresa',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required"
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->item_model->update_item($_POST, $id))
                {
                    redirect('item');
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
        $this->load->view('item/item_editar.php', $data);
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

        if(!$this->item_model->get_item_nome_exists($param_1, $id) == 0)
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