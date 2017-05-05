CREATE TABLE `user` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pseudo`     VARCHAR(255)        NOT NULL,
  `firstname`  VARCHAR(180)        NOT NULL,
  `lastname`   VARCHAR(180)        NOT NULL,
  `email`      VARCHAR(255)        NOT NULL,
  `password`   CHAR(60)            NOT NULL,
  `avatar`     VARCHAR(255),
  `status`     INT(11)             NOT NULL,
  `id_role`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_USER_ROLE FOREIGN KEY (id_role) REFERENCES role (id)
);