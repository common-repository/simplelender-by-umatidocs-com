<?php

require_once dirname(__FILE__).'/ticket_message/simplelender_message.php';
require_once dirname(__FILE__).'/notification/simplelender_notification.php';


simplelender_class('simplelender_notification')->init();
simplelender_class('simplelender_message')->init();