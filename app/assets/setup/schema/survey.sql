CREATE TABLE `survey` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `question`   VARCHAR(255)        NOT NULL,
  `created_at` TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP
);