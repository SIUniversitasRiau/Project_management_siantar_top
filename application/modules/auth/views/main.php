<?php if (validation_errors()!='')
{?>
<div class='alert alert-warning' style="text-align: center;text-decoration-style: solid"><?php echo validation_errors()?></div>
<?php } ?>
    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head" style="text-align: center">
                  Selamat Datang <br/>Sistem Project Manajemen 
                <b>SIANTAR TOP</b>
              </div>
              
                
              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" action="<?php echo site_url()?>auth/Login/verifylogin"  method="post">
                    <!-- Email -->
                    <div class="form-group">
                      <label class="control-label col-lg-3"for="inputUsername">Username</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control"  name="username"  id="inputEmail" placeholder="Masukkan Username Anda....">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                      <label class="control-label col-lg-3" for="inputPassword">Password</label>
                      <div class="col-lg-9">
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Masukkan Password Anda...">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                  
                        <div class="col-lg-9 col-lg-offset-3">
			<button type="submit" class="btn btn-info btn-sm">Sign in</button>
                    </div>
                    <br />
                  </form>
				  
				</div>
                  
                </div>
              
                <div class="widget-foot">
                  Bila belum terdaftar, harap hubungi Bidang Personalia
                </div>
            </div>  
      </div>
    </div>
  