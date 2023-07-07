<?php

$role="default";
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
        function hasRole(role) {
            return keycloak.hasRealmRole(role);
        }

        keycloak.init(initOptions).success(function(authenticated) {
            if (authenticated) {
                // User is logged in
                Cookies.set('token', keycloak.token);
                console.log(keycloak.hasRealmRole("quiz_creator"));
                console.log(keycloak.hasRealmRole("quiz_approver"));
                
                if(keycloak.hasRealmRole("quiz_creator")){
                    console.log();
                    Cookies.set('role', "quiz_creator");
                    //$role="quiz_creator";
                    //location.href = "dashboard.php?role=quiz_creator";
                }
                else if(keycloak.hasRealmRole("quiz_approver")){
                    Cookies.set('role', "quiz_approver");
                    //$role="quiz_approver";
                    //location.href = "dashboard.php?role=quiz_approver";
                }
            } else {
                // User is not logged in, redirect to login page
                console.log("Redirect to login page ");
                keycloak.login();
            }
        }).error(function() {
            console.log('Init Error');
        });
    </script>