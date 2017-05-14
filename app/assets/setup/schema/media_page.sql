CREATE TABLE `media_page` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`   INT(11)             NOT NULL,
  `id_page`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MEDIA_PAGE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id),
  CONSTRAINT FK_MEDIA_PAGE_ARTICLE FOREIGN KEY (id_page) REFERENCES page (id)
);