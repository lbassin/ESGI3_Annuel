CREATE TABLE `reset_password` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `token`       VARCHAR(50)         NOT NULL,
  `user_id`     int(11)             NOT NULL,
  `created_at`  TIMESTAMP             NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME,
  CONSTRAINT FK_RESET_PASSWORD_USER FOREIGN KEY (user_id) REFERENCES user (id)
);