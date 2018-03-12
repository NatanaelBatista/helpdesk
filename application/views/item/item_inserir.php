
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Inserir Item</div>
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
            <label for="item_nome">Nome</label>
            <input class="form-control" name="item_nome" id="item_nome" type="text" aria-describedby="nameHelp" placeholder="Insira o nome" value="<?php echo set_value('item_nome'); ?>">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="item_tipo_item">Tipo de item</label>
                <select class="form-control" id="item_tipo_item" name="item_tipo_item">
                  <?php foreach ($tipo_item as $row_tipo_item): ?>
                  <option value="<?php echo $row_tipo_item->tipo_item_id; ?>">
                  <font><?php echo $row_tipo_item->tipo_item_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="item_situacao">Situação</label>
                <select class="form-control" id="item_situacao" name="item_situacao">
                  <?php foreach ($situacao as $row_situacao): ?>
                  <option value="<?php echo $row_situacao->situacao_id; ?>">
                  <font><?php echo $row_situacao->situacao_nome; ?></font></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="item_modelo">Modelo</label>
            <input class="form-control" name="item_modelo" id="item_modelo" type="text" aria-describedby="nameHelp" placeholder="Insira o modelo" value="<?php echo set_value('item_modelo'); ?>">
          </div>
          <div class="form-group">
            <label for="item_descricao">Descrição</label>
            <textarea class="form-control" name="item_descricao" id="item_descricao" rows="3" placeholder="Insira a descrição"><?php echo set_value('item_descricao'); ?></textarea>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" name="item_ativo" checked> Ativo</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        </form>
      </div>
    </div>
  </div>