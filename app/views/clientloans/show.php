<div style="background:white; border:1px #90a8ce solid; border-radius:5px;padding:30px;margin:20px;">
<h2>Link Manager</h2>
<div><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<a class='button-primary' href=".mvc_admin_url(array('controller' => 'admin_links', 'action' => 'add',)).">New link</a>";	?>	</div>
<hr>
<table>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item_show', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>
<hr>
</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>