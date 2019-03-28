<?php
    session_start();
    require_once 'connection.php';

    if (isset($_POST['submit'])) {
      $secretKey = "6LdunJoUAAAAAFN5ULh1o05oLlzoGj2REhKjH1lO";
      $responseKey = $_POST['g-recaptcha-response'];
      $userIP = $_SERVER['REMOTE_ADDR'];

      $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
      $response = file_get_contents($url);
      $response = json_decode($response);
      if ($response->success) {
        $full_name = htmlspecialchars($_POST["full_name"]);
        $phone_number = htmlspecialchars($_POST["phone_number"]); 
        $email = htmlspecialchars($_POST["email"]);
        $birthday = htmlspecialchars($_POST["birthday"]);
        $comment = htmlspecialchars($_POST["comment"]);

        $errors = array();
        if ($full_name == "" || $phone_number == "" || $email == "" || $birthday == "" || $comment == "") {
          array_push($errors, "Заполните все поля!");
        }

        $name = explode(" ", $full_name);
        if (count($name) != 3) {
          array_push($errors, "Введите Фамилию, Имя и Отчество!");
        }
        else {
          if (!preg_match('/[а-яё]/iu', $name[0]) || !preg_match('/[а-яё]/iu', $name[1]) || !preg_match('/[а-яё]/iu', $name[2])) {
            array_push($errors, "ФИО может содержать только кириллицу!");
          }
        }        

        if (!preg_match('/^(8|\+7)\d{10}$/', $phone_number)) {
          array_push($errors, "Неверный формат телефона!");
        }

        if (!preg_match('/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z]+$/', $email)) {
          array_push($errors, "Неверный формат E-mail!");
        }

        if (count($errors) == 0) {
          $db = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($db));;
          
          mysqli_query($db, "SET NAMES 'utf8mb4'");

          $full_name = mysqli_real_escape_string($db ,$full_name);
          $phone_number = mysqli_real_escape_string($db ,$phone_number);
          $email = mysqli_real_escape_string($db ,$email);
          $comment = mysqli_real_escape_string($db ,$comment);

          $query = 'INSERT INTO academy (fullname, phonenumber, email, birthday, comment) VALUES (?, ?, ?, ?, ?);';
          $statement = $db->prepare($query);
          $statement->bind_param("sssss", $full_name, $phone_number, $email, $birthday, $comment);
          $statement->execute();

          mysqli_close($db);
          $_SESSION['complete'] = true;
        }
        else {
          $_SESSION['errors'] = $errors;
          $_SESSION['complete'] = false;
        }
      }
      else {
        $_SESSION['captchaError'] = true;
      }
    }
    echo 'Complete';
    header('Location: /index.php');
?>