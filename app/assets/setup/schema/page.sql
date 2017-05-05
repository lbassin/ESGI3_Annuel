CREATE TABLE `page` (
  `id`               INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(255)        NOT NULL,
  `content`          TEXT                NOT NULL,
  `description`      VARCHAR(255)        NOT NULL,
  `url`              VARCHAR(255)        NOT NULL,
  `visibility`       INT(11)             NOT NULL,
  `publish`          INT(11)             NOT NULL,
  `meta_title`       VARCHAR(255)        NOT NULL,
  `meta_description` VARCHAR(255)        NOT NULL,
  `created_at`       DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       DATETIME
);