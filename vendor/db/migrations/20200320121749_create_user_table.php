<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function up()
    {
        $sql = '
            CREATE TABLE `users` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(70) NULL,
              `email` VARCHAR(70) NULL,
              `address` VARCHAR(255) NULL,
              `password` VARCHAR(255) NULL,
              `balance` INT NOT NULL DEFAULT 0,
              `loyalty` INT NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC),
              UNIQUE INDEX `email_UNIQUE` (`email` ASC))
            CHARACTER SET "utf8" COLLATE "utf8_general_ci";
              
              CREATE TABLE `things` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `name` VARCHAR(45) NULL,
              `size` INT NULL,
              `weight` INT NULL,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC))
              CHARACTER SET "utf8" COLLATE "utf8_general_ci";
              
              CREATE TABLE `storage` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `thing_id` INT NULL,
              `bindTo` INT NULL,
              `date_create` DATETIME NULL,
              `date_send` DATETIME NULL,
              `used` INT(1) NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC),
              INDEX `fk_storage_1_idx` (`thing_id` ASC),
              INDEX `fk_storage_1_idx1` (`bindTo` ASC),
              CONSTRAINT `fk_storage_thing_id`
                FOREIGN KEY (`thing_id`)
                REFERENCES `things` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
              CONSTRAINT `fk_storage_user_id`
                FOREIGN KEY (`bindTo`)
                REFERENCES `users` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
                CHARACTER SET "utf8" COLLATE "utf8_general_ci";
                
              CREATE TABLE `wallet` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `amount` INT NOT NULL DEFAULT 0,
              `bindTo` INT NULL,
              `date_create` DATETIME NULL,
              `date_bind` DATETIME NULL,
              `used` INT(1) NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC),
              INDEX `fk_wallet_1_idx` (`bindTo` ASC),
              CONSTRAINT `fk_wallet_1`
                FOREIGN KEY (`bindTo`)
                REFERENCES `users` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
              CHARACTER SET "utf8" COLLATE "utf8_general_ci";
              
              CREATE TABLE `loyalty` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `amount` INT NOT NULL DEFAULT 0,
              `bindTo` INT NULL,
              `source_name` VARCHAR(70) NULL,
              `date_bind` DATETIME NULL,
              `date_create` DATETIME NULL,
              `used` INT(1) NOT NULL DEFAULT 0,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `id_UNIQUE` (`id` ASC),
              INDEX `fk_loyalty_1_idx` (`source_name` ASC),
              INDEX `fk_loyalty_2_idx` (`bindTo` ASC),
              CONSTRAINT `fk_loyalty_2`
                FOREIGN KEY (`bindTo`)
                REFERENCES `users` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            CHARACTER SET "utf8" COLLATE "utf8_general_ci";
        ';

        $this->execute($sql);
    }

    public function down()
    {
        $sql = '
          drop TABLE `loyalty`;        
          drop TABLE `wallet`;
          drop TABLE `storage`;
          drop TABLE `things`;
          drop TABLE `users`;
        ';

        $this->execute($sql);
    }
}
