      
    	</div>
    	<div class="col-md-3" style="height: 1000px; background-image: url('<?php echo base_url()?>images/banner2.png'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
      
    	</div>
  	</div class="row" style="height: 50px;">
  		<div class="col-md-3">
  			<?php
  				$url = "http://football-api.com/api/?Action=standings&APIKey=41a8bfcd-3790-8d64-5f6e95a6c7ab&comp_id=1204";
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_PROXY, 'proxy.rcub.bg.ac.rs:8080');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
				$curl_odgovor = curl_exec($curl);
				curl_close($curl);
				//echo $curl_odgovor;
				$foundMatches = json_decode($curl_odgovor, true);
				//eho $foundMatches['teams'][0]['stand_team_name'];
	?> 
  			Stanje u Engleskoj Premijer ligi: <br /> 
  			Prvi na tabeli: <?php echo $foundMatches['teams'][0]['stand_team_name'];?><br />
  			Drugi na tabeli: <?php echo $foundMatches['teams'][1]['stand_team_name'];?><br />
  			Treci na tabeli: <?php echo $foundMatches['teams'][2]['stand_team_name'];?><br />
  		</div>
  		<div class="col-md-6">
  			<p style="text-align: center;">Stef, Marko & Petar ®</p>
  		</div>
  		<div class="col-md-3">  			
  		</div>
  	</div>
  	
  </div>
  <script type="text/javascript">
  	function proveriUsername() {
  		var podaci = {
  			username: $('#username').val()
  		};
  		$.ajax({
  			url: "<?php echo site_url('site/proveriUsername')?>",
			type: 'POST',
			data: podaci,
			success: function(msg) {
				if (msg == true){
					$('#usernameDiv').attr("class", "form-group has-success has-feedback");
					$('#ikonicaUsername').remove();
					$('#usernameDiv').append('<span id="ikonicaUsername" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				}else {
					$('#usernameDiv').attr("class", "form-group has-error has-feedback");
					$('#ikonicaUsername').remove();
					$('#usernameDiv').append('<span id="ikonicaUsername" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				}
				
				
			}
  		});
  		
  	}
  	
  	function proveriPassword() {
  		var ok = false;
  		var password = $('#password').val();
  		var passwordRetype = $('#passwordRetype').val();
  		if (password != "") {
  			$('#passwordDiv').attr("class", "form-group has-success has-feedback");
			$('#ikonicaPassword').remove();
			$('#passwordDiv').append('<span id="ikonicaPassword" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			
			if (password == passwordRetype) {
				$('#passwordRetypeDiv').attr("class", "form-group has-success has-feedback");
				$('#ikonicaPasswordRetype').remove();
				$('#passwordRetypeDiv').append('<span id="ikonicaPasswordRetype" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			}else {
				$('#passwordRetypeDiv').attr("class", "form-group has-error has-feedback");
				$('#ikonicaPasswordRetype').remove();
				$('#passwordRetypeDiv').append('<span id="ikonicaPasswordRetype" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			}
  		} else {
  			$('#passwordDiv').attr("class", "form-group has-error has-feedback");
			$('#ikonicaPassword').remove();
			$('#passwordDiv').append('<span id="ikonicaPassword" class="glyphicon glyphicon-remove form-control-feedback"></span>');
  		}
  		
  	}
  	
  	function proveriEmail() {
  		var podaci = {
  			email: $('#email').val()
  		};
  		if (podaci.email.indexOf("@") < 0 || podaci.email.indexOf("@") > podaci.email.indexOf(".")) {
  			$('#emailDiv').attr("class", "form-group has-error has-feedback");
			$('#ikonicaEmail').remove();
			$('#emailDiv').append('<span id="ikonicaEmail" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			return;
  		}
  		$.ajax({
  			url: "<?php echo site_url('site/proveriEmail')?>",
			type: 'POST',
			data: podaci,
			success: function(msg) {
				if (msg == true){
					$('#emailDiv').attr("class", "form-group has-success has-feedback");
					$('#ikonicaEmail').remove();
					$('#emailDiv').append('<span id="ikonicaEmail" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				}else {
					$('#emailDiv').attr("class", "form-group has-error has-feedback");
					$('#ikonicaEmail').remove();
					$('#emailDiv').append('<span id="ikonicaEmail" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				}
			}
  		});
  	}
  </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  </body>
</html>