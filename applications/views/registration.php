<form id="form_jobseeker">
<div class="row">
	<div class="col-xs-9 col-sm-4">
		<div class="form-group">
			<label for="email">Email:</label>
			<input class="form-control" id="email" type="email" name="email" required></input>
		</div>
		<div class="form-group">
				<label for="name">Nama:</label>
				<input class="form-control" id="name" name="name"></input>
		</div>
		<div class="form-group">
			<label for="ktp_id">No. KTP:</label>
			<input class="form-control" id="ktp_id" name="ktp_id"></input>
		</div>
		<div class="form-group">
			<label for="address">Alamat:</label>
			<textarea class="form-control" id="address" name="address" rows="4"></textarea>
		</div>
	</div>
	<div class="col-xs-9 col-sm-4">
		<div class="form-group">
			<label for="gender">Gender:</label>
			<select class="form-control" id="gender" name="gender">
				<option value="L">Laki-Laki</option>
				<option value="P">Perempuan</option>
			</select>
		</div>
		<div class="form-group">
			<label for="birthplace">Tempat Lahir:</label>
			<input class="form-control" id="birthplace" name="birthplace"></input>
		</div>
		<div class="form-group">
			<label for="birthdate">Tanggal Lahir:</label>
			<input type="date" class="form-control" id="birthdate" name="birthdate"></input>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group">
		<div class="col-xs-12 col-sm-4">
			<button type="submit" class="btn btn-primary btn-lg btn-block" id="test">Proses</button>
		</div>
		<div class="col-xs-12 col-sm-4">
			<button type="reset" class="btn btn-secondary btn-lg btn-block">Ulangi</button>
		</div>		
	</div>
</div>
</form>


<script type="text/javascript">
$(function () { 
    $('#form_jobseeker').on('submit', function (e) { 
        e.preventDefault(); 
        var email = $("#email").val();
        $.ajax({ 
          type: 'post', 
          url: 'applications/controllers/registration_controller.php?action=register', 
          data: $('#form_jobseeker').serialize(), 
          success: function(data) { 
             			if(data=='0'){ 
             				toastr.error('Error while saving your registration, please do registration again', 
             							  'Registration FAILED'); 
            			} 
            			else if(data=='-1'){ 
      	 					toastr.warning('Email you have entered is already in use, please choose another email.', 
      	 									'Registration FAILED');     
            			}			  
            			else if(data=='SUCCESS'){ 
       						toastr.success('Registration almost completed, please check your email and click activation link to complete the registration', 'Thank you for registering ' + email); 
            			} 
            			else if(data=='-2'){ 
       						toastr.warning('Please check your email address', 'Invalid Email Address'); 
            			} 
            			else if(data=='-3'){ 
       						toastr.warning('Your email is already activated, you may sign into by using your account information', 'Email Activated'); 
           				} 
            			else{ 
            				 toastr.error(data, 'Result FAILED');  
             				//$('#form_messages').html(data); 
            				} 
           			}, 
           error: function (xhr, ajaxOptions, thrownError) { 
            			toastr.error('error! '+xhr.status+' '+thrownError, xhr.status); 
          			} 
            }); //end ajax 
         }); //end submit function
       }); //end outer async function
 </script>