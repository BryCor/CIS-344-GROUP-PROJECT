USE mydb;

-- =====================
-- INSERT SAMPLE DATA
-- =====================

INSERT INTO pets (name, species, breed, age, Gender)
VALUES ('Max', 'Dog', 'Labrador', 3, 'Male');

INSERT INTO adopters (Name, Email)
VALUES ('John Doe', 'john@email.com');

INSERT INTO applications (adopter_id, pet_id, application_date)
VALUES (1, 1, CURDATE());

-- =====================
-- JOIN QUERY
-- =====================

SELECT 
    a.application_id,
    ad.Name,
    p.name AS pet_name,
    a.status
FROM applications a
JOIN adopters ad 
    ON a.adopter_id = ad.adopter_id
JOIN pets p 
    ON a.pet_id = p.pet_id;
    SELECT 
    ad.Name,
    p.name,
    a.application_date
FROM applications a
JOIN adopters ad ON a.adopter_id = ad.adopter_id
JOIN pets p ON a.pet_id = p.pet_id;