
<div class="col-lg-12">
  <div class="col-12">
    <div class="table-responsive row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><a href="<?php echo base_url(); ?>pessoa/inserir"><i class="fa fa-plus" style="font-size:24px;color:green"></i></a></th>
            <th>Ativo</th>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Descrição</th>
          </tr>
        </thead>

        <?php foreach ($pessoa as $row): ?>

        <tbody>
          <tr>
            <td>
              <a href="<?php echo base_url(); ?>pessoa/editar/<?php echo $row->pessoa_id; ?>"><i class="fa fa-pencil-square-o" style="color:red"></i></a>
            </td>
            <td><input type="checkbox" disabled="" <?php if($row->pessoa_ativo == 1){ echo 'checked'; } ?>></td>
            <td><?php echo $row->pessoa_id; ?></td>
            <td><?php echo $row->pessoa_p_nome; ?></td>
            <td><?php echo $row->pessoa_sobrenome; ?></td>
            <td><?php echo $row->cargo_nome; ?></td>
            <td><?php echo $row->setor_nome; ?></td>
            <td><?php echo $row->empresa_nome; ?></td>
          </tr>
        </tbody>

        <?php endforeach ?>

      </table>
    </div>
  </div>
</div>

<hr />
<div class="col-sm-12 col-md-4" style="margin: auto;">
  <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
    <?php echo $pagination; ?>
  </div>
</div>
<br />