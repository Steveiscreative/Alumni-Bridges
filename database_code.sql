## STORED PROCEDURES
###############################################################
###############################################################
###############################################################

## ADD ALUMNI 
###############################################################

DELIMITER //

# IF PROCEDURE IF EXISTS THEN DROP
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
#DECLARE VARIABLE
DECLARE studentID INT(20);
DECLARE departmentVAL VARCHAR(255);
DECLARE degreeVal VARCHAR(255);

## DECLARE IF SQL ERRORS THEN ROLLBACK
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
		SELECT 'ALUMNI INSERT HAS FAILED';
		ROLLBACK;
	END;

START TRANSACTION;
	## SET VARIABLES
	SET studentID = student_id;
	SET departmentVal = department;
	SET degreeVal = degree;

	# IF STUDENT ID IS LESS THAN OR EQUAL TO ZERO ROLLBACK
	IF student_id <= 0 THEN

		SELECT 'NOT A VALID STUDENT ID';
		ROLLBACK;
		##IF STUDENT_ID EXSIST IN ALUMNI TABLE ROLLBACK
		ELSEIF EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = studentID ) THEN

			SELECT 'ALUMNI ALREADY EXISTS';
			ROLLBACK;
		## IF DEPARTMENT DOESN'T EXISTS IN valid_department THEN ROLEBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM valid_departments WHERE UPPER(valid_departments.department) = UPPER(departmentVal)) THEN
			
			SELECT 'DEPARTMENT DOES NOT EXISTS';
			ROLLBACK;
		## IF DEGREE DOESN'T EXIST IN valid_degree THEN ROLLBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE UPPER(valid_degrees.degree) = UPPER(degreeVal)) THEN
			SELECT 'DEGREE DOES NOT EXISTS';
			ROLLBACK;
		ELSE
		# ALUMNI HAS BEEN ADDED
			BEGIN
				SELECT 'ALUMNI ADDED';
				INSERT INTO alumni (student_id, pwd ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department,graduation_year, role_id, donation_total) VALUES (student_id, NULL ,first_name, last_name, street, city, state, zip_code, email, telephone, degree, department,graduation_year, 1, 0.00);
			COMMIT;
		END; 
	END IF;
END//

## DELETE ALUMNI 
###############################################################

DELIMITER //
# IF PROCEDURE IF EXISTS THEN DROP
DROP PROCEDURE IF EXISTS sp_delete_admin//

CREATE PROCEDURE sp_delete_alumni (
IN 	id INT(20)
)
BEGIN
## DECLARE VARIABLES
DECLARE idVal INT(20);

## DECLARE IF SQL ERRORS THEN ROLLBACK
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
	   SELECT 'ALUMNI DROP HAS FAILED';
	   ROLLBACK;
	END;

START TRANSACTION;

	## SET VARIABLE idVal AS ID
   	SET idVal = id;

   	## ID ALUMNI DOESN'T EXIST ROLEBACK
	IF NOT EXISTS (SELECT 1 FROM alumni WHERE alumni.id = idVal ) THEN
	   	SELECT 'ALUMI DOES NOT EXISTS';
	   	ROLLBACK;
		ELSE 
		## DELETE ALUMNI 
		  BEGIN  
	  		SELECT 'ALUMNI DELETED';
	       	DELETE FROM alumni WHERE alumni.id = id
	       	COMMIT;
		  END; 
	END IF;

END//

## UPDATE ALUMNI 
###############################################################

DELIMITER //

# IF PROCEDURE IF EXISTS THEN DROP
DROP PROCEDURE IF EXISTS sp_update_alumni//

