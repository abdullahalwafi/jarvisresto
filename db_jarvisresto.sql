-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_jarvisresto
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_jarvisresto
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_jarvisresto` ;
USE `db_jarvisresto` ;

-- -----------------------------------------------------
-- Table `db_jarvisresto`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`categories` (
  `id` BIGINT(20) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nama_UNIQUE` (`nama` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jarvisresto`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`products` (
  `id` BIGINT(20) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `harga` INT NOT NULL,
  `is_ready` TINYINT(1) NOT NULL DEFAULT 0,
  `jenis` VARCHAR(255) NOT NULL,
  `gambar` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `categories_id` BIGINT(20) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_categories_idx` (`categories_id` ASC) ,
  CONSTRAINT `fk_products_categories`
    FOREIGN KEY (`categories_id`)
    REFERENCES `db_jarvisresto`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jarvisresto`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`users` (
  `id` BIGINT(20) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `alamat` VARCHAR(255) NULL,
  `nohp` VARCHAR(255) NOT NULL,
  `level` ENUM('admin', 'kasir', 'manager') NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `nohp_UNIQUE` (`nohp` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jarvisresto`.`pesanan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`pesanan` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `users_id` BIGINT(20) NOT NULL,
  `kode_pesanan` VARCHAR(255) NOT NULL,
  `nomeja` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `total_harga` INT NOT NULL,
  `kode_unik` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_pesanan_users1_idx` (`users_id` ASC) ,
  UNIQUE INDEX `kode_pesanan_UNIQUE` (`kode_pesanan` ASC) ,
  CONSTRAINT `fk_pesanan_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `db_jarvisresto`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jarvisresto`.`pesanan_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`pesanan_items` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `pesanan_id` BIGINT NOT NULL,
  `products_id` BIGINT(20) NOT NULL,
  `qty` INT NOT NULL,
  `total_harga` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_pesanan_items_pesanan1_idx` (`pesanan_id` ASC) ,
  INDEX `fk_pesanan_items_products1_idx` (`products_id` ASC) ,
  CONSTRAINT `fk_pesanan_items_pesanan1`
    FOREIGN KEY (`pesanan_id`)
    REFERENCES `db_jarvisresto`.`pesanan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pesanan_items_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `db_jarvisresto`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jarvisresto`.`transaction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jarvisresto`.`transaction` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `users_id` BIGINT(20) NOT NULL,
  `pesanan_id` BIGINT NOT NULL,
  `total_bayar` INT NOT NULL,
  `jumlah_bayar` INT NOT NULL,
  `kembalian` INT NULL,
  `status` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_transaction_users1_idx` (`users_id` ASC) ,
  INDEX `fk_transaction_pesanan1_idx` (`pesanan_id` ASC) ,
  CONSTRAINT `fk_transaction_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `db_jarvisresto`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_pesanan1`
    FOREIGN KEY (`pesanan_id`)
    REFERENCES `db_jarvisresto`.`pesanan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
