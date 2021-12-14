<?php 
      while($data = $response->fetch()){
            $response2 = $pdo->prepare("SELECT * FROM message WHERE (receiver_id = ?
            OR sender_id = ?) AND (receiver_id = ?
            OR sender_id = ?) ORDER BY message_id DESC LIMIT 1");

            $response2->execute(array($data['unique_id'],$data['unique_id'],$receiver_id,$receiver_id));

            $msg = "";
            $you = "";

            while( $data2 = $response2->fetch()){
                (sizeof($data2) > 0) ? $result = $data2['message'] : $result = "No message avalaible";
                (strlen($result) > 28) ? $smg =  substr($result, 0, 28) . '...' : $msg = $result;

                if(isset($data2['receiver_id'])){
                    ($receiver_id == $data2['receiver_id']) ? $you = "You: " : $you = "";
                }else{
                    $you = "";
                }
            }
            
            ($data['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($receiver_id == $data['unique_id']) ? $hid_me = "hide" : $hid_me = "";

            $output .= '<a href="chat.php?user_id='. $data['unique_id'] .'">
                        <div class="content">
                        <img src="php/images/'. $data['img'] .'" alt="">
                        <div class="details">
                            <span>'. $data['username'].'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                        <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                    </a>';
        }
?>

