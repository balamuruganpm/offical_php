 
 var user_name = document.getElementById('user_name')
 var user_email = document.getElementById('email')
 var user_mobile = document.getElementById('mobile_num')
 var user_password = document.getElementById('user_password')

function nameValidation()
{
      // var isValid = true;
     
      var nameError = document.getElementById('nameError');

      if(!user_name.value.trim().match(/^[a-zA-Z]/))
      {
           nameError.style.visibility = 'visible';
           nameError.innerHTML="check your name";
           nameError.style.color='red';
           return false;
      }
      nameError.style.visibility = "hidden";
       return true
      // return isValid;
}
function emailValidation()
{
      var emailError = document.getElementById('emailError');
      
      
      if (!user_email.value.trim().match(/^[a-zA-Z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)  ) {
            emailError.innerHTML = "enter valid email address";
            emailError.style.visibility = "visible";
            emailError.style.color='red';
           return false;
          }
          emailError.style.visibility = "hidden";
           return true
          
}
function mobileVerification()
{
      var mobileError = document.getElementById('mobileError');
      var mob_count = user_mobile.value.length;
     
      if (!user_mobile.value.trim().match(/[6-9][0-9]{9}/) || mob_count!=10 ) {
            mobileError.innerHTML = "enter valid mobile number";
            mobileError.style.visibility = "visible";
            mobileError.style.color='red';
            return false;
          }
    
          mobileError.style.visibility = "hidden";
           return true
}
// function passVerification()
// {
//       var passwordError = document.getElementById('passwordError');

// }