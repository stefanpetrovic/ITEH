<!-- Glavni sadrzaj aka. vesti. -->
      <div class="row">
        <div class="col-md-8">
          <form role="form" style="width: 300px; margin: auto;" action="<?php echo base_url() . 'login/registracija';?>" method="post">
            <div id="usernameDiv" class="form-group">
              <label for="username">Username: </label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter username..." onblur="proveriUsername();"/>
              
            </div>
            <div class="form-group">
              <label for="password">Password: </label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password..."/>
            </div>
            <div class="form-group">
              <label for="password">Retype password: </label>
              <input type="password" class="form-control" id="password" placeholder="Retype password..."/>
            </div>
            <div class="form-group">
              <label for="emailAddress">Email address: </label>
              <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Enter email address..."/>
            </div>
            <button type="submit" class="btn btn-default">Registruj se</button>
          </form>
        </div>
        
      </div>