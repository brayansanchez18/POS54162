<div id="back"></div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="ingUsuario" placeholder="Correo Electronico" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4 m-auto">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
        <?php $login = new ControladorUsuarios(); $login -> ctrIngresoUsuario(); ?>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>