
<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Inserir Usuário</div>
    <div class="card-body">
      <!-- Exibe mensagem de erro -->
      <?php if($err_form != ''): ?>
      <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p><?php echo $err_form; ?></p>
      </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="visita_empresa">empresa</label>
          <select class="form-control" id="visita_empresa" name="visita_empresa">
            <?php foreach ($empresa as $row_empresa): ?>
            <option value="<?php echo $row_empresa->empresa_id; ?>">
            <font><?php echo $row_empresa->empresa_nome; ?></font></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="visita_data">Data</label>
          <input class="form-control" name="visita_data" id="visita_data" type="date" aria-describedby="nameHelp">
        </div>
        <div class="form-group">
          <label for="visita_servico">Serviço Realizado</label>
          <textarea class="form-control" name="visita_servico" id="visita_servico" rows="5" placeholder="Insira a descrição"><?php echo set_value('visita_servico'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
      </form>
    </div>
  </div>
</div>