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

function checkusername(){
  var str = document.getElementById('username').value;
  var notification = document.getElementById("usernamenotification");
  if (str.length == 0){
    document.getElementById("username").className = "input";
  } else {
    var xmlhttp = new XMLHttpRequest();
    var data = "username="+str;
    xmlhttp.open("POST", "../controller/registration_check_process.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var return_data = this.responseText;
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
    }
    xmlhttp.send(data);
  }
}

function checkemail(){
  var str = document.getElementById('email').value;
  var notification = document.getElementById("emailnotification");
  if (str.length == 0){
    document.getElementById("email").className = "input";
  } else {
    var xmlhttp = new XMLHttpRequest();
    var data = "email="+str;
    xmlhttp.open("POST", "../controller/registration_check_process.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var return_data = this.responseText;
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
    }
    xmlhttp.send(data);
  }
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
    notification.innerHTML = "";
    document.getElementById("regbtn").disabled = false;
  }
}

function showComments(VidID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      var comments = JSON.parse(this.responseText);
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
    }
  };
  xhttp.open("GET", "handler.php?action=comments&Vid_ID=" + VidID, true);
  xhttp.send();
}
