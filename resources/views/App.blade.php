<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>To-do Tasks</title>

  <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.css') }}">

  <!-- <meta name="google-signin-client_id" content="1085217040510-u95lg3eg8so8hgtun4t0b56ni98mn828.apps.googleusercontent.com" /> -->
  <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
</head>

<body class="vw-100 vh-100">
  <div id="app"></div>


  <script src="{{ asset('public/js/app.js') }}"></script>
  
  <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div>
  <a href="#" onclick="signOut();">Sign out</a>
  <script>

    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      console.log("ID: " + profile.getId()); // Do not send to your backend! Use an ID token instead.
      console.log("Name: " + profile.getName());
      console.log("Image URL: " + profile.getImageUrl());
      console.log("Email: " + profile.getEmail()); // This is null if the 'email' scope is not present.
    }

    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function() {
        console.log('fui ...');
      });
    } -->
  </script>
</body>

</html>