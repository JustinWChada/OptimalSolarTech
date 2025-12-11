CREATE DATABASE ost_users

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    user_phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    is_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(255),
    password_reset_token VARCHAR(255),
    password_reset_expires TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_is_active (is_active)
);

$sql = "CREATE TABLE users (\n"

    . "    user_id INT PRIMARY KEY AUTO_INCREMENT,\n"

    . "    username VARCHAR(50) NOT NULL UNIQUE,\n"

    . "    email VARCHAR(100) NOT NULL UNIQUE,\n"

    . "    password_hash VARCHAR(255) NOT NULL,\n"

    . "    first_name VARCHAR(100),\n"

    . "    last_name VARCHAR(100),\n"

    . "    user_phone VARCHAR(20),\n"

    . "    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n"

    . "    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n"

    . "    last_login TIMESTAMP NULL,\n"

    . "    is_active BOOLEAN DEFAULT TRUE,\n"

    . "    is_verified BOOLEAN DEFAULT FALSE,\n"

    . "    verification_token VARCHAR(255),\n"

    . "    password_reset_token VARCHAR(255),\n"

    . "    password_reset_expires TIMESTAMP NULL,\n"

    . "    INDEX idx_email (email),\n"

    . "    INDEX idx_username (username),\n"

    . "    INDEX idx_is_active (is_active)\n"

    . ");";