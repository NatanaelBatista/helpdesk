
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Pessoa</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($pessoa as $row): ?>
          <div class="form-group">
            <label for="pessoa_p_nome">Nome</label>
            <input class="form-control" name="pessoa_p_nome" id="pessoa_p_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo $row->pessoa_p_nome; ?>" autofocus>
          </div>
          <div class="form-group">
            <label for="pessoa_sobrenome">Sobrenome</label>
            <input class="form-control" name="pessoa_sobrenome" id="pessoa_sobrenome" type="text" aria-describedby="nameHelp" placeholder="Insira o sobrenome" value="<?php echo $row->pessoa_sobrenome; ?>">
          </div>
          <div class="form-group">
            <label for="pessoa_cargo">Cargo</label>
            <select class="form-control" id="pessoa_cargo" name="pessoa_cargo">
              <?php foreach ($cargo as $row_cargo): ?>
              <option value="<?php echo $row_cargo->cargo_id; ?>"
              <?php if($row->pessoa_cargo == $row_cargo->cargo_id){echo 'selected';} ?>>
              <font><?php echo $row_cargo->cargo_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="pessoa_empresa">Empresa</label>
            <select class="form-control" id="pessoa_empresa" name="pessoa_empresa">
              <?php foreach ($empresa as $row_empresa): ?>
              <option value="<?php echo $row_empresa->empresa_id; ?>"
              <?php if($row->pessoa_empresa == $row_empresa->empresa_id){echo 'selected';} ?>>
              <font><?php echo $row_empresa->empresa_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="pessoa_ativo" <?php if($row->pessoa_ativo == 1){ echo 'checked'; } ?>> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>