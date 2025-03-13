DROP DATABASE `website`;

CREATE DATABASE `website` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `website`;

CREATE TABLE `visits` (
    `id` int NOT NULL AUTO_INCREMENT,
    `visitor_id` varchar(10) NOT NULL,
    `page_url` varchar(255) NOT NULL,
    `visit_time` datetime NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_visitor_id` (`visitor_id`),
    KEY `idx_page_url` (`page_url`),
    KEY `idx_visit_time` (`visit_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;