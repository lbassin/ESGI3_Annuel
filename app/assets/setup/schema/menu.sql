CREATE TABLE `menu` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `label`      VARCHAR(255)        NOT NULL,
  `url`        VARCHAR(255)        NOT NULL,
  `parent_id`  INT(11),
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MENU_MENU FOREIGN KEY (parent_id) REFERENCES menu (id)
);