<?php
session_start();

if (isset($_SESSION['ip'])) {
    include_once("../Models/DataBase/Db_connexion.php");

    $sendMessage = htmlspecialchars($_POST['sendMessageId']);
    $receiveMessage = htmlspecialchars($_POST['receiveMessageId']);
    $message = htmlspecialchars($_POST['inputMessage']);

    if (!empty($message)) {
        $request = $db_connexion->prepare("INSERT INTO messages(receive_message_id, send_message_id, msg) VALUES (:receive_message_id, :send_message_id, :msg)");

        if ($request) {
            $request->execute([
                'receive_message_id' => $receiveMessage,
                'send_message_id' => $sendMessage,
                'msg' => $message
            ]);
        }
    }
} else header("../views/login.php");
