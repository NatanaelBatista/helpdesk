
<div class="col-lg-12">
  <?php if(isset($_SESSION['err'])): ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><?php echo $_SESSION['err']; ?></p>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <div class="table-responsive row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><a href="<?php echo base_url(); ?>recarga/inserir"><i class="fa fa-plus" style="font-size:24px;color:green"></i></a></th>
            <th>ID</th>
            <th>Impressora</th>
            <th>Data</th>
            <th>Observação</th>
          </tr>
        </thead>

        <?php foreach ($recarga as $row): ?>

        <tbody>
          <tr>
            <td>
              <a href="<?php echo base_url(); ?>recarga/visualizar/<?php echo $row->impressora_recarga_id; ?>"><i class="fa fa-eye" style="color: gray;"></i></a>&nbsp;
              <a href="<?php echo base_url(); ?>recarga/editar/<?php echo $row->impressora_recarga_id; ?>"><i class="fa fa-pencil-square-o" style="color:red"></i></a>
            </td>
            <td><?php echo $row->impressora_recarga_id; ?></td>
            <td><?php echo $row->impressora_nome; ?></td>
            <td style="white-space: nowrap;"><?php echo $row->impressora_recarga_data; ?></td>
            <td><?php echo $row->impressora_recarga_obs; ?></td>
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
    <?php //echo $pagination; ?>
  </div>
</div>
<br />
