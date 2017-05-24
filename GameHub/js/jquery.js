$(document).ready(function(){
    $("#aboutToggle").click(function(){
        $("#about").slideToggle("slow");
    });
});

function deselect(e) {
  $('.pop').slideFadeToggle(function() {
    e.removeClass('selected');
  });
}

$(function() {
  $('#followers').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));
    } else {
      $(this).addClass('selected');
      $('.pop').slideFadeToggle();
    }
    return false;
  });

  $('.close').on('click', function() {
    deselect($('#followers'));
    return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};

function register(){
	var username = document.getElementById('username');
	var email = document.getElementById('emaail');
	var emailConf = document.getElementById('confirm-email');
	var password = document.getElementById('password');
	var passwordConf = document.getElementById('confirm-password');

	if(username.value == '' || email.value == '' || emailConf.value == '' || password.value == '' || passwordConf.value == '') {
		alert('All fields are required!');
	} else {
		//Check if username already exists in database
		$.ajax({
		  url: "handler.php?action=usernameTest&username=" + username.value
		}).done(function(data) {
		  if(data == 1) {
			  alert('That username is already in use!');

		  }
		  alert(data);
		});
		// additional testing here



		//if no errors
		return true;
	}
	return false;
}
