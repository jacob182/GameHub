$(document).ready(function(){
    $("#aboutToggle").click(function(){
        $("#about").slideToggle("slow");
    });
	 $("#meToggle").click(function(){
        $("#aboutme").slideToggle("slow");
    });
});


$(function () {
           var waitForFinalEvent=function(){var b={};return function(c,d,a){a||(a="I am a banana!");b[a]&&clearTimeout(b[a]);b[a]=setTimeout(c,d)}}();
           var fullDateString = new Date();
           function isBreakpoint(alias) {
               return $('.device-' + alias).is(':visible');
           }


           var options = {
               float: false
           };
           $('.grid-stack').gridstack(options);
           function resizeGrid() {
               var grid = $('.grid-stack').data('gridstack');
               if (isBreakpoint('xs')) {
                   $('#grid-size').text('One column mode');
               } else if (isBreakpoint('sm')) {
                   grid.setGridWidth(3);
                   $('#grid-size').text(3);
               } else if (isBreakpoint('md')) {
                   grid.setGridWidth(6);
                   $('#grid-size').text(6);
               } else if (isBreakpoint('lg')) {
                   grid.setGridWidth(12);
                   $('#grid-size').text(12);
               }
           };
           $(window).resize(function () {
               waitForFinalEvent(function() {
                   resizeGrid();
               }, 300, fullDateString.getTime());
           });

           new function () {
               this.serializedData = [
                   {x: 0, y: 0, width: 4, height: 2},
                   {x: 3, y: 1, width: 4, height: 2},
                   {x: 4, y: 1, width: 4, height: 1},
                   {x: 2, y: 3, width: 8, height: 1},
                   {x: 0, y: 4, width: 4, height: 1},
                   {x: 0, y: 3, width: 4, height: 1},
                   {x: 2, y: 4, width: 4, height: 1},
                   {x: 2, y: 5, width: 4, height: 1},
                   {x: 0, y: 6, width: 12, height: 1}
               ];

               this.grid = $('.grid-stack').data('gridstack');

               this.loadGrid = function () {
                   this.grid.removeAll();
                   var items = GridStackUI.Utils.sort(this.serializedData);
                   _.each(items, function (node, i) {
                       this.grid.addWidget($('<div><div class="grid-stack-item-content">' + i + '</div></div>'),
                           node.x, node.y, node.width, node.height);
                   }, this);
                   return false;
               }.bind(this);

               this.loadGrid();
               resizeGrid();
           };
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
