CREATE TABLE `article` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)        NOT NULL,
  `description` VARCHAR(255)        NOT NULL,
  `content`     LONGTEXT            NOT NULL,
  `url`         VARCHAR(255)        NOT NULL,
  `publish`     INT(11)             NOT NULL,
  `template_id` INT(11)             NOT NULL,
  `id_user`     INT(11)             NOT NULL,
  `id_survey`   INT(11),
  `created_at`  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP,
  CONSTRAINT FK_ARTICLE_USER FOREIGN KEY (id_user) REFERENCES user (id),
  --CONSTRAINT FK_ARTICLE_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id)
);