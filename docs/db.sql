CREATE TABLE `instructors` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`account` VARCHAR(100) NOT NULL UNIQUE COMMENT '講師帳號',
	`password` VARCHAR(100) NOT NULL COMMENT '儲存Hash後的密碼',
	`name` VARCHAR(20) NOT NULL COMMENT '講師名稱',
	`email` VARCHAR(50) NOT NULL COMMENT '講師信箱',
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY(`id`)
) COMMENT='講師資料表';


CREATE TABLE `courses` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL COMMENT '課程名稱',
	`description` VARCHAR COMMENT '課程描述',
	`start_time` TIME NOT NULL COMMENT '上課時間',
	`end_time` TIME NOT NULL COMMENT '下課時間',
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	`instructor_id` BIGINT UNSIGNED NOT NULL COMMENT '講師ID',
	PRIMARY KEY(`id`)
) COMMENT='課程資料表';


CREATE INDEX `courses_index_0`
ON `courses` (`instructor_id`);
CREATE TABLE `students` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`account` VARCHAR(100) NOT NULL UNIQUE,
	`password` VARCHAR(100) NOT NULL COMMENT '儲存Hash後的密碼',
	`name` VARCHAR(20) NOT NULL,
	PRIMARY KEY(`id`)
) COMMENT='學生資料表';


CREATE TABLE `course_student` (
	`student_id` BIGINT NOT NULL,
	`course_id` BIGINT NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY(`student_id`, `course_id`)
);


ALTER TABLE `instructors`
ADD FOREIGN KEY(`id`) REFERENCES `courses`(`instructor_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `students`
ADD FOREIGN KEY(`id`) REFERENCES `course_student`(`student_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE `courses`
ADD FOREIGN KEY(`id`) REFERENCES `course_student`(`course_id`)
ON UPDATE NO ACTION ON DELETE NO ACTION;