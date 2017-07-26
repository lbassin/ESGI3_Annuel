CREATE TABLE `category` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)        NOT NULL,
  `description` VARCHAR(255)        NOT NULL,
  `url`         VARCHAR(255)        NOT NULL,
  `path_image1` VARCHAR(255)        NOT NULL,
  `created_at`  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP
);