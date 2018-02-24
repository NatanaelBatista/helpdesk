
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Inserir Links_uteis</div>
      <div class="card-body">
        <!-- Exibe mensagem de erro -->
        <?php if($err_form != ''): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p><?php echo $err_form; ?></p>
        </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="log_upload">Arquivo xlsx</label>
            <input class="form-control" name="fileToUpload" id="fileToUpload" type="file">
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Enviar</button>
        </form>
      </div>
    </div>
  </div>