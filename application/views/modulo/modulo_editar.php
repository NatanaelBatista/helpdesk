
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Modulo</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($modulo as $row): ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="modulo_nome">Nome</label>
                <input class="form-control" name="modulo_nome" id="modulo_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo $row->modulo_nome; ?>">
              </div>
              <div class="col-md-6">
                <label for="modulo_grupo">grupo_modulo</label>
                <select class="form-control" id="modulo_grupo" name="modulo_grupo">
                  <?php foreach ($grupo_modulo as $row_grupo_modulo): ?>
                  <option value="<?php echo $row_grupo_modulo->grupo_modulo_id; ?>"
                  <?php if($row->modulo_grupo == $row_grupo_modulo->grupo_modulo_id){echo 'selected';} ?>>
                  <font><?php echo $row_grupo_modulo->grupo_modulo_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="modulo_descricao">Descrição</label>
            <textarea class="form-control" name="modulo_descricao" id="modulo_descricao" rows="3" placeholder="Insira a descrição"><?php echo $row->modulo_descricao; ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="modulo_ativo" <?php if($row->modulo_ativo == 1){ echo 'checked'; } ?>> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>


  <div class="form-row">
            <div class="col-md-6">