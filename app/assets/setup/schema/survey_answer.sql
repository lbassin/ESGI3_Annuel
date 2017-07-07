CREATE TABLE `survey_answer` (
  `id`         INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `answer`     VARCHAR(255)        NOT NULL,
  `id_survey`  INT(11)             NOT NULL,
  `created_at` TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP,
  CONSTRAINT FK_SURVEY_ANSWER_SURVEY FOREIGN KEY (id_survey) REFERENCES survey (id)
);