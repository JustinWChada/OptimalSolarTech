-- Create the table
CREATE TABLE admin_password (
    admin_password VARCHAR(64) NOT NULL
);

-- Insert initial random password
INSERT INTO admin_password VALUES (MD5(RAND()));
