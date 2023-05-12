<?php
    session_start();
    if (!isset($_SESSION['ip'])) {
        header('Location: /login.php');
    } 

    if (isset($_GET['code'])) {
        $session = $_SESSION['ip'];
        $open = 1;
        include_once("../Models/DataBase/Db_connexion.php");
        $check = $db_connexion->prepare("UPDATE messages SET opened = '{$open}' where receive_message_id = ?");
        
        if ($check) {
            $check->execute([$session]);
        }
    }

    require_once("../Models/getIp.php");
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
            <div class="login mx-auto bg-light rounded px-3 position-relative" style="height: 600px;">
                <header class="d-flex align-items-center justify-content-between">
                    <div class="contenu d-flex align-items-center">
                        <a href="./utilisateurs.php" class="pr-4 text-muted fs-4"><i class="fa fa-long-arrow-left"></i></a>
                        <img src="../public/uploads/images/<?= $data['fileName'] ?>" alt="">
                        <div class="align-items-center pt-3 pl-1">
                            <span class=" text-black"><?= $data['userName'] ?></span>
                            <p class="text-success small">En ligne</p>
                        </div>
                    </div>
                    <a href=""><i class="fa fa-ellipsis-h"></i></a>
                </header>
                <div style="height:478px">
                    <div class="separation"></div>
                    <div class="pt-3 pb-0 text-center">
                        <p class="btn btn-outline-secondary px-5 py-1">Messages plus anciens</p>
                    </div>

                    <div class="pb-1 discutionContent">
                        
                    </div>
                </div>

                <form action="#" class="d-flex" id="formMessage" autocomplete="off">
                    <input type="text" name="sendMessageId" id="sendMessageId" value="<?= $_SESSION['ip'] ?>" hidden>
                    <input type="text" name="receiveMessageId" id="receiveMessageId" value="<?= $id_pers ?>" hidden>
                    <input type="text" name="inputMessage" id="inputMessage" class="form-control mr-2" placeholder="Saisissez votre message . . .">
                    <button type="submit" class="btn btn-outline-secondary btnSendMssg"><i class="fa fa-send-o"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/assets/js/chatContent.js"></script>
</body>

</html>