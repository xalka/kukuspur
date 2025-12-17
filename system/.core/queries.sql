/*
Author    :	Joshua Musyoka
Title     :	Evet system backend queries
Date      :	07 July 2025 [ saba saba ]
Company   : Techxal
Database  :	evet
Client    :	E-vet
*/

use evet;

-- Customers list
SELECT c.customerId, c.uniqueId, c.email, c.phone, c.fname, c.lname, c.active, c.verified, c.vCode, ct.typeId, ct.type ctype, v.viewId, v.type ptype
FROM customer c
JOIN customertype ct on ct.typeId = c.customertypeId
JOIN customertype v on v.typeId = ct.viewId;



-- delete customer
START TRANSACTION;

SET @customerId = 21;

-- Delete cart items for the customer's cart(s)
DELETE ci
FROM cartitem ci
JOIN cart c ON ci.cartId = c.cartId
WHERE c.customerId = @customerId;

-- Delete the customer's cart(s)
DELETE FROM cart WHERE customerId = @customerId;

-- Delete from orderitem where the product belongs to the customer AND the order also belongs to the same customer
DELETE oi
FROM orderitem oi
JOIN product p ON oi.productId = p.productId
JOIN shoppingorder o ON oi.orderId = o.orderId
WHERE p.customerId = @customerId AND o.customerId = @customerId;

DELETE FROM shoppingorder WHERE customerId = @customerId;

-- Delete related images for products owned by the customer
DELETE i
FROM images i
JOIN product p ON i.productId = p.productId
WHERE p.customerId = @customerId;

-- Delete products of the customer
DELETE FROM product WHERE customerId = @customerId;

-- Delete the customer
DELETE FROM customer WHERE customerId = @customerId;

COMMIT;




--------------------------------------------------------------


use evet;

set @inLongitude = 37.44243622;
set @inLatitude = -1.18026015;

SELECT p.productId, p.product, i.img, MIN(i.imageId) imageId, p.descrp, c.categoryId, c.category, p.sku, p.isActive,
		p.price, p.discount, p.closingStock stock, p.created,
		-- Calculate distance in meters using ST_Distance_Sphere()
		ST_Distance_Sphere(
			POINT(a.longitude, a.latitude),        -- Product owner's location
			POINT(@inLongitude, @inLatitude) -- Customer's location
		) distance_meters
FROM product p
JOIN images i ON i.productId = p.productId
JOIN category c ON c.categoryId = p.categoryId
-- JOIN customer cp ON cp.customerId = p.customerId
JOIN addresses a ON a.customerId = p.customerId
WHERE
	p.viewId = 1 -- inVeiwId
	-- AND (inCategoryId IS NULL OR c.categoryId = inCategoryId)
	-- AND (inCustomerId IS NULL OR p.customerId = inCustomerId)
	AND p.closingStock > 0
GROUP BY
	p.productId, p.product, p.descrp, c.categoryId, c.category,
	p.sku, p.isActive, p.price, p.discount, p.closingStock, p.created, distance_meters
ORDER BY 
	distance_meters ASC,
	p.created DESC;
-- LIMIT inStart, inLimit;