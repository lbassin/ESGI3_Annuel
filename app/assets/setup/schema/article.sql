CREATE TABLE `article` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`      VARCHAR(255)        NOT NULL,
  `content`    TEXT                NOT NULL,
  `url`        VARCHAR(255)        NOT NULL,
  `publish`    INT(11)             NOT NULL,
  `visibility` INT(11)             NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `id_survey`  INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_ARTICLE_USER FOREIGN KEY (id_user) REFERENCES user (id),
  CONSTRAINT FK_ARTICLE_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id)
);