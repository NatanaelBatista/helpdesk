
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Recarga</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($impressora_recarga as $row): ?>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="impressora_recarga_impressora">Impressora</label>
                <select class="form-control" id="impressora_recarga_impressora" name="impressora_recarga_impressora">
                  <?php foreach ($impressora as $row_impressora): ?>
                  <option value="<?php echo $row_impressora->impressora_id; ?>"
                  <?php if($row->impressora_recarga_impressora == $row_impressora->impressora_id){echo 'selected';} ?>>
                  <font><?php echo $row_impressora->impressora_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="impressora_recarga_data">Data</label>
            <input class="form-control" name="impressora_recarga_data" id="impressora_recarga_data" type="date" aria-describedby="nameHelp" value="<?php echo $row->impressora_recarga_data; ?>">
          </div>
          <div class="form-group">
            <label for="impressora_recarga_obs">Observação</label>
            <textarea class="form-control" name="impressora_recarga_obs" id="impressora_recarga_obs" rows="5" placeholder="Insira uma observação"><?php echo $row->impressora_recarga_obs; ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>