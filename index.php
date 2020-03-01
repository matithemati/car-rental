<?php
require('functions.php');
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <script src="https://kit.fontawesome.com/50d529df22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" />

    <title>Car rental</title>
  </head>
  <body>
    <!---header--->
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark pl-4">
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item pr-3">
              <a class="nav-link">HOME</a>
            </li>
            <li class="nav-item pr-3">
              <a class="nav-link" onclick="smoothScroll('#available')">
                DOSTĘPNE AUTA
              </a>
            </li>
            <li class="nav-item pr-3">
              <a class="nav-link" onclick="smoothScroll('#unavailable')">
                OBECNIE ZAREZERWOWANE
              </a>
            </li>
            <li class="nav-item pr-3">
              <a class="nav-link" onclick="smoothScroll('#reservation')">
                ZAREZERWUJ
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container h-75 d-flex align-items-center">
        <div class="row">
          <div class="col-12">
            <h1 class="text-white font-weight-bold">
              WYPOŻYCZALNIA SAMOCHODÓW
            </h1>
          </div>
          <div class="col-12">
            <div class="row mt-5 d-flex">
              <button
                class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold"
                onclick="smoothScroll('#available')"
              >
                OFERTA
              </button>
              <button
                class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold"
                onclick="smoothScroll('#reservation')"
              >
                REZERWUJ
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!---header-end--->

    <!---available-->

    <section id="available" class="pt-4 pb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center pt-4 pb-4">
              DOSTĘPNE SAMOCHODY
            </h1>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <?php
            $rows = get_cars('available');
            foreach($rows as $row) {
              echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
              echo '<div class="card">';
              echo '<img src="assets/'.$row['photo_url'].'" class="card-img-top" alt="car" />';
              echo '<div class="card-body">';
              echo '<h5 class="card-title text-center">'.$row['name'].'</h5>';
              echo '<p class="text-center">'.$row['type'].'</p>';
              echo '<p class="text-center font-weight-bold">'.$row['price'].' zł/h</p>';
              echo '<button class="btn btn-primary col-12" onclick="reserve('.$row['id'].');calculate_price('.$row['price'].')">REZERWUJ</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          ?>
        </div>
      </div>
    </section>

    <!---available-end-->

    <!--unavailable-->

    <section id="unavailable" class="pt-4 pb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center pt-4 pb-4">
              OBECNIE ZAREZERWOWANE
            </h1>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <?php
            $rows = get_cars('unavailable');
            foreach($rows as $row) {
              echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
              echo '<div class="card">';
              echo '<img src="assets/'.$row['photo_url'].'" class="card-img-top" alt="car" />';
              echo '<div class="card-body">';
              echo '<h5 class="card-title text-center">'.$row['name'].'</h5>';
              echo '<p class="text-center">'.$row['type'].'</p>';
              echo '<p class="text-center font-weight-bold">'.$row['price'].' zł/h</p>';
              echo '<button class="btn btn-danger col-12 disabled">DOSTĘPNY OD '.substr($row['to_date'], 0, -3).'</button>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          ?>
        </div>
      </div>
    </section>

    <!--unavailable-end-->

    <!--reservation-form-->
    <section id="reservation">
      <div class="container-fluid">
        <h1 class="text-center pt-4 pb-4 font-weight-bold">ZAREZERWUJ</h1>
        <div class="row">
          <div class="col-12 text-center text-danger">
            <h3><span id="amount">0 zł</span></h3>
          </div>
          <div class="col-12 d-flex justify-content-center pt-2 pb-2 text-white">
            <form action="reserve.php" method="POST">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">Imię</label>
                    <input
                      class="form-control"
                      type="text"
                      name="name"
                      id="name"
                      placeholder="Podaj imię"
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="surname">Nazwisko</label>
                    <input
                      class="form-control"
                      type="text"
                      name="surname"
                      id="surname"
                      placeholder="Podaj nazwisko"
                      required
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="phone">Telefon</label>
                <input
                  type="tel"
                  name="phone"
                  class="form-control"
                  placeholder="Podaj numer telefonu"
                  required
                />
              </div>
              <div class="form-group">
                <label for="car">Samochód</label>
                <select name="car" class="form-control" id="car">
                <?php
                  $rows = get_cars('select');
                  foreach($rows as $row) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                  }
                ?>
                </select>
              </div>
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="date">Termin</label>
                    <input
                      class="form-control"
                      type="datetime-local"
                      name="date"
                      id="date"
                      required
                    />
                  </div>
                </div>
                <div class="col-sm-7">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="days">Dni</label>
                        <input
                          class="form-control"
                          type="number"
                          name="days"
                          id="days"
                          min="0"
                          max="13"
                        />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="hours">Godzin</label>
                        <input
                          class="form-control"
                          type="number"
                          name="hours"
                          id="hours"
                          min="0"
                          max="23"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-4 mb-3">
                  <input type="submit" value="ZAREZERWUJ" class="btn btn-danger col-12">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!--reservation-form-end-->

    <button onclick="smoothScroll('header')" id="up-button"></button>

    <!--footer-->
    <footer class="page-footer font-small p-3">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center">
              <a href="https://www.facebook.com/MatiTheMati" target="_blank">
                <i class="fab fa-facebook p-4 fa-3x text-primary"></i>
              </a> 
              <a href="https://github.com/matithemati" target="_blank">
                <i class="fab fa-github p-4 fa-3x text-dark"></i>
              </a> 
              <a href="https://www.linkedin.com/in/mateusz-furtak-986ab81a2/" target="_blank">
                <i class="fab fa-linkedin p-4 fa-3x linkedin"></i>
              </a> 
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--footer-end-->

    <!-- Optional JavaScript -->

    <script src="js/script.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
