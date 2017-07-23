CREATE TABLE `comment_user` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_comment`  INT(11)             NOT NULL,
  `id_user`     INT(11)             NOT NULL,
  CONSTRAINT FK_COMMENT_USER_COMMENT FOREIGN KEY (id_comment) REFERENCES comment (id),
  CONSTRAINT FK_COMMENT_USER_USER FOREIGN KEY (id_user) REFERENCES user (id)
);