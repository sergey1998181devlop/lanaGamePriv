ALTER TABLE `users` ADD `last_active_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;

ALTER TABLE `reports` ADD `url` VARCHAR(255) NULL AFTER `message`;
ALTER TABLE `reports` CHANGE `url` `url` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `clubs` ADD `last_admin_edit` INT NULL AFTER `published_by`;
ALTER TABLE `clubs` ADD `deleted_at` TIMESTAMP NULL AFTER `updated_at`;:

ALTER TABLE `clubs` ADD `unpublished_at` TIMESTAMP NULL DEFAULT NULL AFTER `deleted_at`, ADD `unpublished_by` INT NULL DEFAULT NULL AFTER `unpublished_at`;
ALTER TABLE `clubs` ADD `deleted_by` INT NULL DEFAULT NULL AFTER `deleted_at`;

ALTER TABLE `clubs` ADD `club_thumbnail` LONGTEXT NULL AFTER `main_preview_photo`;

CREATE TABLE `subscribes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('gamer','owner') NOT NULL DEFAULT 'owner',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);
  ALTER TABLE `subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

ALTER TABLE `posts` ADD `order_no` INT NOT NULL DEFAULT '500' AFTER `views`, ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `order_no`;
