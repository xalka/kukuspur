/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: babutalk2
-- ------------------------------------------------------
-- Server version	10.6.22-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping routines for database 'babutalk2'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP FUNCTION IF EXISTS `ValidString` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` FUNCTION `ValidString`(input VARCHAR(1000)) RETURNS varchar(1000) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    SQL SECURITY INVOKER
BEGIN
	RETURN CASE WHEN input IN ('0', '', 'null') THEN NULL ELSE input END;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ARTICLE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ARTICLE`( 
	IN inAction INT, 
	IN inArticleId INT,
	IN inAuthorId INT,
	IN inUserId INT,
	IN inCustomerId INT,
	IN inCategoryId INT,
	IN inTitle VARCHAR(1000),
	IN inSubTitle VARCHAR(1000),
	IN inContent LONGTEXT, 
	IN inTags VARCHAR(500),
	IN inImg VARCHAR(500), 
	IN inStatusId INT,
	IN inTopStory INT,
    IN inPublishedAt DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN 

	DECLARE dImg VARCHAR(255) DEFAULT NULL;

	CASE inAction
		-- list of categories
        WHEN 1 THEN
			SELECT categoryId,title FROM categories ORDER BY title LIMIT 20;
			LEAVE PROC;
         
		-- new article
        WHEN 2 THEN
            SET inTitle = ValidString(inTitle);
            SET inSubTitle = ValidString(inSubTitle);
            SET inImg = ValidString(inImg);
            SET inTitle = ValidString(inTitle);
            
            INSERT INTO articles(title,subtitle,tags,content,statusId,topstory,categoryId,authorId,img,publishedAt)
            VALUE(inTitle,inSubTitle,inTags,inContent,inStatusId,cast(inTopStory as char),inCategoryId,inAuthorId,inImg,inPublishedAt);

            SELECT ROW_COUNT() created, LAST_INSERT_ID() articleId;
			LEAVE PROC;
            
		-- list of articles
        WHEN 3 THEN -- select inPublished;
			SELECT a.articleId, a.title, a.subtitle, a.topstory, a.tags, a.img, c.categoryId, c.title category, s.statusId, 
				s.status, a.publishedAt, a.createdAt, au.authorId, au.fname, au.lname
			FROM articles a
			JOIN articlestatus s ON s.statusId = a.statusId
			JOIN categories c ON c.categoryId = a.categoryId
            JOIN authors au ON au.authorId = a.authorId
            WHERE
				case
					when inTopStory = 1 then a.topstory = '1'
					when inTopStory = 0 then a.topstory = '0'
					else 1 = 1
				end
                AND (inCategoryId is null or c.categoryId = inCategoryId)
                AND (inArticleId is null or a.articleId <> inArticleId)
                AND (inAuthorId is null or a.authorId = inAuthorId)
                AND (inStatusId is null or a.statusId = inStatusId)
            ORDER BY
				a.publishedAt DESC, a.articleId
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- article detail
        WHEN 4 THEN
			SELECT a.articleId, a.title, a.subtitle, a.topstory, a.tags, a.img, a.content, c.categoryId, c.title category, s.statusId, 
				s.status, a.publishedAt, a.createdAt, au.authorId, au.fname
			FROM articles a
			JOIN articlestatus s ON s.statusId = a.statusId
			JOIN categories c ON c.categoryId = a.categoryId
            JOIN authors au ON au.authorId = a.authorId
            WHERE
				a.articleId = inArticleId
                AND (inAuthorId is null or a.authorId = inAuthorId)
                AND (inStatusId is null or a.statusId = inStatusId)
			LIMIT 1;
			LEAVE PROC;
            
		-- update article
        WHEN 5 THEN
            SET inTitle = ValidString(inTitle);
            SET inSubTitle = ValidString(inSubTitle);
            SET inImg = ValidString(inImg);
            SET inTitle = ValidString(inTitle);
            
            SELECT img INTO dImg FROM articles WHERE articleId = inArticleId AND authorId = inAuthorId;
            
			UPDATE articles
			SET 
				title = inTitle,
				subtitle = inSubTitle,
				tags = inTags,
				content = inContent,
				statusId = inStatusId,
				topstory = CAST(inTopStory AS CHAR),
				categoryId = inCategoryId,
				img = IF(inImg = '' OR inImg IS NULL, img, inImg),
				publishedAt = inPublishedAt
				-- active = CAST(inPublished AS CHAR)
			WHERE
				articleId = inArticleId
				AND authorId = inAuthorId;
				-- AND active = '0';
                
            SELECT ROW_COUNT() updated, dImg oldImg;
			LEAVE PROC; 
            
		-- approve
        WHEN 6 THEN -- select CAST(inTopStory AS CHAR), inArticleId; leave proc;
			UPDATE articles SET 
				topstory = CAST(inTopStory AS CHAR), 
                statusId = inStatusId
            WHERE 
				articleId = inArticleId;
                -- and statusId = 2;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
        
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `AUTHORS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `AUTHORS`(
	IN inAction INT, 
	IN inAuthorId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255), 
	IN inCode INT,
    IN inTypeId INT,
	IN inRoleId INT,
	IN inAdminId INT,
    IN inPassExpire DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dPhone,dEmail,dFname VARCHAR(255) DEFAULT NULL;
	DECLARE dCode,dAuthorId INT DEFAULT NULL;
    -- DECLARE dTime DATETIME DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;     

	CASE inAction
		-- login
        WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
			SELECT authorId, email, phone, fname, active, pass
			FROM authors
			WHERE
				(email = inEmail
				OR phone = inPhone)
                AND verified = 1
			LIMIT 1; 
			LEAVE PROC;
            
		-- register
        WHEN 2 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
			SET inFname = ValidString(inFname);
			SET inLname = ValidString(inLname);
			SET inPass = ValidString(inPass);
            
			INSERT INTO authors(email,phone,fname,lname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inLname,inPass,inCode);      
            
            SELECT ROW_COUNT() created, LAST_INSERT_ID() authorId;
			LEAVE PROC;
            
		-- update author forgotten password
        WHEN 3 THEN
            SET inEmail = ValidString(inEmail);
            SELECT fname INTO inFname FROM authors WHERE email = inEmail;

			UPDATE authors SET passreset = 1, vCode = inCode
            WHERE
				email = inEmail;
			SELECT ROW_COUNT() updated, inFname fname;
			LEAVE PROC;
            
		-- update authors password
        WHEN 4 THEN
            -- SET inCode = ValidString(inCode);      
			UPDATE authors SET passreset = null, vcode = null, pass = inPass
            WHERE
				userId = inUserId
                AND passreset = 1
                AND vcode = inCode;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
		-- authors
        WHEN 5 THEN
			SELECT authorId, email, phone, fname, lname, active, verified, created
            FROM authors
            ORDER BY created DESC
            LIMIT inStart, inLimit;
			LEAVE PROC;
            
		-- verify author
        WHEN 6 THEN
			UPDATE authors SET active = 1, verified = 1 
            WHERE 
				vCode = inCode
                AND phone = inPhone
                AND email = inEmail;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;

		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CUSTOMER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CUSTOMER`(
	IN inAction INT,
	IN inCustomerId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255),
	IN inCode VARCHAR(255),
	IN inUserId INT,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dCustomerId INT DEFAULT NULL;  
    DECLARE dPhone,dEmail VARCHAR(255) DEFAULT NULL;

	CASE inAction
		-- create customer		
		WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
            SELECT customerId INTO dCustomerId FROM customers WHERE phone = inPhone or email = inEmail;
            
			IF NOT ISNULL(dCustomerId) THEN
				SELECT email INTO dEmail FROM customers WHERE email = inEmail;
				SELECT phone INTO dPhone FROM customers WHERE phone = inPhone;
				SELECT 'The customer already exists' message, dPhone phone, dEmail email, 0 created, dCustomerId customerId;
				LEAVE PROC;
            END IF;

            SET inFname = ValidString(inFname);
            SET inPass = ValidString(inPass);

			INSERT INTO customers(email,phone,fname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inPass,inCode);
            
			SELECT LAST_INSERT_ID() customerId, ROW_COUNT() updated;
                
            LEAVE PROC;
            
		-- login
        WHEN 2 THEN
			SELECT customerId, email, phone, fname, pass 
            FROM 
				customers
			WHERE
				(email = ValidString(inEmail)
                OR phone = ValidString(inPhone))
                AND verified = 1
			LIMIT 1;
			LEAVE PROC;
            
		-- new letters
        WHEN 3 THEN
			SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
            /*INSERT INTO newsletters(email,phone) 
            VALUE(inEmail,inPhone)
            ON DUPLICATE KEY UPDATE
				email = VALUES(email),
				phone = VALUES(phone),
				id = id + 0;*/
                
			IF EXISTS (
				SELECT 1 FROM newsletters WHERE email = inEmail OR phone = inPhone
			) THEN
				SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'Duplicate email or phone number';
			ELSE
				INSERT INTO newsletters(email, phone) VALUES (inEmail, inPhone);
                SELECT LAST_INSERT_ID() id, ROW_COUNT() created;
			END IF;
			LEAVE PROC;
            
		-- plans
		WHEN 4 THEN
			SELECT planId,plan,unit,preferred,price FROM plans; 
			LEAVE PROC;
            
		-- customers
        WHEN 5 THEN
			SELECT customerId, email, phone, fname, lname, verified, passreset, created
			FROM customers
            ORDER BY created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- subscriptions
        WHEN 6 THEN
			SELECT s.id, s.periodStart, s.periodEnd, s.created, p.planId, p.plan, p.price, c.customerId, c.fname, c.lname, ss.statusId, ss.status
			FROM subscriptions s
			JOIN plans p ON p.planId = s.planId
			JOIN customers c ON c.customerId = s.customerId
			JOIN subscriptionstatus ss ON ss.statusId = s.statusId
			ORDER BY s.created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- news letters
        WHEN 7 THEN
			SELECT newletterId, email, phone, active, created
			FROM newsletters
            ORDER BY created DESC
            LIMIT inStart,inLimit;
			LEAVE PROC;
            
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `PAYMENT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `PAYMENT`(
	IN inAction INT,
	IN inPaymentId INT,
	IN inPlanId INT, 
	IN inSubId INT, 
	IN inCustomerId INT,
	IN inUserId INT,
	IN inPhone BIGINT,
	IN inAmount DOUBLE,
	IN inFname VARCHAR(250),
	IN inMname VARCHAR(250),
	IN inLname VARCHAR(250),
	IN inPass VARCHAR(250),
	IN inReference VARCHAR(100),
	IN inMerchantReqId VARCHAR(100),
	IN inCheckoutReqId VARCHAR(100),
	IN inModeId INT,
	IN inStatusId INT,
	IN inPosted TINYINT,
	IN inDescrp VARCHAR(1000),
	IN inThirdpartyDate DATETIME,
	IN inStartDate DATETIME,
	IN inEndDate DATETIME,
	IN inStart INT, 
	IN inLimit INT
)
PROC: BEGIN   

	/*DECLARE dPhone,dEmail,inPhone VARCHAR(255) DEFAULT NULL;
    
	DECLARE dPCode,dUserId,dSaccoId INT DEFAULT NULL;
    DECLARE dECode VARCHAR(255) DEFAULT NULL; 
    DECLARE dTime DATETIME DEFAULT NULL; */
    
    DECLARE dCustomerId, dSubId INT DEFAULT NULL;
    DECLARE dDays, dExists, dAmount INT DEFAULT 0;
    DECLARE dPlan VARCHAR(255) DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;
    
	CASE inAction            
		-- new payment
        WHEN 1 THEN
			SET inFname = ValidString(inFname);
            SET inMname = ValidString(inMname);
            SET inLname = ValidString(inLname);
            SET inReference = ValidString(inReference);
            SET inPass = ValidString(inPass);
            
            -- check if phone number doent exists, create the customer
            if inCustomerId is null then
				select customerId into dCustomerId from customers where phone = inPhone;
                if dCustomerId is null then 
					insert into customers(phone,pass,passreset)
                    value(inPhone,inPass,1);
                    set dCustomerId = last_insert_id(), dExists = 0;
				else
					set dExists = 1;
                end if;
            end if;

            -- create a new subscription from the plan
            select duration, price, plan into dDays, dAmount, dPlan from plans where planId = inPlanId;
            
			START TRANSACTION;
				-- new subscription
				insert into subscriptions(customerId,statusId,planId,periodStart,periodEnd)
				value(dCustomerId,1,inPlanId,now(),DATE_ADD(NOW(),INTERVAL dDays DAY));
				set dSubId = last_insert_id();

				-- create payment
				insert into payments(modeId,statusId,customerId,subscriptionId,amount,phone)
				value(inModeId,inStatusId,dCustomerId,dSubId,dAmount,inPhone);
				set inPaymentId = last_insert_id();
			
			IF dRollBack THEN
				ROLLBACK;
				SELECT 'roll back' message, 0 created;
			ELSE 
				COMMIT;	
				SELECT 1 created, inPaymentId paymentId, dExists cExists, dPlan plan, dAmount amount;
			END IF;
            LEAVE PROC;                
			
        -- update from request callback
        WHEN 2 THEN
            SET inMerchantReqId = ValidString(inMerchantReqId);
            SET inCheckoutReqId = ValidString(inCheckoutReqId);
            SET inDescrp = ValidString(inDescrp);
			
            UPDATE payments SET MerchantRequestID = inMerchantReqId, CheckoutRequestID = inCheckoutReqId, ResponseDescription = inDescrp, statusId = inStatusId
            WHERE
				paymentId = inPaymentId;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
		
        -- update from request callback
        WHEN 3 THEN
			SET inReference = ValidString(inReference);
            SET inMerchantReqId = ValidString(inMerchantReqId);
            SET inCheckoutReqId = ValidString(inCheckoutReqId);
            SET inDescrp = ValidString(inDescrp);
            
            UPDATE payments SET 
				reference = inReference, ResponseDescription = inDescrp, -- statusId = inStatusId, posted = '1', 
                posteddate = NOW(), thirdpartyTime = inThirdpartyDate
            WHERE
				MerchantRequestID = inMerchantReqId
                AND CheckoutRequestID = inCheckoutReqId
                AND ResponseDescription != inDescrp;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
        -- update from registered callback
        WHEN 4 THEN
			SET inReference = ValidString(inReference);
			UPDATE payments SET
				fname = inFname, reference = inReference, -- mname = inMname, lname = inLname,
				statusId = inStatusId, posted = '1', posteddate = NOW(), thirdpartyTime = inThirdpartyDate
			WHERE 
				paymentId = inPaymentId
				-- AND phone = inPhone
				AND statusId = 2
				AND posted = '0';
			LEAVE PROC;
            
		-- list of payment per group
        WHEN 5 THEN
			SET inReference = ValidString(inReference);

			SELECT p.paymentId, p.fname payee, c.fname, c.lname, c.customerId, c.fname, c.lname, s.statusId, s.status, p.amount, pm.modeId, pm.mode, p.phone, p.reference, p.created
			FROM payments p
			JOIN paymentstatus s ON s.statusId = p.statusId
            JOIN paymentmode pm ON pm.modeId = p.modeId
            JOIN customers c ON c.customerId = p.customerId
			WHERE
				if(inpaymentId, p.paymentId = inpaymentId,1)
                AND if(inAmount, p.amount = inAmount,1)
				AND if(inStatusId, p.statusId = inStatusId,1)
				AND if(inModeId, p.modeId = inModeId,1)
                AND if(inStartDate, p.created >= inStartDate,1)
                AND if(inEndDate, p.created <= inEndDate,1) 
                AND if(inReference, p.reference = inReference,1)
			ORDER BY p.created DESC
			LIMIT inStart,inLimit;
			LEAVE PROC;
            
		-- payment status
		WHEN 6 THEN
			SELECT s.statusId, s.status, p.amount
			FROM payments p
			JOIN paymentstatus s on s.statusId = p.statusId
			WHERE
				p.paymentId = inPaymentId;
			LEAVE PROC;
            
		ELSE 
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `USERS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `USERS`(
	IN inAction INT, 
	IN inUserId INT, 
	IN inEmail VARCHAR(100),
	IN inPhone VARCHAR(100),
	IN inFname VARCHAR(100),
    IN inLname VARCHAR(255),
    IN inActiveId TINYINT,
    IN inResetPass TINYINT, 
	IN inPass VARCHAR(255), 
	IN inCode INT,
    IN inTypeId INT,
	IN inRoleId INT,
	IN inAdminId INT,
    IN inPassExpire DATETIME,
    IN inStartDate DATETIME,
    IN inEndDate DATETIME,
    IN inStart INT, 
    IN inLimit INT 
)
PROC: BEGIN

	DECLARE dPhone,dEmail,dFname VARCHAR(255) DEFAULT NULL;
	DECLARE dCode,dUserId INT DEFAULT NULL;
    -- DECLARE dTime DATETIME DEFAULT NULL;
    
    DECLARE dRollBack BOOL DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET dRollBack = 1;     

	CASE inAction
		-- login
        WHEN 1 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
            
			SELECT userId, email, phone, fname, active, pass
			FROM users
			WHERE
				(email = inEmail
				OR phone = inPhone)
                AND active = 1
			LIMIT 1;
			LEAVE PROC;
            
		-- register
        WHEN 2 THEN
            SET inEmail = ValidString(inEmail);
            SET inPhone = ValidString(inPhone);
			SET inFname = ValidString(inFname);
			SET inLname = ValidString(inLname);
			SET inPass = ValidString(inPass);
            
			INSERT INTO users(email,phone,fname,lname,pass,vCode)
			VALUE(inEmail,inPhone,inFname,inLname,inPass,inCode);      
            
            SELECT ROW_COUNT() created, LAST_INSERT_ID() userId;
			LEAVE PROC;
            
		-- update customer forgotten password
        WHEN 3 THEN
            SET inEmail = ValidString(inEmail);
            
            SELECT fname INTO inFname FROM users WHERE email = inEmail;
            
			UPDATE users SET passreset = 1, vCode = inCode
            WHERE
				email = inEmail;
			SELECT ROW_COUNT() updated, inFname fname;
			LEAVE PROC;

		-- update user password
        WHEN 4 THEN
            SET inEmail = ValidString(inEmail);
			UPDATE users SET passreset = null, vCode = null, pass = inPass
            WHERE
				-- userId = inUserId
                email = inEmail
                AND passreset = 1
                AND vCode = inCode;
			SELECT ROW_COUNT() updated;
			LEAVE PROC;
            
		-- list of roles and permissions
		WHEN 5 THEN
			SELECT r.roleId, r.title, p.permissionId, p.permission, g.groupId, g.icon, r.created --  g.title gtitle,
			FROM permissions p
			JOIN permsgroup g ON g.groupId = p.groupId
			JOIN rolepermission rp ON rp.permissionId = p.permissionId
			JOIN roles r on r.roleId = rp.roleId;
			LEAVE PROC;
            
		-- list of users
        WHEN 6 THEN
			SELECT userId, email, phone, fname, lname, active, created
			FROM users
            ORDER BY created DESC
			LIMIT inStart,inLimit;            
			LEAVE PROC;
            
		ELSE
			SELECT 'Out of actions' denoted; 
            LEAVE PROC; 
        
	END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-04 15:31:04
