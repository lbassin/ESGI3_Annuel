SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `role` (
  `id`   INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255)        NOT NULL
);

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

CREATE TABLE `survey` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `question`   VARCHAR(255)        NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME
);

CREATE TABLE `survey_answer` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `answer`     VARCHAR(255)        NOT NULL,
  `id_survey`  INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_SURVEY_ANSWER_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id)
);

CREATE TABLE `survey_answer_user` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_answer`  INT(11)             NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_SURVEY_ANSWER_USER_SURVEY_ANSWER FOREIGN KEY (id_answer) REFERENCES survey_answer (id),
  CONSTRAINT FK_SURVEY_ANSWER_USER_USER FOREIGN KEY (id_user) REFERENCES user (id)
);

CREATE TABLE `category` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)        NOT NULL,
  `description` VARCHAR(255)        NOT NULL,
  `created_at`  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME
);

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

CREATE TABLE `article_category` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_article`  INT(11)             NOT NULL,
  `id_category` INT(11)             NOT NULL,
  CONSTRAINT FK_ARTICLE_CATEGORY_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id),
  CONSTRAINT FK_ARTICLE_CATEGORY_CATEGORY FOREIGN KEY (id_category) REFERENCES category (id)
);

CREATE TABLE `comment` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `content`    VARCHAR(255)        NOT NULL,
  `id_article` INT(11)             NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_COMMENT_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id),
  CONSTRAINT FK_COMMENT_USER FOREIGN KEY (id_user) REFERENCES user (id)
);

CREATE TABLE `config` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)        NOT NULL,
  `value`      VARCHAR(255)        NOT NULL,
  `old_value`  VARCHAR(255)        NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME
);

CREATE TABLE `media` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)        NOT NULL,
  `path`       VARCHAR(255)        NOT NULL,
  `type`       VARCHAR(25)         NOT NULL,
  `extension`  VARCHAR(25)         NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MEDIA_USER FOREIGN KEY (id_user) REFERENCES user (id)
);

CREATE TABLE `media_article` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`   INT(11)             NOT NULL,
  `id_article` INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MEDIA_ARTICLE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id),
  CONSTRAINT FK_MEDIA_ARTICLE_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id)
);

CREATE TABLE `page` (
  `id`               INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(255)        NOT NULL,
  `content`          TEXT                NOT NULL,
  `description`      VARCHAR(255)        NOT NULL,
  `url`              VARCHAR(255)        NOT NULL,
  `visibility`       INT(11)             NOT NULL,
  `publish`          INT(11)             NOT NULL,
  `meta_title`       VARCHAR(255)        NOT NULL,
  `meta_description` VARCHAR(255)        NOT NULL,
  `created_at`       DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       DATETIME
);

CREATE TABLE `media_page` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`   INT(11)             NOT NULL,
  `id_page`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MEDIA_PAGE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id),
  CONSTRAINT FK_MEDIA_PAGE_ARTICLE FOREIGN KEY (id_page) REFERENCES page (id)
);

CREATE TABLE `menu` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `label`      VARCHAR(255)        NOT NULL,
  `url`        VARCHAR(255)        NOT NULL,
  `parent_id`  INT(11),
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_MENU_MENU FOREIGN KEY (parent_id) REFERENCES menu (id)
);

CREATE TABLE `theme` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255)        NOT NULL,
  `directory`   VARCHAR(255)        NOT NULL,
  `is_selected` TINYINT(1)          NOT NULL,
  `version`     VARCHAR(25)         NOT NULL,
  `author`      VARCHAR(100)        NOT NULL,
  `description` TEXT                NOT NULL,
  `created_at`  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME
);