CREATE PROCEDURE sp_update_alumni (
IN     student_id     INT(20),
IN     first_name     VARCHAR(255),
IN     last_name      VARCHAR(255),
IN     pwd      	  VARCHAR(64),
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

#DECLARE VARIABLE
DECLARE studentID INT(20);
DECLARE departmentVAL VARCHAR(255);
DECLARE degreeVal VARCHAR(255);
DECLARE pwdCHECK VARCHAR(64);

## DECLARE IF SQL ERRORS THEN ROLLBACK
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
		SELECT 'ALUMNI UPDATE HAS FAILED';
		ROLLBACK;
	END;
START TRANSACTION;
	## SET VARIABLES
	SET studentID = student_id;
	SET departmentVal = department;
	SET degreeVal = degree;
	SET pwdCHECK = pwd; 
	
	## IF NOT NULL THEN MD5 ENCRPYT
	IF pwdCHECK != 'NULL' THEN 
		SET pwd = MD5(pwdCHECK);
	END IF;
	# IF STUDENT ID IS LESS THAN OR EQUAL TO ZERO ROLLBACK
	IF student_id <= 0 THEN
		SELECT 'NOT A VALID STUDENT ID';
		ROLLBACK;
		##IF STUDENT_ID DOESN'T EXSIST IN ALUMNI TABLE ROLLBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = studentID ) THEN
			SELECT 'ALUMNI DOES NOT EXISTS';
			ROLLBACK;
		## IF DEPARTMENT DOESN'T EXISTS IN valid_department THEN ROLEBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM valid_departments WHERE UPPER(valid_departments.department) = UPPER(departmentVal)) THEN
			SELECT 'DEPARTMENT DOES NOT EXISTS';
			ROLLBACK;
		## IF DEGREE DOESN'T EXIST IN valid_degree THEN ROLLBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE UPPER(valid_degrees.degree) = UPPER(degreeVal)) THEN
			SELECT 'DEGREE DOES NOT EXISTS';
			ROLLBACK;
		ELSE
		# ALUMNI UPDATE
			BEGIN
				SELECT 'ALUMNI INFO UPDATED';
				UPDATE alumni SET alumni.pwd = pwd ,
				  alumni.first_name = first_name, 
				  alumni.last_name = last_name, 
				  alumni.street =street, 
				  alumni.city = city, 
				  alumni.state = state, 
				  alumni.zip_code = zip_code, 
				  alumni.email = email, 
				  alumni.telephone = telephone, 
				  alumni.degree = degree, 
				  alumni.department = department,
				  alumni.graduation_year = graduation_year
				WHERE alumni.student_id = student_id; 
			COMMIT;
		END; 
	END IF;
END//


## UPDATE ALUMNI ACCOUNT
###############################################################

DELIMITER //

# IF PROCEDURE IF EXISTS THEN DROP
DROP PROCEDURE IF EXISTS sp_update_alumni_account//

CREATE PROCEDURE sp_update_alumni_account (
IN     student_id     INT(20),
IN     first_name     VARCHAR(255),
IN     last_name      VARCHAR(255),
IN     street         VARCHAR(255),
IN     city           VARCHAR(255),
IN     state          VARCHAR(2),
IN     zip_code       VARCHAR(15),
IN     email          VARCHAR(255),
IN     telephone      VARCHAR(22),
IN 	   twitter		  VARCHAR(255),
IN     facebook		  VARCHAR(255), 
IN 	   linkedin		  VARCHAR(255)
)
BEGIN

#DECLARE VARIABLE
DECLARE studentID INT(20);

## DECLARE IF SQL ERRORS THEN ROLLBACK
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
		SELECT 'ALUMNI UPDATE HAS FAILED';
		ROLLBACK;
	END;
START TRANSACTION;
	## SET VARIABLES
	SET studentID = student_id;
	
	# IF STUDENT ID IS LESS THAN OR EQUAL TO ZERO ROLLBACK
	IF student_id <= 0 THEN
		BEGIN
			SELECT 'NOT A VALID STUDENT ID';
			ROLLBACK;
		END;
		##IF STUDENT_ID DOESN'T EXSIST IN ALUMNI TABLE ROLLBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = studentID ) THEN
			SELECT 'ALUMNI DOES NOT EXISTS';
			ROLLBACK;
		ELSEIF NOT EXISTS( SELECT 1 FROM social_media WHERE social_media.student_id = studentID) THEN
		# IF student id DOESN'T EXIST IN social media AND IF ANY THE SOCIAL MEDIA VALUES ARE ARE NOT NULL THEN CREATE ROW
			BEGIN
				IF twitter IS NOT NULL OR facebook IS NOT NULL OR linkedin IS NOT NULL THEN
					INSERT INTO social_media (social_media.student_id, social_media.facebook, social_media.twitter, social_media.linkedin)
					VALUES (studentID , facebook, twitter, linkedin);
				END IF; 
			END;
		ELSEIF EXISTS( SELECT 1 FROM social_media WHERE social_media.student_id = studentID) THEN 
		## IF STUDENT DEGREE ALREADY EXIST IN social_media table THEN UPDATE
			BEGIN 
				UPDATE social_media SET
				social_media.facebook = facebook, 
				social_media.twitter = twitter, 
				social_media.linkedin = linkedin
				WHERE social_media.student_id = studentID; 
			END;
		ELSE
		# ALUMNI UPDATE
			BEGIN
				SELECT 'ALUMNI INFO UPDATED';
				UPDATE alumni SET
				  alumni.first_name = first_name, 
				  alumni.last_name = last_name, 
				  alumni.street =street, 
				  alumni.city = city, 
				  alumni.state = state, 
				  alumni.zip_code = zip_code, 
				  alumni.email = email, 
				  alumni.telephone = telephone
				WHERE alumni.student_id =  studentID; 
			COMMIT;
		END; 
	END IF;
END//






## ADD ADMIN
###############################################################

DELIMITER //

DROP PROCEDURE IF EXISTS sp_add_admin//

CREATE PROCEDURE sp_add_admin (
IN     email     	VARCHAR(255),
IN     first_name   VARCHAR(255),
IN     last_name    VARCHAR(255), 
IN     pwd     		VARCHAR(64), 
IN     role     	INT(1)
)
BEGIN
	## DECLARE VARIABLE
	DECLARE emailVal VARCHAR(255);
	DECLARE roleCheck INT(1); 

	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
		BEGIN
		SELECT 'ADMIN INSERT HAS FAILED';
		ROLLBACK;
	END;

	START TRANSACTION;

		SET emailVal = email;
		SET roleCheck = role; 

		## IF ROLE IS LESS THAN OR EQUAL TO 1 THEN ROLLBACK
		IF role <= 1 THEN
			BEGIN
				ROLLBACK;
				SELECT 'NOT A VALID ROLE FOR ADMIN';
			END;
		## IF ADMIN EMAIL EXIST THEN ROLLBACK
		ELSEIF EXISTS (SELECT 1 FROM admin WHERE UPPER(admin.email) = UPPER(emailVal) ) THEN
			BEGIN
				ROLLBACK;
				SELECT 'ADMIN ALREADY EXISTS';
			END;
		ELSE 
		## ADD ADMIN
			BEGIN
				SELECT 'ADMIN ADDED';
				INSERT INTO admin (email,first_name,last_name, pwd,role_id) VALUES (email,first_name,last_name, MD5(pwd),role);
				COMMIT;
			END;
		END IF;
END//

## UPDATE ADMIN
###############################################################

DELIMITER //

DROP PROCEDURE IF EXISTS sp_update_admin//

CREATE PROCEDURE sp_update_admin (
IN 	   id 			INT(20),
IN     email     	VARCHAR(255),
IN     first_name   VARCHAR(255),
IN     last_name    VARCHAR(255), 
IN     pwd     		VARCHAR(64), 
IN     role     	INT(1)
)
BEGIN
	## DECLARE VARIABLE
	DECLARE emailVal VARCHAR(255);
	DECLARE roleCheck INT(1); 
	DECLARE pwdCHECK VARCHAR(64);
	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
		BEGIN
		SELECT 'ADMIN UPDATE HAS FAILED';
		ROLLBACK;
	END;

	START TRANSACTION;

		SET emailVal = email;
		SET roleCheck = role; 
		SET pwdCHECK = pwd; 

		## IF NOT NULL THEN MD5 ENCRPYT
		IF pwdCHECK != 'NULL' THEN 
			SET pwd = MD5(pwdCHECK);
		END IF;

		## IF ROLE IS LESS THAN OR EQUAL TO 1 THEN ROLLBACK
		IF role <= 1 THEN
			BEGIN
				ROLLBACK;
				SELECT 'NOT A VALID ROLE FOR ADMIN';
			END;
		## IF ADMIN.ID DOESN'T EXIST, ROLLBACK
		ELSEIF NOT EXISTS (SELECT 1 FROM admin WHERE admin.id = id) THEN
			BEGIN
				ROLLBACK;
				SELECT 'ADMIN ID DOES NOT EXISTS';
			END;
		ELSE 
		## ADD ADMIN
			BEGIN
				SELECT 'ADMIN INFO UPDATED';
				UPDATE admin 
				SET admin.email = email,
					admin.first_name = first_name,
					admin.last_name = last_name, 
					admin.pwd = pwd,
					admin.role_id = role_id
				WHERE admin.id = id;
				COMMIT;
			END;
		END IF;
END//

## DELETE ADMIN
###############################################################

DELIMITER //

DROP PROCEDURE IF EXISTS sp_delete_admin//

CREATE PROCEDURE sp_delete_admin (
IN     id INT(20)
)
BEGIN
	## SET VARIABLES
	DECLARE idVal INT(20);

	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	  BEGIN
	       SELECT 'ADMIN DROP HAS FAILED';
	       ROLLBACK;
	  END;

	START TRANSACTION;

	SET idVal = id;
	## IF ADMIN'S ID DOESN'T EXIST, ROLLBACK
	IF NOT EXISTS (SELECT 1 FROM admin WHERE admin.id = idVal ) THEN
		SELECT 'ADMIN DOES NOT EXISTS';
		ROLLBACK;
	ELSE 
	## DELETE ADMIN 
		BEGIN
		    SELECT 'ADMIN DELETED';
		    DELETE FROM admin WHERE admin.id = id;
			COMMIT;
		END; 
	END IF;
	
END//


## ADD VALID DEGREE
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_add_valid_degree //

CREATE PROCEDURE sp_add_valid_degree( IN degree VARCHAR(255))
BEGIN
	## DECLARE VARIABLES 
	DECLARE degreeVal VARCHAR(255);

	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND 
	BEGIN
		ROLLBACK;
		SELECT 'DEGREE INSERT HAS FAILED';
	END;

	START TRANSACTION;

	## SET VARIABLES
	SET degreeVal = degree;

	## IF DEGREE EXIST THEN ROLLBACK 
	IF EXISTS (SELECT 1 FROM valid_degrees WHERE (UPPER(valid_degrees.degree) = UPPER(degreeVal)) THEN
	BEGIN
		SELECT 'THIS DEGREE ALREADY EXISTS';
		ROLLBACK;
		END; 
	ELSE 
	## ADD DEGREE
		BEGIN
			SELECT 'DEGREE ADDED';
			INSERT INTO valid_degrees (degree) VALUES (degree);
			COMMIT;
		END; 
	END IF;
END//

## UPDATE VALID DEGREE
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_update_valid_degree //

CREATE PROCEDURE sp_update_valid_degree( 
	IN id INT, 
	IN degree VARCHAR(255)
)
BEGIN
	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND 
	BEGIN
		ROLLBACK;
		SELECT 'DEGREE UPDATE HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEGREE EXIST THEN ROLLBACK 
	IF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE valid_degrees.id = id) THEN
	BEGIN
		SELECT 'THIS DEGREE DOES NOT EXISTS';
		ROLLBACK;
		END; 
	ELSE 
	## ADD DEGREE
		BEGIN
			SELECT 'DEGREE HAS BEEN UPDATED';
			UPDATE valid_degrees
			SET valid_degree.degree = degree
			WHERE valid_degrees.id = id;
			COMMIT;
		END; 
	END IF;
END//

## DELETE VALID DEGREE
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_delete_valid_degree // 

CREATE PROCEDURE sp_delete_valid_degree( IN id INT)
BEGIN
	## DECLARE VARIABLES
	DECLARE degreeVal VARCHAR(255);

	## DECLARE IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
		ROLLBACK;
		SELECT 'DEGREE INSERT HAS FAILED';
	END;

	START TRANSACTION;

	## SET DEGREE VARIABLES
	SET degreeVal = degree;

	## IF DEGREE DOESN'T EXIST THEN ROLLBACK
	IF NOT EXISTS (SELECT 1 FROM valid_degrees WHERE UPPER(valid_degrees.degree) = UPPER(degreeVal)) THEN
		BEGIN
			SELECT 'THIS DEGREE DOES NOT EXIST';
			ROLLBACK;
		END; 
	ELSE
	## DELETE DEGREE 
		BEGIN
			SELECT 'DEGREE DELETED';
			DELETE FROM valid_degrees WHERE valid_degrees.degree = degree;
			COMMIT;
		END;
	END IF;
END//

## ADD VALID DEPARTMENT
###############################################################

DELIMITER //
## IF PROCEDURE EXIST, DROP 
DROP PROCEDURE IF EXISTS sp_add_valid_department //

CREATE PROCEDURE sp_add_valid_department( IN department VARCHAR(255))
BEGIN
	## DECLARE VARIABLES
	DECLARE departmentVal VARCHAR(255);

	## IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
	   ROLLBACK;
	   SELECT 'DEPARTMENT INSERT HAS FAILED';
	END;

	START TRANSACTION;

	SET departmentVal = department;

	## IF VALID DEPARTMENT ALREADY EXISTS, ROLLBACK
	IF EXISTS (SELECT 1 FROM valid_departments WHERE UPPER(valid_departments.department) = UPPER(departmentVal)) THEN
		BEGIN
		   SELECT 'THIS DEPARTMENT ALREADY EXISTS';
		   ROLLBACK;
	   	END;
	ELSE 
	## ADD DEPARTMENT
		BEGIN
	  		SELECT 'DEPARTMENT HAS BEEN ADDED';
	 		INSERT INTO valid_departments (department) VALUES (department);
			COMMIT;
		END; 
	END IF;
END//

## UPDATE VALID DEPARTMENT
###############################################################
#
DELIMITER //
## IF PROCEDURE EXIST, DROP 
DROP PROCEDURE IF EXISTS sp_update_valid_department //

CREATE PROCEDURE sp_update_valid_department( 
	IN id INT, 
	IN department VARCHAR(255)
)
BEGIN
	## DECLARE VARIABLES
	DECLARE departmentVal VARCHAR(255);

	## IF SQL ERRORS THEN ROLLBACK
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND 
	BEGIN
	   ROLLBACK;
	   SELECT 'DEPARTMENT UPDATE HAS FAILED';
	END;

	START TRANSACTION;

	SET departmentVal = department;

	## IF VALID DEPARTMENT ID DOSEN'T EXISTS, ROLLBACK
	IF NOT EXISTS (SELECT 1 FROM valid_departments WHERE valid_departments.id = id) THEN
		BEGIN
		   SELECT 'THIS DEPARTMENT DOES NOT EXISTS';
		   ROLLBACK;
	   	END;
	ELSE 
	## ADD DEPARTMENT
		BEGIN
	  		SELECT 'DEPARTMENT HAS BEEN UPDATED';
	 			UPDATE valid_departments
				SET valid_departments.department = department
				WHERE valid_departments.id = id;
			COMMIT;
		END; 
	END IF;
END//

## DELETE VALID DEPARTMENT
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_delete_valid_department //

CREATE PROCEDURE sp_delete_valid_department( IN department VARCHAR(255) )
BEGIN
	## DECLARE VARIABLES
	DECLARE departmentVal VARCHAR(255);

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'DEPARTMENT INSERT HAS FAILED';
	END;


	START TRANSACTION;

	SET departmentVal = department;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF NOT EXISTS (SELECT 1 FROM valid_departments WHERE UPPER(valid_departments.department) = UPPER(departmentVal)) THEN
		BEGIN
			SELECT 'THIS DEPARTMENT DOES NOT EXIST';
			ROLLBACK;
		END; 
	ELSE 
	## DELETE DEPARTMENT
		BEGIN
			SELECT 'DEPARTMENT DELETED';
			DELETE FROM valid_departments WHERE valid_departments.department = department;
		COMMIT;
		END;
	END IF;
END//

## ADD DONATIONS
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_add_donations//

CREATE PROCEDURE sp_add_donations (
IN     student_id INT(20),
IN     donation_amount DECIMAL(10,2),
IN     payment_type VARCHAR(150),
IN     date_donated    DATE
)
BEGIN
## DECLARE VARIABLES
DECLARE studentID INT(20);
DECLARE paymentType VARCHAR(150);
DECLARE donationAmount DECIMAL(10,2);
DECLARE recentSubID INT(20);

## IF SQL ERRORS ROLLBACK
DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		SELECT 'DONATION INSERT HAS FAILED';
		ROLLBACK;
	END;

# START TRANSACTION
START TRANSACTION;

# SET VARIABLES
SET paymentType = payment_type;
SET donationAmount = donation_amount;

## IF STUDENT_ID IS EQUAL TO 0 THEN ROLLBACK
IF student_id <= 0 THEN
	BEGIN
		SELECT 'NOT A VALID STUDENT ID';
		ROLLBACK;
	END;
## IF STUDENT_ID DOESN'T EXIST THEN ROLLBACK 
ELSEIF NOT EXISTS (SELECT 1 FROM alumni WHERE alumni.student_id = student_id) THEN
	BEGIN
		SELECT 'ALUMNI DOES NOT EXIST';
		ROLLBACK;
	END; 
## IF DONATION AMOUNT IS <= 0 THEN ROLLBACK 
ELSEIF donationAmount <= 0 THEN
	BEGIN
		SELECT 'NOT A VALID AMOUNT';
		ROLLBACK;
	END;
## IF PAYMENT TYPE IS NOT IN valid_payment_type table, rollback
ELSEIF NOT EXISTS (SELECT 1 FROM valid_payment_type WHERE UPPER(valid_payment_type.payment_type) = UPPER(paymentType)) THEN
	BEGIN
		SELECT 'PAYMENT TYPE DOES NOT EXIST';
		ROLLBACK;
	END; 
ELSE
	BEGIN
		SELECT 'DONATION ADDED';
		## INSERT DONATION INFO INTO DONATIONS TABLE
		INSERT INTO donations (payment_type,donation_amount,date_donated) VALUES (payment_type,donation_amount,date_donated);

		## GET THE MOST RECENT DONATION IN DONATION TABLE AND GET ID.
		SET recentSubID =  (SELECT id FROM donations ORDER BY id DESC LIMIT 1);

		## INSERT THE MOST RECENT ID AND THE STUDENT ID INTO ALUMNI_DONATIONS TABLE
		INSERT INTO  alumni_donations (student_id,donation_id) VALUES (student_id,recentSubID);
		COMMIT;
	END;
END IF;
END//


## CREATE STORE PROCUDURES FOR REPORTING
###############################################################

## YEAR DONATION TOTAL 
###############################################################
DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_year_donation_total //

CREATE PROCEDURE sp_report_year_donation_total( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'YEAR DONATION TOTAL HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION SUM FOR THE SPECIFIED YEAR
		BEGIN
			SELECT SUM(donation_amount) AS donation_amount FROM donations WHERE YEAR(date_donated) = theYear;
			COMMIT;
		END;
	END IF;
END//

## DONATIONS COUNT
###############################################################
DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_year_count //

CREATE PROCEDURE sp_report_year_count( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'YEAR DONATION COUNT HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY MONTH 
		BEGIN
			SELECT COUNT(donation_amount) FROM donations WHERE YEAR(date_donated) = theYear;
			COMMIT;
		END;
	END IF;
END//


## DONATIONS BY MONTH
###############################################################
DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_month_by_donations //

CREATE PROCEDURE sp_report_month_by_donations( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'MONTHLY DONATIONS REPORT HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY MONTH 
		BEGIN
			SELECT MONTH(date_donated) AS month, SUM(donation_amount) AS total
			FROM donations
			WHERE YEAR(date_donated) = theYear 
			GROUP BY MONTH(date_donated);
			COMMIT;
		END;
	END IF;
END//

## DONATIONS BY PAYMENT TYPE
###############################################################
DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_donations_by_type //

CREATE PROCEDURE sp_report_donations_by_type( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'DONATIONS BY TYPE REPORT HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY PAYMENT_TYPE
		BEGIN
			SELECT payment_type, SUM(donation_amount) AS total 
			FROM donations 
			WHERE YEAR(date_donated) = theYear 
			GROUP BY payment_type;
			COMMIT;
		END;
	END IF;
END//

## DONATIONS BY DEPARTMENT
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_donations_by_department //

CREATE PROCEDURE sp_report_donations_by_department( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'DONATIONS BY DEPARMENT HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY DEPARMENT
		BEGIN
			SELECT alumni.department, SUM(alumni.donation_total) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(date_donated) = theYear
			GROUP BY alumni.department;
		END;
	END IF;
END//

## DONATIONS BY CLASS
###############################################################

DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_donations_by_class //

CREATE PROCEDURE sp_report_donations_by_class( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'DONATIONS BY DEPARMENT HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY graduation_year
		BEGIN
			SELECT alumni.graduation_year, SUM(alumni.donation_total) AS total 
			FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
	 		WHERE YEAR(date_donated) = theYear
	 		GROUP BY alumni.graduation_year;
		END;
	END IF;
END//

## TOP THREE DONATORS 
###############################################################
#
DELIMITER //
DROP PROCEDURE IF EXISTS sp_report_top_donators //

CREATE PROCEDURE sp_report_top_donators( 
	IN theYear YEAR(4) 
)
BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'TOP DONATORS HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT count(id) from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY graduation_year
		BEGIN
			SELECT alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(donations.date_donated) = theYear
			GROUP BY alumni.student_id 
			ORDER BY donations.donation_amount DESC 
			LIMIT 0, 3;
		END;
	END IF;
END//

## ALUMNI SET PASSWORD
###############################################################
DELIMITER //
DROP PROCEDURE IF EXISTS sp_alumni_set_password //

CREATE PROCEDUREsp_alumni_set_password( 
	IN student_id INT(20), 
	IN first_name VARCHAR(255), 
	IN last_name VARCHAR(255)
	IN pwd VARCHAR(64)
)

BEGIN

	## IF SQL ERRORS ROLLBACK 
	DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
	BEGIN
		ROLLBACK;
		SELECT 'SETTING PASSWORD HAS FAILED';
	END;

	START TRANSACTION;

	## IF DEPARMENT DOESN'T EXISTS THEN ROLLBACK
	IF (SELECT 1 from donations WHERE YEAR(date_donated) = theYear) = 0 THEN
		BEGIN
			SELECT 'NO DONATIONS FOR THIS YEAR';
			ROLLBACK;
		END; 
	ELSE 
	## GET DONATION GROUPED BY graduation_year
		BEGIN
			SELECT alumni.first_name, alumni.last_name, SUM(donations.donation_amount) AS total FROM alumni_donations 
			LEFT JOIN alumni ON alumni_donations.student_id = alumni.student_id
			LEFT JOIN donations ON alumni_donations.donation_id = donations.id
			WHERE YEAR(donations.date_donated) = theYear
			GROUP BY alumni.student_id 
			ORDER BY donations.donation_amount DESC 
			LIMIT 0, 3;
		END;
	END IF;
END//

# ADD SOCIAL MEDIA 
################################################################
DELIMITER //

## IF PROCEDURE EXIST THEN DROP
DROP PROCEDURE IF EXISTS sp_add_social_media//

CREATE PROCEDURE sp_add_social_media (
IN   social_media VARCHAR(255)
)
BEGIN	
	## DECLARE LOCAL VARIABLES
     DECLARE socialMedia VARCHAR(255);
     DECLARE socialMediaAltered VARCHAR(255);
 	
 	# DECLARE IF SQL WARNINGS THEN ROLLBACK AND DISPLAY MESSAGE
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'SOCIAL MEDIA ADDITION HAS FAILED';
               ROLLBACK;
          END;
    # START THE TRANSACTION 
     START TRANSACTION;
     	#SET VARIABLES
		SET socialMedia = social_media;

		# IF SOCIAL MEDIA EXIST IN VALID SOCIAL MEDIA THEN ROLLBACK
		IF EXISTS (SELECT 1 FROM valid_social_media WHERE UPPER(valid_social_media.social_media) = UPPER(socialMedia) ) THEN
		BEGIN
		   SELECT 'SOCIAL MEDIA ALREADY EXISTS';
		   ROLLBACK;
		END;
     ELSE 
     	BEGIN
     		# ALTER SOCIAL MEDIA TO TABLE FRIENDLY NAME
     		# MAKE LOWER CASE AND TURN SPACES INTO UNDERSCORES
			SET socialMediaAltered = LOWER(REPLACE(social_media, ' ', '_'));

			## INSERT UNALTERED NAME INTO VALID_SOCIAL_MEDIA TABLE
			INSERT INTO  valid_social_media (social_media) VALUES (socialMedia);

			# SET AN ALTER STATEMENT TO SOCIAL_MEDIA TABLE ADDING ALTERED SOCIAL MEDIA NAME
			SET @alterSM = CONCAT('alter table social_media add (',socialMediaAltered, ' ', 'VARCHAR(150)' , ')');
			# PREPARE THE STATEMENT SET ABOVE
			PREPARE STMT FROM @alterSM;
			# EXECUTE STATEMENT
			EXECUTE STMT;

			COMMIT;

			SELECT 'SOCIAL MEDIA ADDED';
		END; 
		
     END IF;
END//

## IF PROCEDURE EXIST THEN DROP
DROP PROCEDURE IF EXISTS sp_delete_social_media//

CREATE PROCEDURE sp_delete_social_media (
IN   social_media VARCHAR(255)
)
BEGIN	
	## DECLARE LOCAL VARIABLES
     DECLARE socialMedia VARCHAR(255);
     DECLARE socialMediaAltered VARCHAR(255);
 	
 	# DECLARE IF SQL WARNINGS THEN ROLLBACK AND DISPLAY MESSAGE
     DECLARE EXIT HANDLER FOR SQLWARNING, SQLEXCEPTION, NOT FOUND , SQLEXCEPTION, NOT FOUND
          BEGIN
               SELECT 'SOCIAL MEDIA DELETION HAS FAILED';
               ROLLBACK;
          END;
    # START THE TRANSACTION 
     START TRANSACTION;
     	#SET VARIABLES
		SET socialMedia = social_media;

		# IF SOCIAL MEDIA EXIST IN VALID SOCIAL MEDIA THEN ROLLBACK
		IF EXISTS (SELECT 1 FROM valid_social_media WHERE UPPER(valid_social_media.social_media) = UPPER(socialMedia) ) THEN
		BEGIN
		   SELECT 'SOCIAL MEDIA ALREADY EXISTS';
		   ROLLBACK;
		END;
     ELSE 
     	BEGIN
     		# ALTER SOCIAL MEDIA TO TABLE FRIENDLY NAME
     		# MAKE LOWER CASE AND TURN SPACES INTO UNDERSCORES
			SET socialMediaAltered = LOWER(REPLACE(social_media, ' ', '_'));

			## INSERT UNALTERED NAME INTO VALID_SOCIAL_MEDIA TABLE
			INSERT INTO  valid_social_media (social_media) VALUES (socialMedia);

			# SET AN ALTER STATEMENT TO SOCIAL_MEDIA TABLE ADDING ALTERED SOCIAL MEDIA NAME
			SET @alterSM = CONCAT('alter table social_media add (',socialMediaAltered, ' ', 'VARCHAR(150)' , ')');
			# PREPARE THE STATEMENT SET ABOVE
			PREPARE STMT FROM @alterSM;
			# EXECUTE STATEMENT
			EXECUTE STMT;

			COMMIT;

			SELECT 'SOCIAL MEDIA ADDED';
		END; 
		
     END IF;
END//

## TRIGGERS
###############################################################
###############################################################
###############################################################

## TOTAL_DONATIONS IN ALUMNI TABLE TRIGGER
DELIMITER //

DROP TRIGGER IF EXISTS alumni_donation_total//

## CREATE TRIGGER FOR EVER TIME SOMEONE INSERTS INTO ALUMNI_DONATIONS
CREATE TRIGGER alumni_donation_total
AFTER INSERT ON alumni_donations
FOR EACH ROW

BEGIN
	## DECLARE VARIABLES
	DECLARE recentSubID INT;
	DECLARE recentSID INT;
	DECLARE donation_total_amount DECIMAL(10,2);
	DECLARE recent_donation DECIMAL(10,2);
	DECLARE new_total DECIMAL(10,2);

	## SELECT the ID FROM THE MOST RECENT INSERT
	SET recentSubID =  (SELECT id FROM alumni_donations ORDER BY id DESC LIMIT 1);
	## GET THE STUDENT_ID FROM THE MOST RECENT INSERT
	SET recentSID = (SELECT student_id FROM alumni_donations WHERE id = recentSubID);
	## GET THE DONATION_TOTAL WHERE WHERE STUDENT_ID = recentSID IN THE ALUMNI TABLE
	SET donation_total_amount = (SELECT donation_total FROM alumni where student_id = recentSID);
	## GET DONATION AMOUNT IN THE ALUMNI_DONATIONS TABLE
	SET recent_donation = (SELECT donation_amount FROM alumni_donations LEFT JOIN donations ON alumni_donations.donation_id = donations.id WHERE alumni_donations.id = recentSubID);   
	## ADD THE CURRENT TOTAL IN THE ALUMNI TABLE AND RECENT DONATION IN ALUMNI_DONATION
	SET new_total = (SELECT donation_total FROM alumni where student_id = recentSID + recent_donation);

	## UPDATE ALUMNI DONATION_TOTAL TO NEW TOTAL
	UPDATE alumni
	SET alumni.donation_total =  donation_total_amount + recent_donation
	WHERE student_id = recentSID;
END//



## INDEXES
###############################################################
###############################################################
###############################################################

CREATE INDEX alumni_search ON alumni(first_name, last_name, student_id);







