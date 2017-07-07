CREATE TABLE `media_article` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`   INT(11)             NOT NULL,
  `id_article` INT(11)             NOT NULL,
  `created_at` TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP,
  CONSTRAINT FK_MEDIA_ARTICLE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id),
  CONSTRAINT FK_MEDIA_ARTICLE_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id)
);