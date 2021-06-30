ALTER TABLE `cities` Add  `order_no` INT(10) NULL DEFAULT '100';
UPDATE `cities` SET `order_no` = '0' WHERE `cities`.`id` = 637640;
UPDATE `cities` SET `order_no` = '1' WHERE `cities`.`id` = 653240;
UPDATE `cities` SET `order_no` = '2' WHERE `cities`.`id` = 650400;
UPDATE `cities` SET `order_no` = '3' WHERE `cities`.`id` = 634450;
UPDATE `cities` SET `order_no` = '4' WHERE `cities`.`id` = 641780;
UPDATE `cities` SET `order_no` = '5' WHERE `cities`.`id` = 654070;
UPDATE `cities` SET `order_no` = '6' WHERE `cities`.`id` = 640860;
UPDATE `cities` SET `order_no` = '7' WHERE `cities`.`id` = 642320;
UPDATE `cities` SET `order_no` = '8' WHERE `cities`.`id` = 653040;
UPDATE `cities` SET `order_no` = '9' WHERE `cities`.`id` = 652000;
UPDATE `cities` SET `order_no` = '10' WHERE `cities`.`id` = 646600;
UPDATE `cities` SET `order_no` = '11' WHERE `cities`.`id` = 635320;
UPDATE `cities` SET `order_no` = '12' WHERE `cities`.`id` = 624840;
UPDATE `cities` SET `order_no` = '13' WHERE `cities`.`id` = 625810;
UPDATE `cities` SET `order_no` = '14' WHERE `cities`.`id` = 644200;
UPDATE `cities` SET `order_no` = '15' WHERE `cities`.`id` = 661420;



ALTER TABLE `clubs` ADD `rating` VARCHAR(10) NOT NULL AFTER `club_youtube_link`;