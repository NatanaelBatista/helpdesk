
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Usuário</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($visita as $row): ?>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="visita_empresa">Empresa</label>
                <select class="form-control" id="visita_empresa" name="visita_empresa" disabled>
                  <?php foreach ($empresa as $row_empresa): ?>
                  <option value="<?php echo $row_empresa->empresa_id; ?>"
                  <?php if($row->visita_empresa == $row_empresa->empresa_id){echo 'selected';} ?>>
                  <font><?php echo $row_empresa->empresa_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="incidente_data_a">Data</label>
            <input class="form-control" name="incidente_data_a" id="incidente_data_a" type="text" aria-describedby="nameHelp" value="<?php echo $row->visita_data; ?>" disabled>
          </div>
          <div class="form-group">
            <label for="visita_servico">Serviço Realizado</label>
            <textarea class="form-control" name="visita_servico" id="visita_servico" rows="5" placeholder="Insira a descrição" disabled><?php echo $row->visita_servico; ?></textarea>
          </div>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>