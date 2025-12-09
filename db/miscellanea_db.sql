CREATE DATABASE ost_miscellanea;

CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_title VARCHAR(255) NOT NULL,
    service_description VARCHAR(255) NOT NULL,
    date_uploaded DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_edited DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL DEFAULT 'active'
);

CREATE TABLE services_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    service_img_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE CASCADE
);

INSERT INTO services (service_title, service_description, status) VALUES
('Air Conditioning Installation', 'Expert installation of residential and commercial air conditioning units with energy-efficient solutions.', 'active'),
('Aircon Troubleshooting', 'Diagnose and repair issues with air conditioning systems quickly and efficiently.', 'active'),
('Vehicle Air Conditioning', 'Installation, repair, and maintenance of vehicle air conditioning systems for all car types.', 'active'),
('Aircon Servicing', 'Regular maintenance and servicing of air conditioning units to ensure optimal performance.', 'active'),
('Solar Installation', 'Design, installation, and maintenance of solar panel systems for sustainable energy solutions.', 'active');

INSERT INTO services_images (service_id, service_img_path) VALUES
(1, 'ac-repair.jpeg'),
(2, 'pic1-home.PNG'),
(3, 'pic6-quote.PNG'),
(4, 'pic2-services.PNG'),
(5, 'pic4-whyus.PNG');

