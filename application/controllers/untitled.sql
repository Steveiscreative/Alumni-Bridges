DELIMITER //

DROP PROCEDURE IF EXISTS sp_add_alumni//

CREATE PROCEDURE sp_add_alumni (
IN     student_id     INT(20),
IN     first_name     VARCHAR(255),
IN     last_name      VARCHAR(255),
IN     street         VARCHAR(255),
IN     city           VARCHAR(255),
IN     state          VARCHAR(2),
IN     zip_code       VARCHAR(15),
IN     email          VARCHAR(255),
IN     telephone      VARCHAR(22),
IN     degree         VARCHAR(255),
IN     department     VARCHAR(255),
IN     graduation_year YEAR(4)
)

BEGIN

# DECLARE VARIABLES
DECLARE studentID INT(20);
DECLARE departmentVAL VARCHAR(255);
DECLARE degreeVal VARCHAR(255);

## DELCARE EXIT HANDLERS 
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND
BEGIN
	SELECT 'ALUMNI INSERT HAS FAILED';
	ROLLBACK;
END;

START TRANSACTION;
	# Set Variables 
	SET studentID = student_id;
	SET departmentVal = department;
	SET degreeVal = degree;

	# IF student_id is null or 0 then rollback
	IF student_id <= 0 OR student_id = NULL THEN 
		BEGIN
			SELECT 'NOT A VALID STUDENT ID';
			ROLLBACK;
		END;	
	# IF STUDENT ID exist then rollback
	ELSEIF EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = studentID ) THEN
		BEGIN
			SELECT 'ALUMNI ALREADY EXISTS';
			ROLLBACK;
		END;
	# IF Department not in database then rollback
	ELSEIF NOT EXISTS (SELECT 1 FROM valid_departments WHERE UPPER(valid_departments.department) = UPPER(departmentVal)) THEN
		BEGIN
			SELECT 'DEPARTMENT DOES NOT EXISTS';
			ROLLBACK;
		END;
	# IF Degree is not in database then rollback
	ELSEIF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE UPPER(valid_degrees.degree) = degreeVal) THEN
		BEGIN
			SELECT 'DEGREE DOES NOT EXISTS';
		END;
	# COMMIT TRANSACTION 
	ELSE 
		BEGIN
			INSERT INTO alumni (student_id, pwd ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department,graduation_year, role_id, donation_total) VALUES (student_id, NULL ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department,graduation_year, 1, 0.00);
			SELECT 'ALUMNI ADDED';
			COMMIT;
		END; 
	END IF;
END//

