CREATE TABLE `config` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)        NOT NULL,
  `value`      VARCHAR(255)        NOT NULL,
  `old_value`  VARCHAR(255)        NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME
);