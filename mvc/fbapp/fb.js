function statusChangeCallback(response) {
	console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
    	// Logged into your app and Facebook.
      	
        //var fbid;
        //var fbname;
        FB.api('/me', function(response) {
          alert('Your name is ' + response.name +'id: '+ response.id + ':email:' + response.email);
          //fbid = response.id;
          //fbname = response.name;
          if(document.cookie.indexOf("fbid") < 0){
            document.cookie = "fbid="+response.id+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
          }

          if(document.cookie.indexOf("fbname") < 0){
              document.cookie = "fbname="+response.name+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
          }
        });
        window.location = window.location.origin + "/mvc/public/home";
        //window.location.replace('loginSuccess');
/*      
        if(document.cookie.indexOf("fbid") < 0){
            document.cookie = "fbid="+fbid+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
        }

        if(document.cookie.indexOf("fbname") < 0){
            document.cookie = "fbname="+fbname+"; expires="+(Date.now()+(86400 * 30))+"; path=/";
        }
*/
    } else if (response.status === 'not_authorized') {
      	// The person is logged into Facebook, but not your app.
    } else {
      	// The person is not logged into Facebook, so we're not sure if
      	// they are logged into this app or not.
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
	FB.init({
	appId      : '116488348813741',
	cookie     : true,  // enable cookies to allow the server to access 
	                    // the session
	xfbml      : true,  // parse social plugins on this page
	version    : 'v2.7' // use any version
});
	
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
