<div class = "wrap simplelender_input">
    <hr>
    <center><h2 class="simplelender_main_title">Notification Logs</h2><br>
	
	<br>
    <table class="simplelender_list_table">
            <tr style="width:100%;">
                    <td class="simplelender_sub_title">
                        <center><b>Notification</b></center>
                    </td>
                    <td class="simplelender_sub_title">
                        <center><b>Executed successful</b></center>
                    </td>
                    <td class="simplelender_sub_title">
                        <center><b>Retry</b></center>
                    </td>
                    </td>
                    <td class="simplelender_sub_title">
                        <center><b>Log Type</b></center>
                    </td>
					<td class="simplelender_sub_title">
                        <center><b>Time</b></center>
                    </td>
            </tr>
    <?php  foreach ($objects as $object): ?>

        <?php  $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php endforeach; ?>
    </table>
<hr>
</div>

