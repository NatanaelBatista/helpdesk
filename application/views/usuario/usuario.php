
<div class="col-lg-12">
  <?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><?php echo $_SESSION['success']; ?></p>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <div class="table-responsive row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><a href="<?php echo base_url(); ?>usuario/inserir"><i class="fa fa-plus" style="font-size:24px;color:green"></i></a></th>
            <th>Ativo</th>
            <th>ID</th>
            <th>Pessoa</th>
            <th>Email</th>
            <th>Acesso</th>
          </tr>
        </thead>

        <?php foreach ($usuario as $row): ?>

        <tbody>
          <tr>
            <td>
              <a href="<?php echo base_url(); ?>usuario/editar/<?php echo $row->usuario_id; ?>"><i class="fa fa-pencil-square-o" style="color:red"></i></a>
            </td>
            <td><input type="checkbox" disabled="" <?php if($row->usuario_ativo == 1){ echo 'checked'; } ?>></td>
            <td><?php echo $row->usuario_id; ?></td>
            <td><?php echo $row->pessoa_p_nome.' '.$row->pessoa_sobrenome; ?></td>
            <td><?php echo $row->usuario_email; ?></td>
            <td><?php echo $row->acesso_nome; ?></td>
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
