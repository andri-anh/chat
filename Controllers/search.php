<?php
session_start();
include_once("../Models/DataBase/Db_connexion.php");
$sendId = $_SESSION['ip'];
$recherche = addslashes($_POST['Resultat']);
// echo $recherche;

$request = $db_connexion->query("SELECT * FROM utilisateurs WHERE NOT unique_id = '{$sendId}' AND (userName LIKE '%{$recherche}%')");
$results = $request->fetchAll();

$output = "";
if ($request->rowCount() > 0) {
    foreach ($results as $result) {
        $stmt = $db_connexion->query("SELECT * FROM messages 
                LEFT JOIN utilisateurs ON utilisateurs.unique_id = messages.receive_message_id
                WHERE (send_message_id='{$result['unique_id']}' OR receive_message_id='{$result['unique_id']}') AND (send_message_id='{$sendId}' OR send_message_id='{$sendId}') ORDER BY msg_id DESC LIMIT 1");
        $msgs = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $message = $msgs['msg'];
            $smi = $msgs['send_message_id'];
        } else {
            $message = "Pas de discution entre vous deux.";
        }


        (strlen($message) > 33) ? $msg = substr($message, 0, 33) . " . . ." : $msg = $message;

        ($result['status'] == 1) ? $status = "dot_online" : $status = "dot_offline";

        // ($sendId === $smi) ? $me = "Moi: " : $me = "";
        // var_dump($smi); die;

        $output .= '
                    <a href="../views/discution.php?code=' . $result['unique_id'] . '">
                        <section class="profile d-flex align-items-center justify-content-between position-relative">
                            <div class="contenu d-flex align-items-center">
                                <img src="../public/uploads/images/' . $result['fileName'] . '" alt="' . $result['userName'] . '">
                                <i class="fa fa-circle '.$status.' position-absolute"></i>
                                <div class="align-items-center pt-3 pl-1">
                                    <span class=" text-black">' . $result['userName'] . '</span>
                                    <p class="text-muted small">' . $msg . '</p>
                                </div>
                            </div>
                        </section>
                    </a>
                ';
    }
} else {
    $output .= "Il n'y a pas d'utilisateur qui relie à votre recherche.";
}
echo $output;
