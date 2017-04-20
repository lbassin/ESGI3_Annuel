SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `survey` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ask`           VARCHAR(255)        NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

CREATE TABLE `choice` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `answer`        VARCHAR(255)        NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL,
  `id_survey`     INT(11)             NOT NULL
);

ALTER TABLE choice
  ADD CONSTRAINT FK_CHOICE_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id);

CREATE TABLE `user` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `pseudo`        VARCHAR(255)        NOT NULL,
  `firstname`     VARCHAR(180)        NOT NULL,
  `lastname`      VARCHAR(180)        NOT NULL,
  `email`         VARCHAR(255)        NOT NULL,
  `password`      CHAR(60)            NOT NULL,
  `avatar`        VARCHAR(255)        NOT NULL,
  `status`        INT(11)             NOT NULL,
  `role`          INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

CREATE TABLE `vote` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_choice`     INT(11)             NOT NULL,
  `id_user`       INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE vote
  ADD CONSTRAINT FK_VOTE_CHOICE FOREIGN KEY (id_choice) REFERENCES choice (id);
ALTER TABLE vote
  ADD CONSTRAINT FK_VOTE_USER FOREIGN KEY (id_user) REFERENCES user (id);

CREATE TABLE `article` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(255)        NOT NULL,
  `content`       TEXT                NOT NULL,
  `slug`          VARCHAR(255)        NOT NULL,
  `publish`       INT(11)             NOT NULL,
  `visibility`    INT(11)             NOT NULL,
  `id_user`       INT(11)             NOT NULL,
  `id_survey`     INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME                     DEFAULT NULL
);

ALTER TABLE article
  ADD CONSTRAINT FK_ARTICLE_USER FOREIGN KEY (id_user) REFERENCES user (id);
ALTER TABLE article
  ADD CONSTRAINT FK_ARTICLE_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id);

CREATE TABLE `comment` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `content`       VARCHAR(255)        NOT NULL,
  `id_article`    INT(11)             NOT NULL,
  `id_user`       INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE comment
  ADD CONSTRAINT FK_COMMENT_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id);
ALTER TABLE comment
  ADD CONSTRAINT FK_COMMENT_USER FOREIGN KEY (id_user) REFERENCES user (id);

CREATE TABLE `category` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(255)        NOT NULL,
  `description`   VARCHAR(255)        NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

CREATE TABLE `article_category` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_article`  INT(11)             NOT NULL,
  `id_category` INT(11)             NOT NULL
);

ALTER TABLE article_category
  ADD CONSTRAINT FK_ARTICLE_CATEGORY_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id);
ALTER TABLE article_category
  ADD CONSTRAINT FK_ARTICLE_CATEGORY_CATEGORY FOREIGN KEY (id_category) REFERENCES category (id);

CREATE TABLE `config` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(255)        NOT NULL,
  `ico`           VARCHAR(255)        NOT NULL,
  `logo`          VARCHAR(255)        NOT NULL,
  `url`           VARCHAR(255)        NOT NULL,
  `email`         VARCHAR(255)        NOT NULL,
  `language`      VARCHAR(125)        NOT NULL,
  `date`          VARCHAR(50)         NOT NULL,
  `registration`  VARCHAR(255)        NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

CREATE TABLE `media` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(255)        NOT NULL,
  `path`          VARCHAR(255)        NOT NULL,
  `type`          VARCHAR(25)         NOT NULL,
  `extension`     VARCHAR(25)         NOT NULL,
  `id_user`       INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE media
  ADD CONSTRAINT FK_MEDIA_USER FOREIGN KEY (id_user) REFERENCES user (id);

CREATE TABLE `media_article` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`      INT(11)             NOT NULL,
  `id_article`    INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE media_article
  ADD CONSTRAINT FK_MEDIA_ARTICLE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id);
ALTER TABLE media_article
  ADD CONSTRAINT FK_MEDIA_ARTICLE_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id);

CREATE TABLE `page` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(255)        NOT NULL,
  `content`       TEXT                NOT NULL,
  `description`   VARCHAR(255)        NOT NULL,
  `slug`          VARCHAR(255)        NOT NULL,
  `visibility`    INT(11)             NOT NULL,
  `publish`       INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

CREATE TABLE `media_page` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_media`      INT(11)             NOT NULL,
  `id_page`       INT(11)             NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE media_page
  ADD CONSTRAINT FK_MEDIA_PAGE_MEDIA FOREIGN KEY (id_media) REFERENCES media (id);
ALTER TABLE media_page
  ADD CONSTRAINT FK_MEDIA_PAGE_ARTICLE FOREIGN KEY (id_page) REFERENCES page (id);

CREATE TABLE `menu` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `label`         VARCHAR(255)        NOT NULL,
  `link`          VARCHAR(255)        NOT NULL,
  `parent_id`     INT(11),
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);

ALTER TABLE menu
  ADD CONSTRAINT FK_MENU_MENY FOREIGN KEY (parent_id) REFERENCES menu (id);

CREATE TABLE `theme` (
  `id`            INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(255)        NOT NULL,
  `directory`     VARCHAR(255)        NOT NULL,
  `is_selected`   TINYINT(1)          NOT NULL,
  `version`       VARCHAR(25)         NOT NULL,
  `author`        VARCHAR(100)        NOT NULL,
  `description`   TEXT                NOT NULL,
  `date_inserted` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated`  DATETIME            NOT NULL
);
