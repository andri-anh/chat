<?php
session_start();
include_once("../Models/DataBase/Db_connexion.php");

$sendId = $_SESSION['ip'];
$request = $db_connexion->query("SELECT * FROM utilisateurs WHERE NOT unique_id = '{$sendId}' ORDER BY id DESC");
$results = $request->fetchAll();
$output = "";

if ($request->rowCount() == 0) {
    $output .= "Il n'y a pas d'utilisateur disponible pour le moment.";
} elseif ($request->rowCount() > 0) {

    foreach ($results as $result) {
        $stmt = $db_connexion->query("SELECT * FROM messages 
                LEFT JOIN utilisateurs ON utilisateurs.unique_id = messages.receive_message_id
                WHERE (send_message_id='{$result['unique_id']}' OR receive_message_id='{$result['unique_id']}') AND (send_message_id='{$sendId}' OR receive_message_id='{$sendId}') ORDER BY send_at DESC LIMIT 1");
        $msgs = $stmt->fetch();

        if (isset($_SESSION['ip']) && $msgs != []) {
            if ($stmt->rowCount() > 0) {
                $message = $msgs['msg'];
                
                if ($msgs['opened'] === 0) {
                    $open = "text-black opacity-100 ";
                    // var_dump(); die;
                    $file = "";
                    $class = "d-none opacity-0";
                } else {
                    $open = "text-muted opacity-50 ";
                    $request2 = $db_connexion->query("SELECT * FROM utilisateurs JOIN messages ON messages.receive_message_id = utilisateurs.unique_id WHERE receive_message_id='{$result['unique_id']}'");
                    $img = $request2->fetch();
                    $file = "../public/uploads/images/".$img['fileName'];
                    $class = "d-flex opacity-100";
                }

                ($_SESSION['ip'] === $msgs['send_message_id']) ? $sender = "Moi: " : $sender = "";

            } else {
                $message = "Pas de discution entre vous deux.";
            }

            (strlen($message) > 33) ? $msg = substr($message, 0, 33) . " . . ." : $msg = $message;

            // ();

            ($result['status'] === 1) ? $status = "dot_online" : $status = "dot_offline";

            $output .= '
                <a href="../views/discution.php?code=' . $result['unique_id'] . '">
                    <section class="profile d-flex align-items-center justify-content-between position-relative">
                        <div class="contenu d-flex align-items-center">
                            <img src="../public/uploads/images/' . $result['fileName'] . '" alt="' . $result['userName'] . '">
                            <i class="fa fa-circle '.$status.' position-absolute"></i>
                            <div class="align-items-center pt-3 pl-1">
                                <span class=" text-black">' . $result['userName'] . '</span>
                                <p class="' . $open . ' small">'. $sender . $msg . '</p>
                            </div>
                        </div>
                        <div class="openImg ' . $class . '">
                            <img src="' . $file . '">
                        </div>
                    </section>
                </a>
            ';
        }
    }
    echo $output;
}
