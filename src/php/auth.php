<?php

function authorize() {
    ?>
    <script src="http://localhost:8080/js/keycloak.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        const keycloak = new Keycloak('http://localhost:8000/keycloak.json');
        const initOptions = {
            responseMode: 'fragment',
            flow: 'standard',
            onLoad: 'check-sso',
            silentCheckSsoRedirectUri: window.location.origin + '/silent-sso-check.html',
        };

        function logout() {
            Cookies.remove('token');
            Cookies.remove('callback');
            keycloak.logout();
        }

        keycloak.init(initOptions).then(function(authenticated) {
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
    <?php
}
?>