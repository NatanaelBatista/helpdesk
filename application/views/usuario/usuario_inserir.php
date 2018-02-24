
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
          <label for="usuario_pessoa">Pessoa</label>
          <select class="form-control" id="usuario_pessoa" name="usuario_pessoa">
            <?php foreach ($pessoa as $row_pessoa): ?>
            <option value="<?php echo $row_pessoa->pessoa_id; ?>">
            <font><?php echo $row_pessoa->pessoa_p_nome.' '.$row_pessoa->pessoa_sobrenome; ?></font></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="usuario_acesso">Acesso</label>
          <select class="form-control" id="usuario_acesso" name="usuario_acesso">
            <?php foreach ($acesso as $row_acesso): ?>
            <option value="<?php echo $row_acesso->acesso_id; ?>">
            <font><?php echo $row_acesso->acesso_nome; ?></font></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="usuario_email">Email</label>
          <input class="form-control" name="usuario_email" id="usuario_email" type="email" aria-describedby="emailHelp" placeholder="Insira o email">
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="usuario_senha">Senha</label>
              <input class="form-control" name="usuario_senha" id="usuario_senha" type="password" placeholder="Insira a senha">
            </div>
            <div class="col-md-6">
              <label for="usuario_c_senha">Confirme a Senha</label>
              <input class="form-control" name="usuario_c_senha" id="usuario_c_senha" type="password" placeholder="Confirme a senha">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label><input type="checkbox" name="usuario_ativo" checked=""> Ativo</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
      </form>
    </div>
  </div>
</div>