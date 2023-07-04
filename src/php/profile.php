<h1>profile</h1>

<script src="http://localhost:8080/auth/js/keycloak.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
  <script type="text/javascript">
    const keycloak = Keycloak('http://localhost:8000/keycloak.json');
    const initOptions = {
      responseMode: 'fragment',
      flow: 'standard',
      onLoad: 'check-sso',
      silentCheckSsoRedirectUri: window.location.origin + 'src/php/silent-check-sso.html',
    };

    function logout() {
      Cookies.remove('token');
      Cookies.remove('callback');
      keycloak.logout();
    }

    keycloak.init(initOptions).success(function(authenticated) {
        console.log("User is already logged in  ");
        console.log(keycloak.token);
      Cookies.set('token', keycloak.token);
      console.log(keycloak.tokenParsed.resource_access.testclient.roles);
      Cookies.set('callback', JSON.stringify(keycloak.tokenParsed.resource_access.testclient.roles));
      var arr = JSON.parse(Cookies.get('callback'));
      arr = arr.reduce((index, value) => (index[value] = true, index), {});
      console.log("token stored in cookies");
    }).error(function() {
        console.log("Redirect to login page ");
      console.log('Init Error');
    });
  </script>

<a href="home.php">Home</a>
    <a href="dashboard.php">dash</a>
    <a href="profile.php">profile</a>
    <a href="index.php">index</a>