
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Editar Item</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post">
          <?php foreach ($item as $row): ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="item_nome">Nome</label>
                <input class="form-control" name="item_nome" id="item_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo $row->item_nome; ?>">
              </div>
              <div class="col-md-6">
                <label for="item_empresa">Empresa</label>
                <select class="form-control" id="item_empresa" name="item_empresa">
                  <?php foreach ($empresa as $row_empresa): ?>
                  <option value="<?php echo $row_empresa->empresa_id; ?>"
                  <?php if($row->item_empresa == $row_empresa->empresa_id){echo 'selected';} ?>>
                  <font><?php echo $row_empresa->empresa_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="item_modelo">Modelo</label>
            <input class="form-control" name="item_modelo" id="item_modelo" type="text" aria-describedby="nameHelp" placeholder="Insira o modelo" value="<?php echo $row->item_modelo; ?>">
          </div>
          <div class="form-group">
            <label for="item_descricao">Descrição</label>
            <textarea class="form-control" name="item_descricao" id="item_descricao" rows="3" placeholder="Insira a descrição"><?php echo $row->item_descricao; ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="item_ativo" <?php if($row->item_ativo == 1){ echo 'checked'; } ?>> Ativo</label>
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