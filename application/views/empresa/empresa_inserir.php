
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Inserir Empresa</div>
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
            <label for="empresa_nome">Nome</label>
            <input class="form-control" name="empresa_nome" id="empresa_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo set_value('empresa_nome'); ?>">
          </div>
          <div class="form-group">
            <label for="empresa_descricao">Descrição</label>
            <textarea class="form-control" name="empresa_descricao" id="empresa_descricao" rows="3" placeholder="Insira a descrição"><?php echo set_value('empresa_descricao'); ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="empresa_ativo" checked> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        </form>
      </div>
    </div>
  </div>