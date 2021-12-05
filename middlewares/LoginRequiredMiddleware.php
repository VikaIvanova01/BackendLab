<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        $sql = <<<EOL
SELECT * FROM users WHERE username = :username AND password = :password
EOL;

        $query = $controller->pdo->prepare($sql);
        $query->bindValue("username", $user);
        $query->bindValue("password", $password);
        $query->execute();

        $data = $query->fetch();

            if (!$data) {
            header('WWW-Authenticate: Basic realm="Mutants objects"');
            http_response_code(401);
            exit;
        }
    }
}