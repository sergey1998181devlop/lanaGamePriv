ALTER TABLE `users` ADD `last_active_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `reports` ADD `url` VARCHAR(255) NULL AFTER `message`;
