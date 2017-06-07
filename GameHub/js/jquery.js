// document ready
$(function() {
  // menu interface clicks on about
  $("#aboutToggle").click(function() {
    $("#about").slideToggle("slow");
  });
  $("#meToggle").click(function(){
      $("#aboutme").slideToggle("slow");
  });
  $("#brockToggle").click(function(){
      $("#aboutbrock").slideToggle("slow");
  });
  $("#jordanToggle").click(function(){
      $("#aboutjordan").slideToggle("slow");
  });
  $("#ianToggle").click(function(){
      $("#aboutian").slideToggle("slow");
  });

  // followers & following functionality
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
  // closure of following
  $('.close').on('click', function() {
	if($("#followers").hasClass('selected')) deselect1($('#followers'));
	if($("#following").hasClass('selected')) deselect($('#following'));
    return false;
  });

  // grid stack functionality
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
      { "id": "move", "x": 0, "y": 0, "width": 4, "height": 3 },
      { "id": "the", "x": 4, "y": 0, "width": 4, "height": 3 },
      { "id": "tiles", "x": 8, "y": 0, "width": 4, "height": 3 },
    ];
    move(grid, saved);
  }, 2000);
})

// jquery helper function for various jquery selectors for slide animations
$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};

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

// registration client side check
function register(){
	var username = document.getElementById('username');
	var email = document.getElementById('email');
	var pass = document.getElementById('password');
	var passwordConf = document.getElementById('confirm-password');
	var emailpatt = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var passpatt = new RegExp('.{7,}');
	var userpatt = new RegExp('^(?=(?![0-9])?[A-Za-z0-9]?[._-]?[A-Za-z0-9]+).{2,12}');

	if(typeof(Storage) !== 'undefined') {
		localStorage.setItem('username', username.value);
		localStorage.setItem('email', email.value);
		localStorage.setItem('pass', pass.value);
		localStorage.setItem('passwordConf', passwordConf.value);
	} else {
		console.log('Web storage not supported!');
	}

	if(username.value === '' || email.value === '' || pass.value === '' || passwordConf.value === '') {
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

	}
	return true;
}

function showComments(VidID){
$.getJSON("handler.php?action=comments&Vid_ID=" + VidID, true, function(data) {

		console.log(data);
		var comments = data;
		var commentBox = document.getElementById("comments_" + VidID);
		commentBox.innerHTML = '';

		var commentContainer = document.createElement('div');
		commentContainer.setAttribute('class', 'comment-list');
		commentBox.appendChild(commentContainer);

		for(var i = 0; i < comments.length; i++) {
			var comment = document.createElement('div');
			comment.setAttribute('id', comments[i].Comment_ID);
			comment.setAttribute('class', 'comment-entry');

			comment.innerHTML = '<a class="author-avatar" href=""><img class="avatar comment-avatar" src="' + comments[i].ClientImage + '" alt="Author Image"></a><p><a class="author-name" href="">' + comments[i].Username + '</a>' + comments[i].Comment_txt + '</p>';
			if(comments[i].owned == 1) {
					comment.innerHTML += '<a href="../controller/delete_comment_process.php?commentID=' + comments[i].Comment_ID + '" onclick="return confirm(\'Are you sure you want to delete this comment?\')"><button class="delete-comment">X</button></a>';
			}
			commentContainer.appendChild(comment);
		}
});
}

function checkusername(){
  var notification = document.getElementById("usernamenotification");
  if(username.length === 0){
    username.className = "input";
  } else {
    $.ajax({
      type: 'POST',
      url: '../controller/registration_check_process.php',
      data: {
        username: username.value
      },
      success: function(return_data) {
        if(return_data == "usernameOK"){
          document.getElementById("username").className = "input is-success";
          notification.innerHTML = "Username is available";
          notification.className = "help is-success";
          document.getElementById("regbtn").disabled = false;
          console.log(return_data);
        } else {
          document.getElementById("username").className = "input is-danger";
          notification.innerHTML = "Username is not available";
          notification.className = "help is-danger";
          document.getElementById("regbtn").disabled = true;
          console.log(return_data);
        }

      }
    });
  }
}

function checkemail(){
  var notification = document.getElementById("emailnotification");
  if(email.length === 0){
    email.className = "input";
  } else {
    $.ajax({
      type: 'POST',
      url: '../controller/registration_check_process.php',
      data: {
        email: email.value
      },
      success: function(return_data) {
        if(return_data == "emailOK"){
          document.getElementById("email").className = "input is-success";
          notification.innerHTML = "Email is not in use";
          notification.className = "help is-success";
          document.getElementById("regbtn").disabled = false;
          console.log(return_data);
        } else {
          document.getElementById("email").className = "input is-danger";
          notification.innerHTML = "Email is already in use";
          notification.className = "help is-danger";
          document.getElementById("regbtn").disabled = true;
          console.log(return_data);
        }

      }
    });
  }
}
