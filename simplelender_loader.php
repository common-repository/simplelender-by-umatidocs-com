<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  

class simplelenderLoader extends MvcPluginLoader {

    var $db_version = '1.3.08';
    var $tables = array();

    function activate() {
    
        // This call needs to be made to activate this app within WP MVC
        
        $this->activate_app(__FILE__);
        
        // Perform any databases modifications related to plugin activation here, if necessary

        require_once ABSPATH.'wp-admin/includes/upgrade.php';
    
        add_option('simplelender_db_version', $this->db_version);
                
        global $wpdb;
        $t_prefix=$wpdb->prefix;
        // Use dbDelta() to create the tables for the app here
        
        $sql = ["
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_account` (
                `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
                `name` varchar(32) NOT NULL,
                `parent_id` int(20) DEFAULT NULL,
                `Type` enum('Asset','Liability','Equity') NOT NULL,
                `space_individualtype` int(3) NOT NULL,
                `system_user` int(3) NOT NULL,
                `space_id` int(11) DEFAULT NULL,
                `related_user_id` int(11) DEFAULT NULL                
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              INSERT IF NOT EXISTS INTO `".$t_prefix."simplelender_account` (`id`, `name`, `parent_id`, `Type`, `space_individualtype`, `system_user`, `space_id`, `related_user_id`) VALUES
              (1, 'Money', NULL, 'Asset', 1, 1, NULL, NULL),
              (2, 'Cash payment', 1, 'Asset', 1, 1, NULL, NULL),
              (3, 'Mobile payment', 1, 'Asset', 1, 1, NULL, NULL),
              (4, 'Bank payment', 1, 'Asset', 1, 1, NULL, NULL),
              (5, 'Interests Earned', NULL, 'Asset', 1, 1, NULL, NULL),
              (6, 'Loan', NULL, 'Asset', 1, 1, NULL, NULL),
              (7, 'Fee', NULL, 'Asset', 1, 1, NULL, NULL);
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_api_key` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `display_name` varchar(200) DEFAULT NULL,
                `api_name` int(200) DEFAULT NULL,
                `display_on_frontend` int(1) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_api_value` (
                `id` int(11) NOT NULL,
                `key_id` int(11) DEFAULT NULL,
                `loan_application_id` int(11) DEFAULT NULL,
                `time_of_reception` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `value` varchar(1500) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS`".$t_prefix."simplelender_client_account` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `acc_number` varchar(25) NOT NULL UNIQUE KEY,
                `mobilenumber` varchar(20) NOT NULL,
                `firstname` varchar(35) DEFAULT NULL,
                `middlename` varchar(35) DEFAULT NULL,
                `lastname` varchar(35) DEFAULT NULL,
                `email` varchar(100) DEFAULT NULL,
                `wp_user_id` int(11) DEFAULT NULL,
                `status` tinyint(1) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","

              CREATE TABLE IF NOT EXISTS`".$t_prefix."simplelender_client_loan` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `amount_needed` int(11) DEFAULT NULL,
                `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `needed_by_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `issue_date` timestamp NULL DEFAULT NULL,
                `fully_settled_date` timestamp NULL DEFAULT NULL,
                `term` int(11) DEFAULT '1',
                `term_period` varchar(3) DEFAULT NULL,
                `loan_setting_id` int(11) DEFAULT NULL,
                `loan_stage` int(3) DEFAULT '1',
                `client_id` varchar(200) DEFAULT NULL,
                `goal_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_dat_key` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar(110) NOT NULL,
                `key_id` varchar(200) NOT NULL,
                `form_id` varchar(200) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_dat_value` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `form_id` varchar(20) NOT NULL,
                `key_id` varchar(100) NOT NULL,
                `object_type` int(3) NOT NULL,
                `object_id` int(3) NOT NULL,
                `data_value` varchar(500) NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_d_entry` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `bs_account` int(3) NOT NULL,
                `dr_cr` int(1) NOT NULL,
                `trans_amount` int(11) NOT NULL,
                `trans_type` int(2) NOT NULL COMMENT '1->loan issue 2 -> loan repayment',
                `trans_id` int(11) NOT NULL,
                `parent_trans_id` int(20) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","       
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_loan_setting` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `name` varchar(50) NOT NULL,
                `notes` varchar(100) DEFAULT NULL,
                `max_amount` int(11) NOT NULL,
                `interest_type` int(11) DEFAULT NULL,
                `interest_rate` int(11) DEFAULT NULL,
                `reminder_time_before` varchar(4) NOT NULL,
                `repayment_method` int(3) NOT NULL,
                `penalties` int(11) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `period_unit` varchar(2) NOT NULL DEFAULT 'm',
                `max_period_number` int(20) NOT NULL,
                `main_title_text` varchar(200) DEFAULT NULL,
                `main_title_description` varchar(5000) DEFAULT NULL,
                `secondary_form` int(15) DEFAULT NULL,
                `goal_form` int(15) DEFAULT NULL,
                `currency` varchar(5) DEFAULT NULL,
                `webhook_trigger_action` varchar(200) DEFAULT NULL,
                `button_text` varchar(200) DEFAULT NULL,
                `show_repayment` int(1) DEFAULT NULL,
                `calculator_theme` varchar(200) DEFAULT NULL,
                `mailchimp_group` varchar(50) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_mail_recipients` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `webhook_id` int(11) DEFAULT NULL,
                `type` varchar(150) DEFAULT NULL,
                `recipient` varchar(150) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_message` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `message` mediumtext,
                `sender_id` int(11) DEFAULT NULL,
                `status` int(3) NOT NULL COMMENT '1->sent 2=>read',
                `send_time` timestamp NULL DEFAULT NULL,
                `read_time` timestamp NULL DEFAULT NULL,
                `ticket_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_notifications` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `message` varchar(500) DEFAULT NULL,
                `user_id` int(11) DEFAULT NULL,
                `status` int(2) DEFAULT NULL COMMENT '1=>created, 2=>seen,3=>deleted',
                `time_created` timestamp NULL DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_spending_goal` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `name` varchar(150) NOT NULL,
                `description` varchar(500) NOT NULL,
                `email` varchar(200) DEFAULT NULL,
                `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_ticket` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `creation_time` timestamp NULL DEFAULT NULL,
                `close_time` timestamp NULL DEFAULT NULL,
                `status` int(2) DEFAULT NULL,
                `ticket_id` varchar(100) DEFAULT NULL,
                `loan_id` int(11) DEFAULT NULL,
                `client_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_webhooks` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `notification_is_active` tinyint(4) NOT NULL DEFAULT '0',
                `name` varchar(150) DEFAULT NULL,
                `webhook_trigger_action` varchar(250) DEFAULT NULL,
                `mail_active` tinyint(4) DEFAULT NULL,
                `mail_subject` varchar(150) DEFAULT NULL,
                `mail_body` varchar(5000) DEFAULT NULL,
                `webhook_active` tinyint(4) DEFAULT NULL,
                `args_encoding` tinyint(4) DEFAULT NULL COMMENT '1 => ''Form-encoded body'' 2 => ''JSON-encoded body'' 3 => ''URL parameters encoded (no body)''',
                `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `last_time_event_is_triggered` datetime NOT NULL,
                `number_of_times_event_was_trigger` int(11) NOT NULL DEFAULT '0',
                `unsuccessful_attempts_to_send_webhook` int(11) NOT NULL DEFAULT '0'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_webhook_args` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `webhook_id` int(11) DEFAULT NULL,
                `key_name` varchar(150) DEFAULT NULL,
                `value` longtext,
                `type` varchar(10) DEFAULT 'body'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_webhook_events` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `webhook_id` int(11) NOT NULL,
                `args` longtext,
                `processed_successfully` tinyint(4) NOT NULL COMMENT '0->pending process 1->done 2-> failed 3->to be retried'
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_webhook_logs` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `webhook_event_id` int(11) DEFAULT NULL,
                `successful` int(1) DEFAULT NULL COMMENT '1->successful 2->failiure',
                `retry` int(1) DEFAULT NULL COMMENT '0->first_attempt 1->retry',
                `log_type` int(1) DEFAULT NULL COMMENT '1->notification event 2->notification modification',
                `schedule_id` int(11) DEFAULT NULL,
                `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `finally_done` int(1) DEFAULT NULL,
                `webhook_id` int(11) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              ","
              CREATE TABLE IF NOT EXISTS `".$t_prefix."simplelender_webhook_urls` (
                `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `webhook_id` int(11) DEFAULT NULL,
                `type` varchar(100) DEFAULT NULL,
                `url` varchar(250) DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
              "];
			$sql3=["
CREATE TABLE `".$t_prefix."gf_draft_submissions` (
  `uuid` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_id` mediumint(8) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `ip` varchar(39) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`uuid`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","
CREATE TABLE `".$t_prefix."gf_entry` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `is_starred` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `ip` varchar(39) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_agent` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_amount` decimal(19,2) DEFAULT NULL,
  `payment_method` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_fulfilled` tinyint(1) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_type` tinyint(1) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `form_id_status` (`form_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","
CREATE TABLE `".$t_prefix."gf_entry_meta` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `entry_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_index` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_key` (`meta_key`(191)),
  KEY `entry_id` (`entry_id`),
  KEY `meta_value` (`meta_value`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

","

CREATE TABLE `".$t_prefix."gf_entry_notes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `entry_user_key` (`entry_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","

CREATE TABLE `".$t_prefix."gf_form` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_trash` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","
INSERT IF NOT EXISTS INTO `".$t_prefix."gf_form` ( `title`, `date_created`, `date_updated`, `is_active`, `is_trash`) VALUES
('Borrower Details Form', '2020-02-25 14:02:04', NULL, 1, 0),
('Spending Goal Form', '2020-02-25 18:00:37', NULL, 1, 0);
","

CREATE TABLE `".$t_prefix."gf_form_meta` (
  `form_id` mediumint(8) UNSIGNED NOT NULL,
  `display_meta` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries_grid_meta` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmations` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifications` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","

INSERT IF NOT EXISTS INTO`".$t_prefix."gf_form_meta` (`form_id`, `display_meta`, `entries_grid_meta`, `confirmations`, `notifications`) VALUES
(1, '{\"title\":\"Borrower Details Form\",\"description\":\"\",\"labelPlacement\":\"top_label\",\"descriptionPlacement\":\"below\",\"button\":{\"type\":\"text\",\"text\":\"Submit\",\"imageUrl\":\"\"},\"fields\":[{\"type\":\"select\",\"id\":1,\"label\":\"Untitled\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"choices\":[{\"text\":\"First Choice\",\"value\":\"First Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Second Choice\",\"value\":\"Second Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Third Choice\",\"value\":\"Third Choice\",\"isSelected\":false,\"price\":\"\"}],\"formId\":1,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"enablePrice\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"},{\"type\":\"text\",\"id\":2,\"label\":\"Untitled\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"formId\":1,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"choices\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"enablePasswordInput\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"},{\"type\":\"number\",\"id\":3,\"label\":\"Number\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"numberFormat\":\"decimal_dot\",\"formId\":1,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"choices\":\"\",\"conditionalLogic\":\"\",\"enableCalculation\":false,\"rangeMin\":\"\",\"rangeMax\":\"\",\"productField\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"}],\"version\":\"2.4.16\",\"id\":1,\"nextFieldId\":4,\"useCurrentUserAsAuthor\":true,\"postContentTemplateEnabled\":false,\"postTitleTemplateEnabled\":false,\"postTitleTemplate\":\"\",\"postContentTemplate\":\"\",\"lastPageButton\":null,\"pagination\":null,\"firstPageCssClass\":null,\"notifications\":{\"5e5528dc1fc3d\":{\"id\":\"5e5528dc1fc3d\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}},\"confirmations\":{\"5e5528dc53af0\":{\"id\":\"5e5528dc53af0\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Thanks for contacting us! We will get in touch with you shortly.\",\"url\":\"\",\"pageId\":\"\",\"queryString\":\"\"}},\"subLabelPlacement\":\"below\",\"cssClass\":\"\",\"enableHoneypot\":false,\"enableAnimation\":false,\"save\":{\"enabled\":false,\"button\":{\"type\":\"link\",\"text\":\"Save and Continue Later\"}},\"limitEntries\":false,\"limitEntriesCount\":\"\",\"limitEntriesPeriod\":\"\",\"limitEntriesMessage\":\"\",\"scheduleForm\":false,\"scheduleStart\":\"\",\"scheduleStartHour\":\"\",\"scheduleStartMinute\":\"\",\"scheduleStartAmpm\":\"\",\"scheduleEnd\":\"\",\"scheduleEndHour\":\"\",\"scheduleEndMinute\":\"\",\"scheduleEndAmpm\":\"\",\"schedulePendingMessage\":\"\",\"scheduleMessage\":\"\",\"requireLogin\":false,\"requireLoginMessage\":\"\"}', NULL, '{\"5e5528dc53af0\":{\"id\":\"5e5528dc53af0\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Thanks for contacting us! We will get in touch with you shortly.\",\"url\":\"\",\"pageId\":\"\",\"queryString\":\"\"}}', '{\"5e5528dc1fc3d\":{\"id\":\"5e5528dc1fc3d\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}}'),
(2, '{\"title\":\"Spending Goal Form\",\"description\":\"\",\"labelPlacement\":\"top_label\",\"descriptionPlacement\":\"below\",\"button\":{\"type\":\"text\",\"text\":\"Submit\",\"imageUrl\":\"\"},\"fields\":[{\"type\":\"number\",\"id\":1,\"label\":\"Number\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"numberFormat\":\"decimal_dot\",\"formId\":2,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"choices\":\"\",\"conditionalLogic\":\"\",\"enableCalculation\":false,\"rangeMin\":\"\",\"rangeMax\":\"\",\"productField\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"},{\"type\":\"select\",\"id\":2,\"label\":\"Untitled\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"inputs\":null,\"choices\":[{\"text\":\"First Choice\",\"value\":\"First Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Second Choice\",\"value\":\"Second Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Third Choice\",\"value\":\"Third Choice\",\"isSelected\":false,\"price\":\"\"}],\"formId\":2,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"enablePrice\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"},{\"type\":\"checkbox\",\"id\":3,\"label\":\"Untitled\",\"adminLabel\":\"\",\"isRequired\":false,\"size\":\"medium\",\"errorMessage\":\"\",\"visibility\":\"visible\",\"choices\":[{\"text\":\"First Choice\",\"value\":\"First Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Second Choice\",\"value\":\"Second Choice\",\"isSelected\":false,\"price\":\"\"},{\"text\":\"Third Choice\",\"value\":\"Third Choice\",\"isSelected\":false,\"price\":\"\"}],\"inputs\":[{\"id\":\"3.1\",\"label\":\"First Choice\",\"name\":\"\"},{\"id\":\"3.2\",\"label\":\"Second Choice\",\"name\":\"\"},{\"id\":\"3.3\",\"label\":\"Third Choice\",\"name\":\"\"}],\"formId\":2,\"description\":\"\",\"allowsPrepopulate\":false,\"inputMask\":false,\"inputMaskValue\":\"\",\"inputMaskIsCustom\":\"\",\"maxLength\":\"\",\"inputType\":\"\",\"labelPlacement\":\"\",\"descriptionPlacement\":\"\",\"subLabelPlacement\":\"\",\"placeholder\":\"\",\"cssClass\":\"\",\"inputName\":\"\",\"noDuplicates\":false,\"defaultValue\":\"\",\"conditionalLogic\":\"\",\"productField\":\"\",\"enableSelectAll\":\"\",\"enablePrice\":\"\",\"pageNumber\":1,\"fields\":\"\",\"displayOnly\":\"\"}],\"version\":\"2.4.16\",\"id\":2,\"nextFieldId\":4,\"useCurrentUserAsAuthor\":true,\"postContentTemplateEnabled\":false,\"postTitleTemplateEnabled\":false,\"postTitleTemplate\":\"\",\"postContentTemplate\":\"\",\"lastPageButton\":null,\"pagination\":null,\"firstPageCssClass\":null,\"notifications\":{\"5e5560c53a200\":{\"id\":\"5e5560c53a200\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}},\"confirmations\":{\"5e5560c565a69\":{\"id\":\"5e5560c565a69\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Thanks for contacting us! We will get in touch with you shortly.\",\"url\":\"\",\"pageId\":\"\",\"queryString\":\"\"}},\"subLabelPlacement\":\"below\",\"cssClass\":\"\",\"enableHoneypot\":false,\"enableAnimation\":false,\"save\":{\"enabled\":false,\"button\":{\"type\":\"link\",\"text\":\"Save and Continue Later\"}},\"limitEntries\":false,\"limitEntriesCount\":\"\",\"limitEntriesPeriod\":\"\",\"limitEntriesMessage\":\"\",\"scheduleForm\":false,\"scheduleStart\":\"\",\"scheduleStartHour\":\"\",\"scheduleStartMinute\":\"\",\"scheduleStartAmpm\":\"\",\"scheduleEnd\":\"\",\"scheduleEndHour\":\"\",\"scheduleEndMinute\":\"\",\"scheduleEndAmpm\":\"\",\"schedulePendingMessage\":\"\",\"scheduleMessage\":\"\",\"requireLogin\":false,\"requireLoginMessage\":\"\"}', NULL, '{\"5e5560c565a69\":{\"id\":\"5e5560c565a69\",\"name\":\"Default Confirmation\",\"isDefault\":true,\"type\":\"message\",\"message\":\"Thanks for contacting us! We will get in touch with you shortly.\",\"url\":\"\",\"pageId\":\"\",\"queryString\":\"\"}}', '{\"5e5560c53a200\":{\"id\":\"5e5560c53a200\",\"isActive\":true,\"to\":\"{admin_email}\",\"name\":\"Admin Notification\",\"event\":\"form_submission\",\"toType\":\"email\",\"subject\":\"New submission from {form_title}\",\"message\":\"{all_fields}\"}}');
","

CREATE TABLE `".$t_prefix."gf_form_revisions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) UNSIGNED NOT NULL,
  `display_meta` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_created` (`date_created`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
","

CREATE TABLE `".$t_prefix."gf_form_view` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` mediumint(8) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `ip` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` mediumint(8) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `date_created` (`date_created`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
"	];
      
        $sql2=[];
       if ( simplelender_fs()->is_plan('growth') ) {     
            $sql2=[
              "
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `period_unit` varchar(2) NOT NULL DEFAULT 'm' AFTER `repayment_method`;
              ","          
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `main_title_text` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `main_title_description` varchar(5000) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `currency` varchar(5) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `webhook_trigger_action` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `button_text`  varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `show_repayment` int(1) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `calculator_theme` varchar(200) DEFAULT NULL AFTER `repayment_method`;
              ","
              ALTER TABLE `".$t_prefix."simplelender_loan_setting` ADD IF NOT EXISTS 
                `mailchimp_group`  varchar(50) DEFAULT NULL AFTER `repayment_method`;","
             COMMIT;"];
            
        }  
        
       
          foreach ($sql as $single_sql) {            
              dbDelta($single_sql);
          }
		  
          foreach ($sql2 as $single_sql2) {
			dbDelta($single_sql2);
         }
		 foreach($sql3 as $single_sql3) {
			dbDelta($single_sql3);
         }
        
    }

    function deactivate() {
    
        // This call needs to be made to deactivate this app
        
        $this->deactivate_app(__FILE__);
        
        // Perform any databases modifications related to plugin deactivation here, if necessary
    
    }

}

?>