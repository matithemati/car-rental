<?php

    session_start();

    if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true) {
        header('Location: ./dashboard.php');
    }

    if(!empty($_POST)) {

        require('sql_connect.php');

        $nick = trim($_POST['nick']);
        $password = hash('whirlpool', trim($_POST['password']));

        if($nick == "" || $password == "") {
            die("Login lub hasło puste!");
        }

    }

    else {
        header('Location: ./login.html');
    }

    $sql = "SELECT password FROM users WHERE name = ?";

    if($statement = $mysqli->prepare($sql)) {
        if($statement->bind_param('s', $nick)) {
            $statement->execute();
            $result = $statement->get_result();
            $row = $result->fetch_row();
            if(empty($row)) {
                die("Niepoprawne dane!");
            }
            $user_password = $row[0];

            if($user_password == $password) {
                $_SESSION['isLogged'] = true;
                header('Location: ./dashboard.php');
            }

            else {
                die("Niepoprawne dane!");
            }
        }
        $mysqli->close();
    }

  