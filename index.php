<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AERO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container w-50">
      <div id="alerts" class="container">
        <?php
          session_start();
          if (isset($_SESSION['captchaError'])) {
            if ($_SESSION['captchaError']) {
              echo '<div class="alert alert-danger" role="alert">Перед отправкой формы нужно пройти капчу</div>';
              unset($_SESSION['captchaError']);
            }
          }

          if (isset($_SESSION['complete'])) {
            if ($_SESSION['complete']) {
              echo '<div class="alert alert-success" role="alert">Данные успешно добавлены</div>';
              unset($_SESSION['complete']);
            }
            else {
              if (isset($_SESSION['errors'])) {
                for ($i = 0; $i < count($_SESSION['errors']); $i++) {
                  echo '<div class="alert alert-danger" role="alert">'.$_SESSION['errors'][$i].'</div>';
                }
                unset($_SESSION['errors']);
              }
              
            }
          }
        ?>
      </div>
        <form action="academy.php" method="post">
            <div class="form-group">
              <label for="full_name">Фамилия Имя Отчество</label>
              <input type="text" class="form-control" id="full_name" name="full_name">
            </div>
            <div class="form-group">
              <label for="phone_number">Мобильный телефон</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="birthday">День рождения</label>
              <input type="date" class="form-control" id="birthday" name="birthday">
            </div>
            <div class="form-group">
              <label for="comment">Комментарий</label>
              <textarea rows="5" class="form-control" id="comment" name="comment"></textarea>
            </div>
            <div class="g-recaptcha" data-sitekey="6LdunJoUAAAAAAI431sCC-16UTe_I9vCHRz-6NhY"></div><br>
            <input type="submit" class="btn btn-primary mb-2" value="Отправить" name="submit">
          </form>
    </div>    
    
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>