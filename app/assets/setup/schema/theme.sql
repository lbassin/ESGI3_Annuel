CREATE TABLE `theme` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255)        NOT NULL,
  `directory`   VARCHAR(255)        NOT NULL,
  `is_selected` TINYINT(1)          NOT NULL,
  `version`     VARCHAR(25)         NOT NULL,
  `author`      VARCHAR(100)        NOT NULL,
  `description` TEXT                NOT NULL,
  `created_at`  TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP
);