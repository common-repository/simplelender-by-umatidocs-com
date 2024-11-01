<div class = "wrap ">
    <center><h3 class="simplelender_main_title">Ticket No: <b><?php echo $ticket['number'];?> 
        | Loan Application ID: 
            <?php
                echo $ticket['loan_id'];
            ?>
        | Status: 
            <?php
                $sl_message_status=array(
                                1=>'Open',
                                2=>'Resolved'
                            );
                echo $sl_message_status[$ticket['status']];
            ?></b></h3>
            <table class="loan_stages">
        <tbody><tr>
            <td class="simplelender_application_top">
                <a class="simplelender_application_top_a" href="<?php echo mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => '',)); ?>">All Tickets</a>
            </td>
            <td class="simplelender_minfore_top">
                <a class="simplelender_application_top_a" href="<?php echo mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => 'unresolved_index',)); ?>">Unresolved Tickets</a>
            </td>
        </tr>
    </tbody></table>
    <br>
        <?php echo " <a class='sl_menu_sub_item' href=".mvc_admin_url(array('controller' => 'admin_simplelender_messages', 'action' => 'mark_as_resolved','id'=>$ticket['id'])).">Mark This As Resolved</a>"; ?>
        </center>
    
        <table class="simplelender_list_table wp-list-table widefat fixed striped pages">
	
       
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

    $username_display=mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->firstname;
    foreach ($objects as $object): ?>

        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('message_item', array('locals' => array('object' => $object,'username_display'=>$username_display))); ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
    
    <td class="sl_list_single_message">
        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
            echo '<textarea id="simplelenderMessageInputarea" name="simplelenderMessageInputarea" class="simplelender_textare_input_feild"></textarea>';
            echo '<br><button id="simplelenderMessageSubmitButton" name="simplelenderMessageSubmitButton" class="simplelenderMessageSubmitButton"><b>Send</b></button>';
        ?>
    </td>
    </table>
    <center><?php  echo paginate_links($pagination); ?></center>
    

</div>
<script type="text/javascript">
simplelender_ticket_id=<?php echo $ticket['id']; ?>;
simplelender_user_id=<?php 
$client_id= mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id;
if (!isset($client_id)) {
    $client_id=1;
}
echo $client_id;

?>;
</script>