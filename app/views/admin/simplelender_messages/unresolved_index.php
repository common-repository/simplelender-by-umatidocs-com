<div class = "wrap ">
    <center><h2 class="simplelender_main_title">All Tickets</h2>
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

    </center>
    <center>
        <table class="simplelender_list_table">
        <tr style="width:100%;">
            <td class="simplelender_sub_title" >
                <b> Ticket Id</b>
            </td>
            <td class="simplelender_sub_title">
                <b>Ticket Status</b>
            </td>
            <td class="simplelender_sub_title">
                <b>Loan Product</b>
            </td>
            <td class="simplelender_sub_title">
                
            </td>
        </tr>
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
    </table>
    <hr>
    <center><?php  echo paginate_links($pagination); ?></center>
    </center>

</div>