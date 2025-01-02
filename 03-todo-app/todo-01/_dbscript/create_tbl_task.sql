-- Create Table: task

USE todo;

CREATE TABLE task
(
  id          INT           NOT NULL PRIMARY KEY AUTO_INCREMENT,
  task        VARCHAR(255)  NOT NULL,
  created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
);