
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Inserir Impressora</div>
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
            <div class="form-row">
              <div class="col-md-6">
                <label for="impressora_nome">Nome</label>
                <input class="form-control" name="impressora_nome" id="impressora_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo set_value('impressora_nome'); ?>">
              </div>
              <div class="col-md-6">
                <label for="impressora_empresa">Empresa</label>
                <select class="form-control" id="impressora_empresa" name="impressora_empresa">
                  <?php foreach ($empresa as $row_empresa): ?>
                  <?php if($row_empresa->empresa_id != 1): ?>
                  <option value="<?php echo $row_empresa->empresa_id; ?>">
                  <font><?php echo $row_empresa->empresa_nome; ?></font></option>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="impressora_modelo">Modelo</label>
            <input class="form-control" name="impressora_modelo" id="impressora_modelo" type="text" aria-describedby="nameHelp" placeholder="Insira o modelo" value="<?php echo set_value('impressora_modelo'); ?>">
          </div>
          <div class="form-group">
            <label for="impressora_descricao">Descrição</label>
            <textarea class="form-control" name="impressora_descricao" id="impressora_descricao" rows="3" placeholder="Insira a descrição"><?php echo set_value('impressora_descricao'); ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="impressora_ativo" checked> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        </form>
      </div>
    </div>
  </div>