<?php
    if (session_start() && isset($_SESSION['ip'])) {
        header('Location: views/utilisateurs.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/app.css">
    <title>Chat messenger avec php</title>
</head>

<body>
    <?php include('./views/Layouts/header.php')  ?>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-fluid">
            <div class="login mx-auto bg-light rounded px-3 position-relative registration">
                <form action="" method="" id="formRegister" enctype="multipart/form-data" class="">
                    <h4 class="pt-4 mb-3">Inscription</h4>
                    <div class="separation mb-5"></div>

                    <p class="alert alert-danger py-1 text-center col-12"></p>
                    <p id="alertSuccess" class="alert alert-success py-1 text-center col-12"></p>
                    
                    <div class="form-group">
                        <label for="userName" class="mt-2 mb-2 float-start">Nom d'utilisateur</label>
                        <input type="text" name="userName" id="userName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email" class="mt-4 mb-2 float-start">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image" class="mt-4 mb-2 float-start">Photo de profile</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-4 mb-2 float-start">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <i class="fa fa-eye" id="eye"></i>
                    </div>
                    <div class="form-group float-end mt-3 small">
                        <a>Déjà un compte?</a>
                        <a href="/views/login.php">Connectez-vous.</a>
                    </div>
                    <div class="form-group pb-4 pt-5">
                        <button type="submit" class="btn btn-info col-12 text-light fw-bold mt-4" id="btnRegistration">S'INSCRIRE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./public/assets/js/register.js"></script>
    <script src="./public/assets/js/Files/mdp_afficher_cacher.js"></script>
</body>

</html>