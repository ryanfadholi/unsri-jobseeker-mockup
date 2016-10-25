function printSuccess(name, email){
	var html_message = "<h1>Welcome, " + name + "</h1>";
	html_message += "<br>";
	html_message += "<p>Please check " + email + " inbox for your account confirmation.</p>";
	return html_message;
}

//String constants, used for toastr notification.
//toastr TITLES
var failedTitle = 'Registration FAILED';
var emailInvalidTitle = 'Invalid Email Address';
var emailRegisteredTitle = 'Email Registered';
var successTitle = 'Registration SUCCESS';
//toastr INFORMATION MESSAGES
var errorMsg = 'Error while saving your registration, please try again.';
var emailInvalidMsg = 'Please check your email address.';
var emailRegisteredMsg = 'Your email is already activated, you may sign into by using your account information.';
var emailTakenMsg = 'Email you have entered is already in use, please use another email.';
var successMsg = 'Registration almost completed, please check your email and click activation link to complete the registration.';
var 