<?php
    if (session_start() && isset($_SESSION['ip'])) {
        header('Location: utilisateurs.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/app.css">
    <title>Login</title>
</head>

<body>
    <?php include('./Layouts/header.php');  ?>

    <div class="d-flex justify-content-center align-items-center vh-100 mt-max">
        <div class="container-fluid">
            <div class="login mx-auto bg-light rounded px-3 position-relative">
                <form action="" method="POST" id="formLogin">
                    <h4 class="pt-3 mb-3">Connexion</h4>
                    <div class="separation mb-5"></div>
                    <p class="alert alert-danger py-1 text-center"></p>
                    <p class="alert alert-success py-1 text-center"></p>
                    <div class="form-group">
                        <label for="email" class="mt-2 mb-2 float-start">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password" class="mt-4 mb-2 float-start">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <i class="fa fa-eye" id="eye"></i>
                    </div>
                    <div class="form-group mt-3 text-center small">
                        <a href="/">Je n'ai pas encore de compte</a> <span class="text-muted">|</span>
                        <a href="#"> mot de passe oublié?</a>
                    </div>
                    <div class="form-group pb-3 pt-2">
                        <button type="submit" class="btn btn-info col-12 text-light fw-bold mt-4" id="btnLogin">SE CONNECTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../public/assets/js/connexion.js"></script>
    <script src="../public/assets/js/Files/mdp_afficher_cacher.js"></script>
</body>

</html>