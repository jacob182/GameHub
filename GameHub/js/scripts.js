window.onload = function() {
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
}

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

        comment.innerHTML = '<a class="author-avatar" href=""><img class="avatar comment-avatar" src="../images/profile_images/test.jpg" alt="Author Image"></a><p><a class="author-name" href="">' + comments[i].Username + '</a>' + comments[i].Comment_txt + '</p>';
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
