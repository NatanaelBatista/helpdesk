
<div class="container">
  <div class="card card-register mx-auto mt-5">
    <?php foreach ($incidente as $row): ?>
    <div class="card-header">Editar Incidente <b style="color: red;"><?php echo $row->incidente_id; ?></b></div>
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
          <div class="form-row">
            <div class="col-md-6">
              <label for="incidente_categoria">Categoria</label>
              <select class="form-control" name="incidente_categoria" id="incidente_categoria">
                <?php foreach ($categoria as $row_categoria): ?>
                <option value="<?php echo $row_categoria->categoria_id; ?>"
                <?php if($row->incidente_categoria == $row_categoria->categoria_id){echo 'selected';} ?>>
                <font><?php echo $row_categoria->categoria_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="incidente_prioridade">Prioridade</label>
              <select class="form-control" name="incidente_prioridade" id="incidente_prioridade">
                <?php foreach ($prioridade as $row_prioridade): ?>
                <option value="<?php echo $row_prioridade->prioridade_id; ?>"
                <?php if($row->incidente_prioridade == $row_prioridade->prioridade_id){echo 'selected';} ?>>
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
                <?php if($row->incidente_empresa == $row_empresa->empresa_id){echo 'selected';} ?>>
                <font><?php echo $row_empresa->empresa_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="incidente_situacao">Situacao</label>
              <select class="form-control" name="incidente_situacao" id="incidente_situacao">
                <?php foreach ($situacao as $row_situacao): ?>
                <option value="<?php echo $row_situacao->situacao_id; ?>"
                <?php if($row->incidente_situacao == $row_situacao->situacao_id){echo 'selected';} ?>>
                <font><?php echo $row_situacao->situacao_nome; ?></font></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="incidente_titulo">Título</label>
          <input class="form-control" name="incidente_titulo" id="incidente_titulo" type="text" aria-describedby="nameHelp" placeholder="Insira o título" value="<?php echo $row->incidente_titulo; ?>">
        </div>
        <div class="form-group">
          <label for="incidente_descricao">Descrição</label>
          <textarea class="form-control" name="incidente_descricao" id="incidente_descricao" rows="5" placeholder="Insira a descrição"><?php echo $row->incidente_descricao; ?></textarea>
        </div>
        <div class="form-group">
        <?php foreach ($incidente_nota as $row_incidente_nota): ?>
          <small style="font-size: 9pt;"><?php echo $row_incidente_nota->incidente_nota_hora; ?> | <b><?php echo $row_incidente_nota->pessoa_p_nome; ?></b></small>
          <p style="color: #ff8b00;"><?php echo $row_incidente_nota->incidente_nota_descricao.'<hr>'; ?></p>
        <?php endforeach; ?>
        </div>
        <div class="form-group">
          <label for="incidente_nota_descricao">Notas</label>
          <textarea class="form-control" name="incidente_nota_descricao" id="incidente_nota_descricao" placeholder="Insira uma nota"></textarea>
        </div>
        <div class="form-group">
          <label for="incidente_anexo">Anexo</label>
          <input class="form-control" name="incidente_anexo" id="incidente_anexo" type="file" value="<?php echo set_value('incidente_anexo'); ?>" disabled>
        </div>
        <div class="form-group" style="display: <?php if($row->incidente_anexo == ''){echo 'none';} ?>">
          <label>Anexo:</label>
          <a href="<?php echo base_url(); ?>uploads/anexos/<?php echo $row->incidente_anexo; ?>" target="_blank"><?php echo $row->incidente_anexo; ?></a>
        </div>
        <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        <?php endforeach; ?>
      </form>
    </div>
  </div>
</div>