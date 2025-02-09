<?php 
session_start();
if(isset($_SESSION['unique_id'])){
    include_once "../Connect/Connection.php";

    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
     
    
    $sql = "SELECT
            messages.*,
            tblaccounts.*,
            messages.datetime AS datetime
            FROM messages
            LEFT JOIN tblaccounts ON tblaccounts.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})
            ORDER BY msg_id ";

    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
          if($row['outgoing_msg_id'] === $outgoing_id ){    //pagnag equal to sa kanya sender sya
              $output .= '<li class="chatItems tridot istap">
                            <div class="chatItemsGilid">
                            </div>
                            <div class="ItemsConsts">
                                <div class="ItemsWrapper">
                                    <div class="ItemBoxes">
                                        <div class="ItemBoxTexts">
                                            <p>'. $row['msg'] .'</p>
                                            <div class="ItemBoxTime">'. date('F d, Y H:i:s', strtotime($row['datetime']))
                                            .'</div>
                                        </div>
                                        <div class="ItemsDropDown tridot">
                                            <button type="button" class="ItemDrop-btn">
                                                <img class="imgMores" src="Pictures/MoreDots.png">
                                            </button>
                                            <ul class="ItemsDropDownList">
                                                <li>
                                                    <a href="#">
                                                        <img class="forwardImg" src="Pictures/forward.png">
                                                        Forward
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="deleteImg" src="Pictures/trashButton.png">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>';
          } else {      // matik eto yung receiver
              $output .= '<li class="chatItems ehe tridot istap">
                            <div class="chatItemsGilid">';
                            if ($row['role'] === 'user') {
                                $output .= '<img class="chatItemsGimage" src="Pictures/' . $row['img'] . '">';
                              } else {
                                $output .= '<img class="chatItemsGimage" src="Pictures/' . $row['img'] . '">';
                              }
              $output .=  '</div>
                            <div class="ItemsConsts tridot">
                                <div class="ItemsWrapper">
                                    <div class="ItemBoxes">
                                        <div class="ItemBoxTexts">
                                            <p>'. $row['msg'] .'</p>
                                            <div class="ItemBoxTime">'. date('F d, Y H:i:s', strtotime($row['datetime'])) .'</div>
                                        </div>
                                        <div class="ItemsDropDown tridot">
                                            <button type="button" class="ItemDrop-btn">
                                                <img class="imgMores" src="Pictures/MoreDots.png">
                                            </button>
                                            <ul class="ItemsDropDownList">
                                                <li>
                                                    <a href="#">
                                                        <img class="forwardImg" src="Pictures/forward.png">
                                                        Forward
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="deleteImg" src="Pictures/trashButton.png">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>';
          }
        }
        echo $output;
    }

} else {
  header("../LoginPage.php");
}


?>