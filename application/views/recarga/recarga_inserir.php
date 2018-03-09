
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
          <label for="impressora_recarga_impressora">Impressora</label>
          <select class="form-control" id="impressora_recarga_impressora" name="impressora_recarga_impressora">
            <?php foreach ($impressora as $row_impressora): ?>
            <option value="<?php echo $row_impressora->impressora_id; ?>">
            <font><?php echo $row_impressora->impressora_nome; ?></font></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="impressora_recarga_data">Data</label>
          <input class="form-control" name="impressora_recarga_data" id="impressora_recarga_data" type="date" aria-describedby="nameHelp">
        </div>
        <div class="form-group">
          <label for="impressora_recarga_obs">Observação</label>
          <textarea class="form-control" name="impressora_recarga_obs" id="impressora_recarga_obs" rows="3" placeholder="Insira uma observação"><?php echo set_value('impressora_recarga_obs'); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
      </form>
    </div>
  </div>
</div>