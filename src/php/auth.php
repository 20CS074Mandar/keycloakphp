<?php

function authorize() {
    ?>
    <script src="http://localhost:8000/js/keycloak.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        const keycloak = new Keycloak('http://localhost:8080/keycloak.json');
        const initOptions = {
            responseMode: 'fragment',
            flow: 'standard',
            onLoad: 'check-sso',
            silentCheckSsoRedirectUri: window.location.origin + '/silent-sso-check.html',
        };

        function logout() {
            keycloak.logout();
        }

        keycloak.init(initOptions).success(function(authenticated) {
            if (authenticated) {
                // User is logged in
                Cookies.set('token', keycloak.token);
            } else {
                // User is not logged in, redirect to login page
                console.log("Redirect to login page ");
                keycloak.login();
            }
        }).error(function() {
            console.log('Init Error');
        });
        function hasRole(roles){
            const hasRole = (roles) => roles.some((role) => keycloak.hasRealmRole(role));
            return hasRole;
        }
    </script>
    <?php
}
?>
