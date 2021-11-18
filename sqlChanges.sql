ALTER TABLE `clubs` ADD `console_type_1` VARCHAR(100) NULL AFTER `qty_console`, ADD `qty_console_1` INT NULL AFTER `console_type_1`, ADD `console_type_2` VARCHAR(100) NULL AFTER `qty_console_1`, ADD `qty_console_2` INT NULL AFTER `console_type_2`, ADD `console_type_3` VARCHAR(100) NULL AFTER `qty_console_2`, ADD `qty_console_3` INT NULL AFTER `console_type_3`;

ALTER TABLE `clubs` CHANGE `qty_console_1` `qty_console_1` INT(11) NOT NULL DEFAULT '0', CHANGE `qty_console_2` `qty_console_2` INT(11) NOT NULL DEFAULT '0', CHANGE `qty_console_3` `qty_console_3` INT(11) NOT NULL DEFAULT '0';
