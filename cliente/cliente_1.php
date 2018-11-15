<?php

    function suma($url, $post) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        $data = array(
            'user' => 'user',
            'password' => '12345',
            'a' => $post['a'],
            'b' => $post['b'],
        );

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    $datos = null;
    if (isset($_POST)) {
        include_once 'nusoap.php';
        $urls = array(
            '1' => 'http://132.248.63.20/sitio2/public/index.php/suma',
            '2' => 'http://132.248.63.141/sitio1/phpmicroservices/server.php?wsdl',
            '3' => 'http://132.248.63.140/ms/server.php?wsdl',
            '4' => 'http://132.248.63.140/ms/server.php?wsdl',
            '5' => 'http://orion.dgsca.unam.mx/ms/server.php?wsdl',
            '6' => 'https://www.althek.com/ws/server.php?wsdl'
        );
        $result = null;
        $urlSelec = (isset($urls[$_POST['operacion']])) ? $urls[$_POST['operacion']] : $urls['1'];
        switch ($_POST['operacion']) {
            case '1':
                $result = suma($urlSelec, $_POST);
                break;
            case '2':
                $datos = array(
                    'username' => 'karla',
                    'password' => '1234',
                    'num1' => $_POST['a'],
                    'num2' => $_POST['b']
                );
                $datos = array('datos' => json_encode($datos));
                $funcion = "resta";
                break;
            case "3":
                $datos = array(
                    'numeros' => "{$_POST['a']}, {$_POST['b']}",
                    'datos' => json_encode(array(
                        'username' => 'admin',
                        'password' => '9542931e640c671a60ea44a954b249c179da1239'
                    ))
                );
                $funcion = "multiplicacion";
                break;
            case '4':
                $datos = array(
                    'numeros' => "{$_POST['a']}, {$_POST['b']}",
                    'datos' => json_encode(array(
                        'username' => 'admin',
                        'password' => '9542931e640c671a60ea44a954b249c179da1239'
                    ))
                );
                $funcion = "division";
                break;
            case '5':
                $datos = json_encode(array(
                    'numero' => $_POST['a'],
                    'usu_email' => 'malag@unam.mx',
                    'usu_passwd' => '1234.',
                ));
                $funcion = "calcularRaiz";
                break;
            case '6':
                $datos = array(json_encode(array(
                        'username' => 'usrexpo',
                        'password' => '9542931e640c671a60ea44a954b249c179da1240',
                        'valor' => "{$_POST['a']}",
                        'exponente' => "{$_POST['b']}",
                )));
                $funcion = "obtenerRegistros";
                break;
        }
        if (!empty($datos)) {
            $cliente = new nusoap_client($urlSelec, true);
            $result = $cliente->call($funcion, $datos);
        }

        var_dump($result);
    }