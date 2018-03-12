
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Tipo de item</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($tipo_item as $row): ?>
          <div class="form-group">
            <label for="tipo_item_nome">Nome</label>
            <input class="form-control" name="tipo_item_nome" id="tipo_item_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo $row->tipo_item_nome; ?>">
          </div>
          <div class="form-group">
            <label for="tipo_item_descricao">Descrição</label>
            <textarea class="form-control" name="tipo_item_descricao" id="tipo_item_descricao" rows="3" placeholder="Insira a descrição"><?php echo $row->tipo_item_descricao; ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="tipo_item_ativo" <?php if($row->tipo_item_ativo == 1){ echo 'checked'; } ?>> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
        </form>
      </div>
    </div>
  </div>