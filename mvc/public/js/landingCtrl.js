

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function isLogedIn(){
  if(getCookie("username")!=""){//user logged in
    $("#modal_trigger").text("Welcome back, "+getCookie('username'));
    $("#modal_trigger").attr("href","/mvc/public/home/index");
  }
}

$( document ).ready(function() {
    isLogedIn();
});
