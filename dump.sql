CREATE TABLE "users" (
    "id" INTEGER(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    "username" VARCHAR(64) COLLATE utf8mb4_unicode_ci NOT NULL,
    "created_at" TIMESTAMP COLLATE utf8mb4_unicode_ci  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;