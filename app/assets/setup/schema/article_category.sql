CREATE TABLE `article_category` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_article`  INT(11)             NOT NULL,
  `id_category` INT(11)             NOT NULL,
  CONSTRAINT FK_ARTICLE_CATEGORY_ARTICLE FOREIGN KEY (id_article) REFERENCES article (id),
  CONSTRAINT FK_ARTICLE_CATEGORY_CATEGORY FOREIGN KEY (id_category) REFERENCES category (id)
);