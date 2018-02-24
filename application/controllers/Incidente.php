<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cargo
 *
 * @package helpdesk
 * @since 0.1
 */
class Incidente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
        $this->load->library(array('form_validation', 'pagination', 'email'));
        $this->load->model(array('incidente_model', 'categoria_model', 'prioridade_model', 'situacao_model', 'empresa_model'));
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

        $data['title'] = 'incidente';
        $data['err_form'] = '';
        $data['incidente'] = $this->incidente_model->get_incidente();
        $data['categoria'] = $this->categoria_model->get_categoria();
        $data['prioridade'] = $this->prioridade_model->get_prioridade();
        $data['situacao'] = $this->situacao_model->get_situacao();
        $data['empresa'] = $this->empresa_model->get_empresa();

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

        if(isset($_POST['incidente_situacao']) || $this->session->flashdata('incidente_situacao') != NULL)
        {
            if(isset($_POST['incidente_situacao']))
            {
                $_SESSION['incidente_situacao'] = $_POST['incidente_situacao'];
                $_SESSION['incidente_categoria'] = $_POST['incidente_categoria'];
                $_SESSION['incidente_prioridade'] = $_POST['incidente_prioridade'];
                $_SESSION['incidente_data_a'] = $_POST['incidente_data_a'];
                $_SESSION['incidente_data_c'] = $_POST['incidente_data_c'];

                $this->session->mark_as_flash(array(
                    'incidente_situacao',
                    'incidente_categoria',
                    'incidente_prioridade',
                    'incidente_data_a',
                    'incidente_data_c'
                ));
            }

            $dados = $this->session->flashdata();

            // url da página na qual será feira a paginação
            $config['base_url'] = base_url() . "incidente";

            // total de linhas retornadas na consulta ao database
            $config['total_rows'] = $this->incidente_model->get_num_search_incidente_all($dados);

            $this->pagination->initialize($config);

            // cria os links da paginação
            $data['pagination'] = $this->pagination->create_links();

            // seguimentos após o endereço principal
            $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

            $data['incidente'] = $this->incidente_model->get_search_incidente_all('desc', $config['per_page'], $offset, $dados);

            $this->session->keep_flashdata(array(
                'incidente_situacao',
                'incidente_categoria',
                'incidente_prioridade',
                'incidente_data_a',
                'incidente_data_c'
              ));
        }
        else
        {
            // url da página na qual será feira a paginação
            $config['base_url'] = base_url() . "incidente";

            // total de linhas retornadas na consulta ao database
            $config['total_rows'] = $this->incidente_model->get_num_incidente_all();

            $this->pagination->initialize($config);

            // cria os links da paginação
            $data['pagination'] = $this->pagination->create_links();

            // seguimentos após o endereço principal
            $offset = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

            $data['incidente'] = $this->incidente_model->get_incidente_all('desc', $config['per_page'], $offset);
        }

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('incidente/incidente.php', $data);
        $this->load->view('templates/footer.php', $data);
    }

    /**
     * pendentes
     *
     * @access public
     */
    public function pendentes()
    {
        if($_SESSION['logado'] != TRUE)
        {
            redirect('login');
        }

        $data['title'] = 'incidente';
        $data['err_form'] = '';
        $data['incidente'] = $this->incidente_model->get_incidente();
        $data['categoria'] = $this->categoria_model->get_categoria();
        $data['prioridade'] = $this->prioridade_model->get_prioridade();
        $data['situacao'] = $this->situacao_model->get_situacao();
        $data['empresa'] = $this->empresa_model->get_empresa();

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
        $config['base_url'] = base_url() . "incidente/pendentes";

        // total de linhas retornadas na consulta ao database
        $config['total_rows'] = $this->incidente_model->get_num_incidente_p_all();

        $this->pagination->initialize($config);

        // cria os links da paginação
        $data['pagination'] = $this->pagination->create_links();

        // seguimentos após o endereço principal
        $offset = ($this->uri->segment(3) ? $this->uri->segment(3) : 0);

        $data['incidente'] = $this->incidente_model->get_incidente_p_all('desc', $config['per_page'], $offset);

        $this->load->view('templates/header.php', $data);
        $this->load->view('templates/nav.php', $data);
        $this->load->view('incidente/incidente.php', $data);
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

        $data['title'] = 'incidente';
        $data['err_form'] = '';
        $data['incidente'] = $this->incidente_model->get_incidente($id);
        $data['incidente_nota'] = $this->incidente_model->get_incidente_nota($id);
        $data['categoria'] = $this->categoria_model->get_categoria();
        $data['prioridade'] = $this->prioridade_model->get_prioridade();
        $data['empresa'] = $this->empresa_model->get_empresa();
        $data['situacao'] = $this->situacao_model->get_situacao();

        $config_form_validation = array(
            array(
                'field' => 'incidente_nota_descricao',
                'label' => 'Nota',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|min_length[3]|max_length[250]'
            )
        );

        foreach ($data['incidente'] as $row)
        {
            $usuario_acesso = $row->usuario_acesso;
            $usuario_email = $row->usuario_email;
            $usuario_nome = $row->pessoa_p_nome;
            $incidente_id = $row->incidente_id;
        }

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                date_default_timezone_set('America/Sao_Paulo');

                $_POST['incidente_nota_incidente'] = $id;
                $_POST['incidente_nota_hora'] = date('Y-m-d H:i:s');
                $_POST['incidente_nota_usuario'] = $_SESSION['usuario_id'];

                if($last_id = $this->incidente_model->set_incidente_nota($_POST))
                {
                    /*
                    if($_SESSION['usuario_acesso'] != 2)
                    {
                        $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                        $this->email->to('ti@yamahamotofacil.com');
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->set_mailtype("html");

                        $this->email->subject("Incidente $incidente_id - $usuario_nome");
                        $this->email->message($_POST['incidente_nota_descricao']);

                        $this->email->send();
                    }
                    elseif($_SESSION['usuario_acesso'] == 2)
                    {
                        $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                        $this->email->to($usuario_email);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->set_mailtype("html");

                        $message = '<h2>Help Desk Motofácil</h2>
                        <b>'.$_SESSION['usuario_p_nome'].' respondeu: </b>'.$_POST['incidente_nota_descricao'];

                        $this->email->subject("Resposta ao Incidente $incidente_id");
                        $this->email->message($message);

                        $this->email->send();

                        $this->incidente_model->update_incidente_situacao(2, $id);
                    }
                    */

                    redirect("incidente/visualizar/$id");
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
        $this->load->view('incidente/incidente_visualizar.php', $data);
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

        $data['title'] = 'incidente';
        $data['err_form'] = '';
        $data['categoria'] = $this->categoria_model->get_categoria();
        $data['prioridade'] = $this->prioridade_model->get_prioridade();
        $data['situacao'] = $this->situacao_model->get_situacao();
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'incidente_categoria',
                'label' => 'Categoria',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_prioridade',
                'label' => 'Prioridade',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_titulo',
                'label' => 'Título',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'incidente_descricao',
                'label' => 'Descrição',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[250]'
            )
        );

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                date_default_timezone_set('America/Sao_Paulo');

                $_POST['incidente_data_a'] = date('Y-m-d');
                $_POST['incidente_hora_a'] = date('Y-m-d H:i:s');
                $_POST['incidente_usuario'] = $_SESSION['usuario_id'];

                /*
                $config['upload_path']          = './uploads/anexos/';
                $config['allowed_types']        = 'pdf|jpg|png|docx';
                $config['max_size']             = 200;
                $config['max_width']            = 2048;
                $config['max_height']           = 1536;

                $this->load->library('upload', $config);

                if( $this->upload->do_upload('incidente_anexo'))
                {
                    var_dump($this->upload->file_name);
                    //echo 'aew';
                }
                */

                if($last_id = $this->incidente_model->set_incidente($_POST))
                {
                    /*
                    if($_SESSION['usuario_acesso'] != 2)
                    {
                        $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                        $this->email->to('ti@yamahamotofacil.com');
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->set_mailtype("html");

                        $message = '<b>Título: </b>'.$_POST['incidente_titulo'].'<br><b>Descrição:</b><br>'.$_POST['incidente_descricao'];

                        $this->email->subject('Novo Incidente de '.$_SESSION['usuario_p_nome']);
                        $this->email->message($message);

                        $this->email->send();
                    }
                    */

                    redirect('incidente');
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
        $this->load->view('incidente/incidente_inserir.php', $data);
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
            redirect('incidente');
        }

        $data['title'] = 'incidente';
        $data['err_form'] = '';
        $data['incidente'] = $this->incidente_model->get_incidente($id);
        $data['incidente_nota'] = $this->incidente_model->get_incidente_nota($id);
        $data['categoria'] = $this->categoria_model->get_categoria();
        $data['prioridade'] = $this->prioridade_model->get_prioridade();
        $data['situacao'] = $this->situacao_model->get_situacao();
        $data['empresa'] = $this->empresa_model->get_empresa();

        $config_form_validation = array(
            array(
                'field' => 'incidente_categoria',
                'label' => 'Categoria',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_prioridade',
                'label' => 'Prioridade',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_empresa',
                'label' => 'Empresa',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric'
            ),
            array(
                'field' => 'incidente_titulo',
                'label' => 'Título',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[45]'
            ),
            array(
                'field' => 'incidente_descricao',
                'label' => 'Descrição',
                'rules' => 'trim|stripslashes|htmlspecialchars|encode_php_tags|required|min_length[3]|max_length[250]'
            ),
            array(
                'field' => 'incidente_situacao',
                'label' => 'Situacao',
                'rules' => "trim|stripslashes|htmlspecialchars|encode_php_tags|required|is_numeric"
            )
        );

        foreach ($data['incidente'] as $row)
        {
            $usuario_email = $row->usuario_email;
            $incidente_id = $row->incidente_id;
            $incidente_titulo = $row->incidente_titulo;
            $incidente_descricao = $row->incidente_descricao;
            $incidente_hora_a = $row->incidente_hora_a;
            $incidente_hora_c = $row->incidente_hora_c;  
        }

        if(!empty($_POST))
        {
            $this->form_validation->set_rules($config_form_validation);

            if($this->form_validation->run())
            {
                foreach($data['situacao'] as $row)
                {
                    if($row->situacao_id == $_POST['incidente_situacao'])
                    {
                        $incidente_situacao = $row->situacao_nome;
                    }
                }

                date_default_timezone_set('America/Sao_Paulo');

                $_POST['incidente_data_a'] = date('Y-m-d');
                $_POST['incidente_hora_a'] = date('Y-m-d H:i:s');
                $_POST['incidente_usuario'] = $_SESSION['usuario_id'];

                if($_POST['incidente_nota_descricao'] != '')
                {
                    $_POST['incidente_nota_incidente'] = $id;
                    $_POST['incidente_nota_hora'] = date('Y-m-d H:i:s');
                    $_POST['incidente_nota_usuario'] = $_SESSION['usuario_id'];

                    if($last_id = $this->incidente_model->set_incidente_nota($_POST))
                    {
                        /*
                        if($_SESSION['usuario_acesso'] != 2)
                        {
                            $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                            $this->email->to('ti@yamahamotofacil.com');
                            $this->email->cc('');
                            $this->email->bcc('');

                            $this->email->set_mailtype("html");

                            $this->email->subject("Incidente $incidente_id - $usuario_nome");
                            $this->email->message($_POST['incidente_nota_descricao']);

                            $this->email->send();
                        }
                        elseif($_SESSION['usuario_acesso'] == 2)
                        {
                            $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                            $this->email->to($usuario_email);
                            $this->email->cc('');
                            $this->email->bcc('');

                            $this->email->set_mailtype("html");

                            $message = '<h2>Help Desk Motofácil</h2>
                            <b>'.$_SESSION['usuario_p_nome'].' respondeu: </b>'.$_POST['incidente_nota_descricao'];

                            $this->email->subject("Resposta ao Incidente $incidente_id");
                            $this->email->message($message);

                            $this->email->send();
                        }
                        */

                        //$this->incidente_model->update_incidente_situacao(2, $id);

                        redirect("incidente/editar/$id");
                    }
                    else
                    {
                        $data['err_form'] = 'Ocorreu um erro ao enviar os dados';
                    }
                }

                if($last_id = $this->incidente_model->update_incidente($_POST, $id))
                {
                    /*
                    if(($_POST['incidente_situacao'] == 3) || ($_POST['incidente_situacao'] == 4))
                    {
                        $this->email->from('ti@yamahamotofacil.com', 'Help Desk Motofácil');
                        $this->email->to($usuario_email);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->set_mailtype("html");

                        $message1 = '<h2>Help Desk Motofácil</h2>
                        <b>Código: </b>'.$incidente_id.'<br>
                        <b>Título: </b>'.$incidente_titulo.'<br>
                        <b>Data de abertura: </b>'.$incidente_hora_a.'<br>
                        <b>Data Conclusão: </b>'.$incidente_hora_c.'<br>
                        <b>Descrição:</b><br>'.$incidente_descricao;

                        $message2 = "<hr style='margin-top: 20px;'>";

                        foreach ($data['incidente_nota'] as $row_incidente_nota):
                          $message2 .= "<small style='font-size: 9pt;'>".$row_incidente_nota->incidente_nota_hora." | <b>".$row_incidente_nota->pessoa_p_nome."</b></small>
                          <p style='margin-left: 20px; margin-top: 0px;'>".$row_incidente_nota->incidente_nota_descricao."</p>";
                        endforeach;

                        $message = $message1.$message2;

                        $this->email->subject("Incidente ".$incidente_id." alterado para ".$incidente_situacao);
                        $this->email->message($message);

                        $this->email->send();
                    }
                    */

                    redirect('incidente');
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
        $this->load->view('incidente/incidente_editar.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
}