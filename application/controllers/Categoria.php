<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categoria
 *
 * @package helpdesk
 * @since 0.1
 */
class Categoria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'encryption'));
        $this->load->model(array('categoria_model'));
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

        $data['title'] = 'categoria';
        $data['err_form'] = '';
        $data['categoria'] = $this->categoria_model->get_categoria();

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('categoria/categoria.php', $data);
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

        $data['title'] = 'categoria';
        $data['err_form'] = '';

        $config_form_validation = array(
            array(
                'field' => 'categoria_nome',
                'label' => 'Nome',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|is_unique[categoria.categoria_nome]'
            ),
            array(
                'field' => 'categoria_descricao',
                'label' => 'Descrição',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|min_length[3]|max_length[250]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->categoria_model->set_categoria($_POST))
                {
                    redirect('categoria');
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
        $this->load->view('categoria/categoria_inserir.php', $data);
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

        $data['title'] = 'categoria';
        $data['err_form'] = '';
        $data['categoria'] = $this->categoria_model->get_categoria($id);

        $config_form_validation = array(
            array(
                'field' => 'categoria_nome',
                'label' => 'Nome',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]|callback_check_exists[$id]"
            ),
            array(
                'field' => 'categoria_descricao',
                'label' => 'Descrição',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|min_length[3]|max_length[250]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                if($last_id = $this->categoria_model->update_categoria($_POST, $id))
                {
                    redirect('categoria');
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
        $this->load->view('categoria/categoria_editar.php', $data);
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

        if(!$this->categoria_model->get_categoria_nome_exists($param_1, $id) == 0)
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