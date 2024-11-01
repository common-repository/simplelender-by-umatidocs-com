<div class="client_dash">
    
    <div id="simplelender_dash_content">
            <div class="logout_link_wrapper">

                    <div id="simplelender_dash_menu">
                        
                    </div>
                
                <span class="logout_link"><?php
                $user = wp_get_current_user();
                echo "<a href='". mvc_public_url(array('controller' => 'simplelender_clientloans', 'action' => 'index',))."'> <b>Loan Applications</b> </a> | ";
                if ( simplelender_fs()->is_plan('growth') ) {
                    echo "<a href='". mvc_public_url(array('controller' => 'simplelender_messages', 'action' => 'index',))."'> <b>Open Tickets</b> </a> | ";
                }
                echo "<b>".$user->data->user_nicename." </b> - ";
                ?>
                <a href="<?php echo wp_logout_url('simplelender_clientloans'); ?>"><button>Logout</button></a></span>
            </div>
            <br><br>
            <div></div>
<div class = "wrap simplelender_input">
    <center><h3 class="simplelender_main_title">Ticket No: <b><?php echo $ticket['number'];?> </b>
        | Loan Application ID: 
            <b><?php
                echo $ticket['loan_id'];
            ?></b>
        | Status: 
            <b><?php
                $sl_message_status=array(
                                1=>'Open',
                                2=>'Resolved'
                            );
                echo $sl_message_status[$ticket['status']];
            ?></b></h3>

    </center>
    <hr>
    <table class="simplelender_list_table">
       
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
simplelender_user_id=<?php echo mvc_model('simplelenderClientaccount')->find_one(['conditions'=>['wp_user_id'=>get_current_user_id()]])->id; ?>;
</script>
</div>
</div>
</div>