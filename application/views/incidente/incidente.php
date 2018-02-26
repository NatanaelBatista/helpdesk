
<div class="col-lg-12">
  <form action="<?php echo base_url(); ?>incidente" method="post">
    <div class="col-12">
      <div class="table-responsive row">
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px">
          <div class="form-group">
            <label for="incidente_situacao">Situacao</label>
            <select class="form-control" id="incidente_situacao" name="incidente_situacao">
              <option value="0"></option>
              <?php foreach ($situacao as $row_situacao): ?>
              <option value="<?php echo $row_situacao->situacao_id; ?>"
              <?php if($this->session->flashdata('incidente_situacao') == $row_situacao->situacao_id){echo 'selected';} ?>>
              <font><?php echo $row_situacao->situacao_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-3 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <label for="incidente_categoria">Categoria</label>
            <select class="form-control" id="incidente_categoria" name="incidente_categoria">
              <option value="0"></option>
              <?php foreach ($categoria as $row_categoria): ?>
              <option value="<?php echo $row_categoria->categoria_id; ?>"
              <?php if($this->session->flashdata('incidente_categoria') == $row_categoria->categoria_id){echo 'selected';} ?>>
              <font><?php echo $row_categoria->categoria_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <label for="incidente_prioridade">Prioridade</label>
            <select class="form-control" id="incidente_prioridade" name="incidente_prioridade">
              <option value="0"></option>
              <?php foreach ($prioridade as $row_prioridade): ?>
              <option value="<?php echo $row_prioridade->prioridade_id; ?>"
              <?php if($this->session->flashdata('incidente_prioridade') == $row_prioridade->prioridade_id){echo 'selected';} ?>>
              <font><?php echo $row_prioridade->prioridade_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <?php date_default_timezone_set('America/Sao_Paulo'); ?>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <label for="incidente_data_a">Data inicio</label>
            <input class="form-control" name="incidente_data_a" id="incidente_data_a" type="date" aria-describedby="nameHelp" value="<?php echo $this->session->flashdata('incidente_data_a') != NULL ? $this->session->flashdata('incidente_data_a') : date('Y-m-d') ?>" style="padding: 6px;">
          </div>
        </div>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <label for="incidente_data_c">Data fim</label>
            <input class="form-control" name="incidente_data_c" id="incidente_data_c" type="date" aria-describedby="nameHelp" value="<?php echo $this->session->flashdata('incidente_data_c') != NULL ? $this->session->flashdata('incidente_data_c') : date('Y-m-d') ?>" style="padding: 6px;" style="padding: 6px;">
          </div>
        </div>
        <div class="col-lg-1 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <label for="">&nbsp;</label>
            <button class="form-control" type="submit" aria-describedby="nameHelp"><i class="fa fa-search" style="font-size: "></i></button>
          </div>
        </div>
        <?php if($_SESSION['usuario_acesso'] == 2 || $_SESSION['usuario_acesso'] == 3): ?>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <button class="form-control" aria-describedby="nameHelp"><a style="display: block; color: #495057; text-decoration: none;" href="<?php echo base_url(); ?>incidente/pendentes">Pendentes</a></button>
          </div>
        </div>
      <?php endif; ?>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <button class="form-control" type="reset" aria-describedby="nameHelp">Limpar</button>
          </div>
        </div>
        <div class="col-lg-2 incident_search" style="padding: 0; padding-right: 10px;">
          <div class="form-group">
            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th><a href="<?php echo base_url(); ?>incidente/inserir"><i class="fa fa-plus" style="font-size:24px;color:green"></i></a>
              </th>
              <th>Código</th>
              <th>Situação</th>
              <th>Título</th>
              <th>Usuario</th>
              <th>Categoria</th>
              <!--<th>Prioridade</th>-->
              <th>Empresa</th>
              <!--<th>Data abertura</th>-->
            </tr>
          </thead>
          <tbody>

          <?php foreach ($incidente as $row): ?>

            <?php $title_str = 'Prioridade = '.$row->prioridade_nome.' | Data = '.$row->incidente_hora_a; ?>

            <tr title="<?php echo $title_str; ?>">
              <td>
                <a href="<?php echo base_url(); ?>incidente/visualizar/<?php echo $row->incidente_id; ?>"><i class="fa fa-eye" style="color: gray;"></i></a>&nbsp;
                <a href="<?php echo base_url(); ?>incidente/editar/<?php echo $row->incidente_id; ?>" class="gerencial"><i class="fa fa-pencil-square-o" style="color:red"></i></a>
              </td>
              <td><?php echo $row->incidente_id; ?></td>
              <td>
                <span style="border-radius: 3px;padding: 0 8px; color: #fff; background-color:<?php echo $row->situacao_cor; ?>;">
                <?php echo $row->situacao_nome; ?></span>
              </td>
              <td><?php echo $row->incidente_titulo; ?></td>
              <td><?php echo $row->pessoa_p_nome; ?></td>
              <td><?php echo $row->categoria_nome; ?></td>
              <!--<td><?php //echo $row->prioridade_nome; ?></td>-->
              <td><?php echo $row->empresa_nome; ?></td>
              <!--<td><?php //echo $row->incidente_hora_a; ?></td>-->
            </tr>
            
          <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </form>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<hr />
<div class="col-sm-12 col-md-4" style="margin: auto;">
  <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
    <?php echo $pagination; ?>
  </div>
</div>
<br />