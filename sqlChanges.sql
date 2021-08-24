ALTER TABLE `users` ADD `last_active_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `reports` ADD `url` VARCHAR(255) NULL AFTER `message`;
ALTER TABLE `reports` CHANGE `url` `url` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
