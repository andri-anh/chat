<?php
session_start();

if (isset($_SESSION['ip'])) {
    include_once("../Models/DataBase/Db_connexion.php");

    $sendMessage = htmlspecialchars($_POST['sendMessageId']);
    $receiveMessage = htmlspecialchars($_POST['receiveMessageId']);
    $output = "";

    $chat = $db_connexion->query("SELECT * FROM messages 
    LEFT JOIN utilisateurs ON utilisateurs.unique_id = messages.receive_message_id
    WHERE ((send_message_id='{$sendMessage}' AND receive_message_id='{$receiveMessage}') OR (send_message_id='{$receiveMessage}' AND receive_message_id='{$sendMessage}')) ORDER BY msg_id ASC");

    if ($chat->rowCount() > 0) {
        $msgs = $chat->fetchAll();
        foreach ($msgs as $msg) {
            $id_pers = $msg['send_message_id'];
            $perso = $db_connexion->prepare("SELECT * FROM utilisateurs WHERE unique_id = ?");
            $perso->execute([$id_pers]);
            $user = $perso->fetch();

            $sendMessage = (int) $sendMessage;
            if ($msg['send_message_id'] === $sendMessage) {
                $output .= '<div class="message_recu pb-1">
                                <div class="receiveContent d-flex align-items-end">
                                    <div class="send pb-0 px-2 ml-auto ml-2">
                                        <p class="mt-1 mb-1">
                                            ' . $msg['msg'] . '
                                        </p>
                                    </div>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="message_recu pb-1">
                                <div class="receiveContent d-flex align-items-end">
                                    <img src="../public/uploads/images/' . $user['fileName'] . '" alt="' . $user['userName'] . '">
                                    <div class="receive pb-0 px-2 mr-auto ml-2">
                                        <p class="mt-1 mb-1">
                                            ' . $msg['msg'] . '
                                        </p>
                                    </div>
                                </div>
                            </div>';
            }
        }
        echo $output;
    } else {
        echo <<<HTML
                <div class="text-center" style="padding-top: 100px;">
                    <i class="fa fa-wechat fa-4x text-primary" style="text-shadow: 0 0 6px"></i>
                    <p class="mt-4 text-muted">Commencez votre conversation !</p>
                </div>
            HTML;
    }
} else header("../views/login.php");
