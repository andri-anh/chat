<?php
    session_start();
    require_once("../Models/findBySession.php");

    if (!isset($_SESSION['ip'])) {
        header('Location: /login.php');
    } else {
        if ($data['status'] === 1) {
            $state = <<<HTML
                <p class="text-success small">En ligne</p>
            HTML;
        } else $state = <<<HTML
                    <p class="text-success small">Hors ligne</p>
                HTML;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/app.css">
    <title>Utilisateurs</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-fluid">
            <div class="login mx-auto bg-light rounded px-3" id="listUsers" style="height: 600px;">
                <header class="d-flex align-items-center justify-content-between position-relative">
                    <div class="contenu d-flex align-items-center">
                        <img src="../public/uploads/images/<?= $data['fileName'] ?>" alt="">
                        <div class="align-items-center pt-3 pl-1">
                            <span class=" text-black">
                                <?= $data['userName'] ?>
                            </span>
                            <?= $state ?>
                        </div>
                    </div>
                    <a href="../Controllers/logout.php?logout_code=<?= $data['unique_id'] ?>"><i class="fa fa-sign-out"></i></a>
                </header>
                <div class="separation"></div>
                <div class="rechercher d-flex align-items-center py-4 form-group">
                    <input type="text" name="search" id="search" class="mt-2" placeholder="Rechercher votre amies . . .">
                    <button class="text-primary mt-2 btn_search ml-1">
                        <i class="fa fa-search search" style="font-size: 16px;"></i>
                    </button>
                </div>

                <div class="pb-1 contenu_recherche">

                </div>

            </div>
        </div>
    </div>
    <script src="../public/assets/js/users.js"></script>
</body>

</html>