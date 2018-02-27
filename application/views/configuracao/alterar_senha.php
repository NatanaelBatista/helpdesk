<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Alterar Senha</div>
    <div class="card-body">
      <!-- Exibe mensagem de sucesso -->
      <?php if($success != ''): ?>
      <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p><?php echo $success; ?></p>
      </div>
      <?php endif; ?>
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
              <label for="usuario_senha_a">Senha Antiga</label>
              <input class="form-control" name="usuario_senha_a" id="usuario_senha_a" type="password" placeholder="Insira a senha antiga" autofocus>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="usuario_senha">Nova Senha</label>
              <input class="form-control" name="usuario_senha" id="usuario_senha" type="password" placeholder="Insira a senha">
            </div>
            <div class="col-md-6">
              <label for="usuario_c_senha">Confirme a Senha</label>
              <input class="form-control" name="usuario_c_senha" id="usuario_c_senha" type="password" placeholder="Confirme a senha">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
      </form>
    </div>
  </div>
</div>