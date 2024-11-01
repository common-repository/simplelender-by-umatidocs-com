<div class = "wrap simplelender_input"><br>
  
    <center>
        <h2 class="simplelender_main_title">All Notifications</h2>
        <table class="loan_stages">
        <tbody><tr>
            <td class="simplelender_application_top">
                <a class="simplelender_application_top_a" href="<?php echo mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "index", "id" =>"" )); ?>">All Custom Email(s)</a>
            </td>
            <td class="simplelender_minfore_top">
                <a class="simplelender_application_top_a" href="<?php echo mvc_admin_url(array("controller" => "simplelender_webhooks", "action" => "add", "id" =>"")); ?>">New Custom Email</a>
            </td>
        </tr>
    </tbody></table>
    <br>
    </center>
    <center>
    <table class="simplelender_list_table">
            <tr style="width:100%;">
					<td class="simplelender_sub_title">
                        <center>Active</center>
                    </td>
                    <td class="simplelender_sub_title">
                        <center>Title</center>
                    </td>
                    <td class="simplelender_sub_title">
                        <center>Trigger</center>
                    </td>  
                    <td class="simplelender_sub_title">
                        <center>Last Event Trigger</center>
                    </td>
					<td class="simplelender_sub_title">
                        <center>Number of Triggers</center>
                    </td>
					<td class="simplelender_sub_title">
                        <center>Unsuccessful Attempts</center>
                    </td>
                    </td>
                    <td class="simplelender_sub_title">
                        <center>Active Retries</center>
                    </td>
            </tr>
    <?php  foreach ($objects as $object): ?>

        <?php  $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php endforeach; ?>
    </table>
<hr>
</div>
<?php  
    $notification_arr=[];
    foreach ($objects as $object){
        $notification_arr["simplelenderWebhookNotificationIsActive".$object->id] = $object->id;
    }
?>

<script type="text/javascript">
    simplelender_number_of_notifications=<?php echo json_encode($notification_arr); ?>;
</script>