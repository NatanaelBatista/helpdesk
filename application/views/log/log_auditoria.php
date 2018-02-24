
<div class="col-lg-12">
  <div class="col-12">
    <div class="table-responsive row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Usuário</th>
            <th>Operação</th>
            <th>Histórico</th>
          </tr>
        </thead>

        <?php foreach ($log_auditoria as $row): ?>

        <tbody>
          <tr>
            <td></td>
            <td><?php echo $row->log_auditoria_id; ?></td>
            <td><?php echo $row->log_auditoria_data; ?></td>
            <td><?php echo $row->log_auditoria_hora; ?></td>
            <td><?php echo $row->usuario_email; ?></td>
            <td><?php echo $row->operacao_nome; ?></td>
            <td><?php echo $row->log_auditoria_historico; ?></td>
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