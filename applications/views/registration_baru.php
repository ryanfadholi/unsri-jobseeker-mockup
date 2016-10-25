<div id="form_divider">
<form id="form_jobseeker">
<div class="row">
	<div class="col-xs-9 col-sm-4">
		<div class="form-group">
			<label for="email">Email:</label>
			<input class="form-control" id="email" type="email" name="email" required></input>
		</div>
		<div class="form-group">
			<label for="name">Nama:</label>
			<input class="form-control" id="name" name="name" required></input>
		</div>
		<div class="form-group">
			<label for="noktp">No. KTP:</label>
			<input class="form-control" id="noktp" name="ktp"  required></input>
		</div>
		<div class="form-group">
			<label for="alamat">Alamat:</label>
			<textarea class="form-control" id="alamat" name="address" rows="4"></textarea>
		</div>
	</div>
	<div class="col-xs-9 col-sm-4">
		<div class="form-group">
			<label for="gender">Gender:</label>
			<select class="form-control" id="gender" name="gender" required>
				<option>Laki-Laki</option>
				<option>Perempuan</option>
			</select>
		</div>
		<div class="form-group">
			<label for="tempatlahir">Tempat Lahir:</label>
			<input class="form-control" id="birthplace" name="birthplace" required></input>
		</div>
		<div class="form-group">
			<label for="tanggallahir">Tanggal Lahir:</label>
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
</div>
<script type="text/javascript" src="js/registration_responses.js"></script>
<script type="text/javascript">
$(function () { 
    $('#form_jobseeker').on('submit', function (e) { 
        e.preventDefault(); 
        var email = $("#email").val();
        $.ajax({ 
          method: 'POST',
          type: 'POST', 
          url: 'controller.php', 
          data: $('#form_jobseeker').serialize(),
          dataType: "json",
          success: function(data) { 
             			if(data.ktp =='0'){ 
             				toastr.error('Error while saving your registration, please do registration again', 
             							  'Registration FAILED'); 
            			} 
            			else if(data.ktp =='-1'){ 
      	 					toastr.warning('Email you have entered is already in use, please choose another email.', 
      	 									'Registration FAILED');     
            			}			  
            			else if(data.ktp =='1'){ 
       						toastr.success('Registration almost completed, please check your email and click activation link to complete the registration', 'Thank you for registering ' + email); 
       						 $('#form_divider').html(printSuccess(data.nama, data.email));
            			} 
            			else if(data.ktp =='-2'){ 
       						toastr.warning('Please check your email address', 'Invalid Email Address'); 
            			} 
            			else if(data.ktp =='-3'){ 
       						toastr.warning('Your email is already activated, you may sign into by using your account information', 'Email Activated'); 
           				} 
            			else{ 
            				 toastr.error(data, 'Result FAILED'); 
             				 $('#form_jobseeker').html(data); 
            				} 
           			}, 
           error: function (xhr, ajaxOptions, thrownError) { 
            			toastr.error('error! '+xhr.status+' '+thrownError, xhr.status); 
          			} 
            }); //end ajax 
         }); //end submit function
       }); //end outer anon function
 </script>