CREATE TABLE `page_component` (
  `id`          INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `id_page`     INT(11)             NOT NULL,
  `position`    INT(11)             NOT NULL,
  `template_id` INT(11)             NOT NULL,
  `config`      LONGTEXT        NOT NULL,
  `created_at`  TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP,
   CONSTRAINT FK_PAGE_COMPONENT_PAGE FOREIGN KEY (id_page) REFERENCES page (id)
);