
/**
 * Validate For register Form
 * @return {[True/False]}   [Validator]
 */
if ($('.account-register').length) {

  //UserName Pattern
  $.validator.addMethod("UsernamePattern", function(value, element){
    var pattern = /(?=^.{6,51}$)([A-Za-z]{1})([A-Za-z0-9!@#$%_\^\&amp;\*\-\.\?]{5,49})$/;

    if (value.match(pattern) === null) {
        return false;
    } else {
        return true;
    };
  }, "user names. Matching text must have 6 - 50 characters, cannot contain spaces, must begin with an alpha character, can contain mixed case alpha, digits, and the following special characters: ! @ # $ % ^ &amp; * - . _ ?");

  //Email Pattern
  $.validator.addMethod("EmailPattern", function(value, element){
    var pattern = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;

    if (value.match(pattern) === null) {
        return false;
    } else {
        return true;
    };
  }, "(1) It allows usernames with 1 or 2 alphanum characters, or 3+ chars can have -._ in the middle. username may NOT start/end with -._ or any other non alphanumeric character. (2) It allows heirarchical domain names (e.g. me@really.big.com). Similar -._ placement rules there. (3) It allows 2-9 character alphabetic-only TLDs (that oughta cover museum and adnauseum :&gt;). (4) No IP email addresses though -- I wouldn't Want to accept that kind of address.");

  //Call Validate Form
  $(".account-register form").validate({
			rules: {
				username: {
					required: true,
					UsernamePattern: true
				},
        email:{
          required: true,
          EmailPattern:true
        },
        pwd:{
          required: true,
        },
        pwd_repeat:{
          equalTo:'input[name="pwd"]'
        }
			},
			messages: {
				username: {
					required: "You must set an username"
				},
        email:{
          required:"You must set an Email"
        },
        pwd:{
          required:"You must set an Password"
        },
        pwd_repeat:{
          equalTo:"Passwords are not equal"
        }
			}
		});
}
