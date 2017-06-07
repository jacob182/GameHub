window.onload = function() {
if(typeof document.getElementById('username') != 'undefined') {
	if(localStorage.getItem('username') !== null) {
		document.getElementById('username').value = localStorage.getItem('username');
		document.getElementById('email').value = localStorage.getItem('email');
		document.getElementById('confirm-email').value = localStorage.getItem('emailConf');
		document.getElementById('password').value = localStorage.getItem('pass');
		document.getElementById('confirm-password').value = localStorage.getItem('passwordConf');
	}
}

var myIndex = 0;
  if (window.location.href.indexOf('about') > -1) {
    carousel();
  }

  function carousel() {
      var i;
      var x = document.getElementsByClassName("imageSlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      myIndex++;
      if (myIndex > x.length) {myIndex = 1}
      x[myIndex-1].style.display = "block";
      setTimeout(carousel, 3000);
  }
};

function edit_password() {
  var toggler = document.getElementById('edit-password');
  if(toggler.style.display == 'block') {
    document.getElementById('editPasswordbtn').innerHTML="Edit Password";
    toggler.style.display="none";
  } else {
    toggler.style.display="block";
    document.getElementById('editPasswordbtn').innerHTML="Hide";
  }

  return false;

}


function check_password() {
  var notification = document.getElementById("passwordnotification");
  var password = document.getElementById("password");
  var password_confirm = document.getElementById("confirm-password");
  if (password.value != password_confirm.value){
    notification.innerHTML = "Passwords do not match";
    password.className = "input is-danger";
    password_confirm.className = "input is-danger";
    document.getElementById("regbtn").disabled = true;
  } else {
    password.className = "input is-success";
    password_confirm.className = "input is-success";
    notification.innerHTML = "Passwords match";
		notification.className = "help is-success";
    document.getElementById("regbtn").disabled = false;
  }
}
