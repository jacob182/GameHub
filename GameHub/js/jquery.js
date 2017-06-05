$(document).ready(function(){
    $("#aboutToggle").click(function(){
        $("#about").slideToggle("slow");
    });
	 $("#meToggle").click(function(){
        $("#aboutme").slideToggle("slow");
    });
});


$(function () {
    var options = {
        cell_height: 80,
        vertical_margin: 10
    };
    $('.grid-stack').gridstack(options);
});

function deselect1(e) {
  $('.fspop').slideFadeToggle(function() {
    e.removeClass('selected');
  });
}

function deselect(e) {
  $('.fdpop').slideFadeToggle(function() {
    e.removeClass('selected');
  });
}

$(function() {
  $('#followers').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect1($(this));
    } else {
      $(this).addClass('selected');
      $('.fspop').slideFadeToggle();
	  if($("#following").hasClass('selected')) deselect($('#following'));
    }
    return false;
  });

  $('#following').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));
    } else {
      $(this).addClass('selected');
      $('.fdpop').slideFadeToggle();
	  if($("#followers").hasClass('selected')) deselect1($('#followers'));
    }
    return false;
  });

  $('.close').on('click', function() {
	if($("#followers").hasClass('selected')) deselect1($('#followers'));
	if($("#following").hasClass('selected')) deselect($('#following'));
    return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};

function register(){

	var username = document.getElementById('username');
	var email = document.getElementById('email');
	var emailConf = document.getElementById('confirm-email');
	var pass = document.getElementById('password');
	var passwordConf = document.getElementById('confirm-password');
	var emailpatt = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var passpatt = new RegExp('.{7,}');
	var userpatt = new RegExp('^(?=(?![0-9])?[A-Za-z0-9]?[._-]?[A-Za-z0-9]+).{2,12}');

	if(typeof(Storage) !== 'undefined') {
		localStorage.setItem('username', username.value);
		localStorage.setItem('email', email.value);
		localStorage.setItem('emailConf', emailConf.value);
		localStorage.setItem('pass', pass.value);
		localStorage.setItem('passwordConf', passwordConf.value);
	} else {
		console.log('Web storage not supported!');
	}

	if(username.value == '' || email.value == '' || emailConf.value == '' || pass.value == '' || passwordConf.value == '') {
		errorAnchor.innerHTML = 'All fields are required!';
	} else {

		$.ajax({
		  url: "handler.php?action=usernameTest&username=" + username.value
		}).done(function(data) {
		  if(data == 1) {
			  errorAnchor.innerHTML = 'That username is already in use!';
				return false;
		  }
		});

		$.ajax({
			  url: "handler.php?action=emailTest&email=" + email.value
			}).done(function(data) {
			  if(data == 1) {
				  errorAnchor.innerHTML = 'That email is already in use!';
					return false;
			  }
			});

		if (!emailpatt.test(email.value)){
			errorAnchor.innerHTML = 'Please enter a valid email address.';
			return false;
		}
		if (!userpatt.test(username.value))
		{
			errorAnchor.innerHTML = 'Please enter a valid username (min 2 - max 12 characters).';
			return false;
		}
		if (!passpatt.test(pass.value))
		{
			errorAnchor.innerHTML = 'Please enter a valid password (atleast 7 characters).';
			return false;
		}
		if (pass.value != passwordConf.value)
		{
		  errorAnchor.innerHTML = 'Please enter the same password.';
		  return false;
		}
		if (email.value != emailConf.value)
		{
		  errorAnchor.innerHTML = 'Please enter the same email address.';
		  return false;
		}
	}
	return true;
}
