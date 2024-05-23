<?php 
while ($row = mysqli_fetch_assoc($sql)) {
    $row2 = null;

    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
             OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
             OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    
    $query2 = mysqli_query($conn, $sql2);

    if ($query2) {

        if(mysqli_num_rows($query2) > 0 ){
            $row2 = mysqli_fetch_assoc($query2);
            $result = $row2['msg'];
        } else {
            $result = "";
        }

        //trim ng message kapag yung word ay lampas na ng 28 sa userlist
        $msg = (strlen($result) > 28) ? substr($result, 0, 28).'...' : $result;

    $offline = ($row['status'] == "Offline now") ? "offline" : "online";

    $you = "";

                                                            
    if ($row2 !== null && isset($row2['outgoing_msg_id'])) {
                                                                // kapag ang last message ay si sender may "You: "
        $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
    }
    
    if (!empty($row['unique_id'])) {
                                                        // Encode ng ID before appending sa URL
        $encoded_id = urlencode($row['unique_id']);
        
        $output .= '<a href="MainChat.php?user_id='.$encoded_id.'">
                    <img class="messagesImages" src="Pictures/'.$row['img'].'">
                    <span class="conMessagesInfo">
                        <span class="mesageName">'.$row['first_name'].' '.$row['last_name'].'</span>
                        <span class="mesageText"> ';

                                    
                        // Check if outgoing_id does not match $row['outgoing-msg-id'], if so, make the text bold
                        if ($row2 !== null && isset($row2['outgoing_msg_id']) && $row2['outgoing_msg_id'] !== $outgoing_id) {
                            $output .= '<span class="bold">';
                        }
            
                        // Append the message content
                        $output .= $you . $msg;
            
                        // Close the <span> tag for bold text if necessary
                        if ($row2 !== null && isset($row2['outgoing_msg_id']) && $row2['outgoing_msg_id'] !== $outgoing_id) {
                            $output .= '</span>';
                        }
                       
                    $output .= ' </span>
                    <span class="messagesAtIbapa">
                        <span class="mgaKausapStatus ' . $offline . ' ?>"></span>
                        <!--<span class="messageUnread"> 2 </span> -->  
                        <!-- <span class="messageTime"> 2 </span> -->
                    </span>
                    </a>';
    } else {
        // Handle the case where unique_id is empty or null
        $output .= '<div>Error: Missing or invalid unique_id</div>';
    }
} else {
    // Handle the case where the query fails
    $output .= '<div>Error: Failed to execute query</div>';
}
}
?>
