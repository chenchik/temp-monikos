//header user popup
function toggleMenuNav() {
    if($('#menu-popup').css('visibility') == 'hidden') {
        document.getElementById("menu-popup").style.visibility = "visible";
        document.getElementById("menu-popup").style.opacity = 1;


    } else {
        document.getElementById("menu-popup").style.visibility = "hidden";
        document.getElementById("menu-popup").style.opacity = 0;

    }
}

//logout
function logout()  {
    console.log("loggedout");
    if(document.cookie.indexOf("user_id") > 0){
        document.cookie = "user_id=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
    }
    if(document.cookie.indexOf("username") > 0){
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
    }

    window.location = window.location.origin + "/mvc/public/account/login";

}