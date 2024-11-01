<h2>Clientloannotes</h2>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->pagination(); ?>