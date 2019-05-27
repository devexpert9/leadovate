<style>
.signin .g-signin2
{
    margin-top: 9px;
    width: 100%;
}
.abcRioButtonIcon
{
    padding: 13px !important;
}
.abcRioButtonBlue {
    height: 46px !important;
    width: 100% !important;
}
</style><script>
var access_token='';
  function statusChangeCallback(response) {
      
    console.log('statusChangeCallback');
    access_token = response.authResponse.accessToken;;
    console.log(response);
    if (response.status === 'connected') {
      testAPI();
    } else {
     
    }
  }
   window.fbAsyncInit = function() {
    FB.init({
      appId      : '2276479122610429',
      cookie     : true,  
                          
      xfbml      : true,  
      version    : 'v3.2' 
    });
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    }); 
  };
 function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,first_name,last_name,picture,email,permissions', function(response) {
        console.log(response);
        console.log(access_token);
                var picture = response.picture.data.url;
                var data = { fb_id:response.id,first_name:response.first_name,last_name:response.last_name,
                            email:response.email,image:picture}; 
                 var token=$('input[name="_token"]').val();
              
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url:'{{url("user/facebooklogin")}}',
                    type:'post',
                    data: data,
                    dataType:'json',
                    success:function(response2)
                    {
                        console.log(response2);
                        if(response2.erro==101)
                        {
                            $('.as1').html(response2.message).show(); 
                            setTimeout(function(){ $('.as1').hide(); }, 5000);
                            FB.logout(function (response) {
                            location.href=response2.url;
                            });
                        }
                        else
                        { 
                          $('.dg1').html(response2.message).show(); 
                          setTimeout(function(){ $('.dg1').hide(); }, 5000);
                        }
                       
                    }
                });
    });
  }
  
  document.getElementById('fbloginbtn').addEventListener('click', function() {
   
  FB.login(statusChangeCallback);
}, false);
      function onSignIn(googleUser) {
       
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); 
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
         googleUser.getBasicProfile().getName();
              console.log(googleUser.getBasicProfile());
              
            var email=  googleUser.getBasicProfile().getEmail();
            var first_name = googleUser.getBasicProfile().ofa;
            var  last_name = googleUser.getBasicProfile().wea;
            var picture=    googleUser.getBasicProfile().getImageUrl();
            var profile = googleUser.getBasicProfile();
              $.ajax({
                   headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url:'{{url("user/googlelogin")}}',
                    type:'post',
                 data:{g_id:profile.getId(),email:email,image:picture,first_name:first_name,last_name:last_name},dataType:'json',
                  success:function(response)
                  {
                     
                      console.log(response);
                      if(response.erro==101)
                        {
                            $('.as1').html(response.message).show(); 
                            setTimeout(function(){ $('.as1').hide(); }, 5000);
                            var auth2 = gapi.auth2.getAuthInstance();
                            auth2.signOut().then(function () {
                            location.href=response.url;
                           
                            });
                        }
                        else
                        { 
                          $('.dg1').html(response.message).show(); 
                          setTimeout(function(){ $('.dg1').hide(); }, 5000);
                        }
                  }
              });
      };
    </script>