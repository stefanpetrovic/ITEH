<!-- Glavni sadrzaj aka. vesti. -->
      <div class="row">
        <div class="col-md-8">
        	<?php echo validation_errors();?>
          <form role="form" style="width: 300px; margin: auto;" action="<?php echo base_url() . 'site/validacijaRegistracije';?>" method="post">
            <div id="usernameDiv" class="form-group">
              <label for="username">Username: </label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter username..." value="<?php echo set_value('username');?>" onblur="proveriUsername();"/>
            </div>
            <div id="passwordDiv" class="form-group">
              <label for="password">Password: </label>
              <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password');?>" placeholder="Enter password..."/>
            </div>
            <div id="passwordRetypeDiv" class="form-group">
              <label for="password">Retype password: </label>
              <input type="password" class="form-control" id="passwordRetype" name="passwordRetype" placeholder="Retype password..." value="<?php echo set_value('passwordRetype');?>"onblur="proveriPassword();"/>
            </div>
            <div id="emailDiv" class="form-group">
              <label id="emailDiv" for="emailAddress">Email address: </label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address..." value="<?php echo set_value('email');?>" onblur="proveriEmail();"/>
            </div>
            <button type="submit" class="btn btn-default">Registruj se</button>
          </form>
        </div>
        
      </div>