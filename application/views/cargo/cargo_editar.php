
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Cargo</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($cargo as $row): ?>
          <div class="form-group">
            <label for="cargo_nome">Nome</label>
            <input class="form-control" name="cargo_nome" id="cargo_nome" type="text" aria-describedby="nameHelp" 
            placeholder="Insira o nome" value="<?php echo $row->cargo_nome; ?>" autofocus>

          </div>
          <div class="form-group">
            <label for="cargo_setor">Setor</label>
            <select class="form-control" id="cargo_setor" name="cargo_setor">
              <?php foreach ($setor as $row_setor): ?>
              <option value="<?php echo $row_setor->setor_id; ?>"
              <?php if($row->cargo_setor == $row_setor->setor_id){echo 'selected';} ?>>
              <font><?php echo $row_setor->setor_nome; ?></font></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="cargo_descricao">Descrição</label>
            <textarea class="form-control" name="cargo_descricao" id="cargo_descricao" rows="3" placeholder="Insira a descrição"><?php echo $row->cargo_descricao; ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="cargo_ativo" <?php if($row->cargo_ativo == 1){ echo 'checked'; } ?>> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>