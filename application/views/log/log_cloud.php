
<div class="col-lg-12">
  <form action="<?php echo base_url(); ?>incidente" method="post">
    <div class="col-12">
      <div class="table-responsive row">
        <?php date_default_timezone_set('America/Sao_Paulo'); ?>
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

          <?php foreach ($incidente as $row): ?>

            <?php $title_str = 'Prioridade = '.$row->prioridade_nome.' | Data = '.$row->incidente_hora_a; ?>

          <tbody>
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
          </tbody>

          <?php endforeach ?>

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