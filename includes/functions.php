<?php
include_once 'psl-config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Asigna un nombre personalizado para la sesión.
    $secure = SECURE;
    // Esto impide que JavaScript pueda acceder al id de la sesión.
    $httponly = true;
    // Forza a las sesiones a solo usar cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Obtiene los parámetros de las cookies actuales.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Asigna el nombre de sesión al que se asignó arriba.
    session_name($session_name);
    session_start();            // Inicia la sesión de PHP.
    session_regenerate_id();    // Regenera la sesión, elimina la anterior.
}
function login($usuario, $password, $mysqli) {
    // Usar sentencias preparadas significa que no es posible SQL injection.
    if ($stmt = $mysqli->prepare("SELECT id, username, nombre, password, salt, type 
        FROM members
       WHERE username = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $usuario);  // Asigna "$usuario" al parámetro.
        $stmt->execute();    // Ejecuta la sentencia preparada.
        $stmt->store_result();
 
        // Obtiene las variables de result.
        $stmt->bind_result($user_id, $username, $nombre, $db_password, $salt, $type);
        $stmt->fetch();
 
        // hash la contraseña con la salt única.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // SI el usuario existe podemos checar si la cuenta está bloqueda
            // por demasiados intentos de inicio.
 
            if (checkbrute($user_id, $mysqli) == true) {
                // La cuenta está bloqueada
                // Aquí se podría mandar un email al usuario para decirle que su cuenta está bloqueda
                return false;
            } else {
                // Verifica que la contraseña en la base de datos coincida
                // con la contraseña que se ingresó.

                if ($db_password == $password) {
                    // La contraseña es correta!
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // Protección XSS ya que se podría imprimir este valor
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['type'] = $type;
                    // Protección XSS ya que se podrías imprimir este valor
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login exitoso.
                    return true;
                } else {
                    // La contraseña no es correcta
                    // Se guarda este intento en la base de datos.
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No exist el usuario
            return false;
        }
    }
}
function checkbrute($user_id, $mysqli) {
    // Obtiene el timestamp del tiempo actual.
    $now = time();

    // Todos los intentos de login son contados desde las dos horas anteriores.
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Ejecuta la sentencia preparada.
        $stmt->execute();
        $stmt->store_result();
 
        // Si ha habido más de cinco intentos de login
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}
function login_check($mysqli) {
    // Verifica que todas las variables de sesión estén asignadas.
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Obtiene la string del agente de usuario del usuario
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Asigna "$user_id" al parámetro. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Ejecuta la sentencia preparada.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Si el usuario existe obtiene las variables de result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // No entró al sistema.
                    return false;
                }
            } else {
                // No entró al sistema. 
                return false;
            }
        } else {
            // No entró al sistema.
            return false;
        }
    } else {
        // No entró al sistema.
        return false;
    }
}
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Solo interesan links relativos de $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
?>