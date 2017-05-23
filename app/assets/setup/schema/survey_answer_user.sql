CREATE TABLE `survey_answer_user` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_answer`  INT(11)             NOT NULL,
  `id_user`    INT(11)             NOT NULL,
  `created_at` DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME,
  CONSTRAINT FK_SURVEY_ANSWER_USER_SURVEY_ANSWER FOREIGN KEY (id_answer) REFERENCES survey_answer (id),
  CONSTRAINT FK_SURVEY_ANSWER_USER_USER FOREIGN KEY (id_user) REFERENCES user (id)
);