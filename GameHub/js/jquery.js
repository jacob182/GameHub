$(document).ready(function(){
    $("#aboutToggle").click(function(){
        $("#about").slideToggle("slow");
    });
	 $("#meToggle").click(function(){
        $("#aboutme").slideToggle("slow");
    });
});


$(function() {
  $('.grid-stack').gridstack({
    animate: true
  });

  var grid = $('.grid-stack').data('gridstack'),
      serialize = function() {
        return _.map($('.grid-stack > .grid-stack-item:visible'), function(el) {
          var node = $(el).data('_gridstack_node');
          return {id: $(el).attr('id'), x: node.x, y: node.y, width: node.width, height: node.height};
        });
      },
      move = function(grid, stored) {
        stored = GridStackUI.Utils.sort(stored, 1, 12);
        $.each(stored, function(key, node) {
          el = $('#' + node.id);
          $('.log').append($('<p></p>').text('Moving #' + node.id + ' to ' + 'x:' + node.x + ' y:' + node.y));

          /* grid.addWidget($('<div><div class="grid-stack-item-content" /><div/>'),
                        node.x, node.y, node.width, node.height); */
          /* grid.move(el, node.x, node.y);
          grid.resize(el, node.width, node.height); */
          grid.update(el, node.x, node.y, node.width, node.height);
        });
      };





  $('.serialize').on('click', function(e) {
    e.preventDefault;
    var data = serialize();
    //alert(data);
    $('.log').html(JSON.stringify(data, null, '    '));
  });

  setTimeout(function() {
    var saved = [
      { "id": "title", "x": 0, "y": 0, "width": 8, "height": 1 },
      { "id": "slug", "x": 8, "y": 0, "width": 4, "height": 1 },
      { "id": "content", "x": 0, "y": 1, "width": 8, "height": 1 },
      { "id": "time", "x": 0, "y": 2, "width": 12, "height": 1 },
      { "id": "date", "x": 8, "y": 1, "width": 4, "height": 1 }
    ];
    move(grid, saved);
  }, 2000);

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
