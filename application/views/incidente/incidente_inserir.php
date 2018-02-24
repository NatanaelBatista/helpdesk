
<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Enviar Incidente</div>
    <div class="card-body">
      <!-- Exibe mensagem de erro -->
      <?php if($err_form != ''): ?>
      <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php 
            if(!is_string($err_form))
            {
              foreach ($err_form as $key => $value)
              {
                echo "<p>$value</p>";
              }
            }
            else
            {
              echo "<p>$err_form</p>";
            }
           ?>
      </div>
      <?php endif; ?>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="incidente_categoria">Categoria</label>
              <select class="form-control" name="incidente_categoria" id="incidente_categoria">
                <?php foreach ($categoria as $row_categoria): ?>
                <option value="<?php echo $row_categoria->categoria_id; ?>">
                <font><?php echo $row_categoria->categoria_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="incidente_prioridade">Prioridade</label>
              <select class="form-control" name="incidente_prioridade" id="incidente_prioridade">
                <?php foreach ($prioridade as $row_prioridade): ?>
                <option value="<?php echo $row_prioridade->prioridade_id; ?>">
                <font><?php echo $row_prioridade->prioridade_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="incidente_empresa">Empresa</label>
              <select class="form-control" name="incidente_empresa" id="incidente_empresa">
                <?php foreach ($empresa as $row_empresa): ?>
                <option value="<?php echo $row_empresa->empresa_id; ?>"
                <?php if($_SESSION['usuario_empresa'] == $row_empresa->empresa_id){echo 'selected';} ?>>
                <font><?php echo $row_empresa->empresa_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="incidente_situacao">Situacao</label>
              <select class="form-control" id="incidente_situacao" disabled="">
                <?php foreach ($situacao as $row_situacao): ?>
                <option value="<?php echo $row_situacao->situacao_id; ?>"
                <?php if(1 == $row_situacao->situacao_id){echo 'selected';} ?>>
                <font><?php echo $row_situacao->situacao_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="incidente_titulo">Título</label>
          <input class="form-control" name="incidente_titulo" id="incidente_titulo" type="text" aria-describedby="nameHelp" placeholder="Insira o título" value="<?php echo set_value('incidente_titulo'); ?>">
        </div>
        <div class="form-group">
          <label for="incidente_descricao">Descrição</label>
          <textarea class="form-control" name="incidente_descricao" id="incidente_descricao" rows="5" placeholder="Insira a descrição"><?php echo set_value('incidente_descricao'); ?></textarea>
        </div>
        <div class="form-group">
          <label for="incidente_anexo">Anexo</label>
          <input class="form-control" name="incidente_anexo" id="incidente_anexo" type="file" value="<?php echo set_value('incidente_anexo'); ?>" disabled>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
      </form>
    </div>
  </div>
</div>