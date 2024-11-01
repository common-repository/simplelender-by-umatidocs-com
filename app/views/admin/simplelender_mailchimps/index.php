<div class = "wrap">
<center><h2 class="simplelender_main_title">Mailchimp Settings</h2></center>

<table class="simplelender_list_table">
    <tr style="width:100%;">
    <td class="" >
<?php 

function simplelender_SectionInput($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>">
        <?php esc_html_e('Authentication settings for recieved API data.', SL_THEME); ?>
    </p>
<?php
}


function simplelender_OptionsPageHTML()
{
    /**
     * Check user capabilities
     */
    if (!current_user_can('manage_options')) {
        return;
    }

?>
<div class="wrap">
     <form action="options.php" method="post">
        <?php
        settings_fields('simplelender');
        do_settings_sections('simplelender');
        submit_button('Save Settings');
        ?>
    </form>
</div>
<?php
}
simplelender_OptionsPageHTML();

?>
    </td>
    <hr>
    </tr>
</table>

</center>
</div>


<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */    ?>