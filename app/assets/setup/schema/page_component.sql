CREATE TABLE `page_component` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `page_id`     INT(11)             NOT NULL,
  `order`       INT(11)             NOT NULL,
  `template_id` INT(11)             NOT NULL,
  `config`      VARCHAR(255)        NOT NULL,
  `created_at`  TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP
);