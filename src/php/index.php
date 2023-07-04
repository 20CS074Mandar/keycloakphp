<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Service PHP APP</title>
</head>
<body>
  <button onclick="logout()" class="btn btn-danger">Logout</button>
  <script src="http://localhost:8080/auth/js/keycloak.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
  <script type="text/javascript">
    const keycloak = Keycloak('http://localhost:8000/keycloak.json');
    const initOptions = {
      responseMode: 'fragment',
      flow: 'standard',
      onLoad: 'login-required',
    };

    function logout() {
      Cookies.remove('token');
      Cookies.remove('callback');
      keycloak.logout();
    }

    keycloak.init(initOptions).success(function(authenticated) {
      if (authenticated) {
        // User is logged in
        Cookies.set('token', keycloak.token);
        Cookies.set('callback', JSON.stringify(keycloak.tokenParsed.resource_access.testclient.roles));
        var arr = JSON.parse(Cookies.get('callback'));
        arr = arr.reduce((index, value) => (index[value] = true, index), {});
        console.log("token stored in cookies");
      } else {
        // User is not logged in, redirect to login page
        console.log("Redirect to login page ");
       keycloak.login();
      }
    }).error(function() {
      console.log('Init Error');
    });
  </script>

  <h1>index</h1>

  <a href="home.php">Home</a>
  <a href="dashboard.php">dash</a>
  <a href="profile.php">profile</a>
  <a href="index.php">index</a>

</body>
</html>
