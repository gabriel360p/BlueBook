<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlueBook</title>
  <link rel="icon" type="image/x-icon" href="/img/logos/bluebook-white-on-transparent.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
.card-img-left {
  width: 45%;
  background: scroll center url('/img/logos/bluebook-high-resolution-color-logo.png');
  background-position: center;
  background-size: cover;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
}

</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
       <a class="nav-item nav-link" href="/register">Cadastrar-se</a> 
       <a class="nav-item nav-link" href="/login">Login</a> 
       <!-- <a class="nav-item nav-link disabled" href="#">Sobre</a>  -->
    </div>
  </div>
</nav>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
              <hr>
            <form class="form-group" method="POST" action="/login">
              <div class="form-floating mb-3">
                <label for="floatingInputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com">
                @foreach ($errors->email as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </div>


              <div class="form-floating mb-3">
                <label for="floatingPassword">Senha</label>
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                @foreach ($errors->password as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </div>

              <div class="d-grid mb-2">
                <button class="btn btn-primary" type="submit">Login</button>
              </div>

              <a class="d-block text-center mt-2 small" href="#">Não tem conta? Cadastrar-se</a>

              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>