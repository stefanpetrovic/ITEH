      
    	</div>
    	<div class="col-md-3" style="height: 1000px; background-image: url('<?php echo base_url()?>images/banner2.png'); background-repeat: no-repeat; background-size: 100% 100%; background-origin: border-box;">
      
    	</div>
  	</div class="row" style="height: 50px;">
  		<div class="col-md-3"></div>
  		<div class="col-md-6">
  			<p style="text-align: center;">Stef, Marko & Petar ®</p>
  		</div>
  		<div class="col-md-3"></div>
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
  </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  </body>
</html>