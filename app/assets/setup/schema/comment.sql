CREATE TABLE `comment` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `content`    VARCHAR(255)        NOT NULL,
  `id_article` INT(11)             NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `created_at` TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP,
  CONSTRAINT FK_COMMENT_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id),
  CONSTRAINT FK_COMMENT_USER FOREIGN KEY (id_user) REFERENCES user (id)
);