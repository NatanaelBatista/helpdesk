
<div class="col-lg-12">
  <div class="col-12">
    <div class="table-responsive row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th><a href="<?php echo base_url(); ?>setor/inserir"><i class="fa fa-plus" style="font-size:24px;color:green"></i></a></th>
            <th>Ativo</th>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
          </tr>
        </thead>

        <?php foreach ($setor as $row): ?>

        <tbody>
          <tr>
            <td>
              <a href="<?php echo base_url(); ?>setor/editar/<?php echo $row->setor_id; ?>"><i class="fa fa-pencil-square-o" style="color:red"></i></a>
            </td>
            <td><input type="checkbox" disabled="" <?php if($row->setor_ativo == 1){ echo 'checked'; } ?>></td>
            <td><?php echo $row->setor_id; ?></td>
            <td><?php echo $row->setor_nome; ?></td>
            <td><?php echo $row->setor_descricao; ?></td>
          </tr>
        </tbody>

        <?php endforeach ?>

      </table>
    </div>
  </div>
</div>
