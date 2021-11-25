#View 1: Computes a join of at least three tables
	#full name and phone numbers of customers who rented a Mercedes Maybach S580 in the month of November
	DROP VIEW IF EXISTS view1;
	CREATE VIEW view1 as
    SELECT customers.first_name, customers.last_name,customers.cell_num
	from rentals
    join vehicle 
    on rentals.Vehicle_ID=vehicle.Vehicle_ID
    join customers
    on rentals.customer_id=customers.customer_id
	where Make='Mercedes Maybach' AND model='S580' AND pick_up>='2021-11-01' AND drop_off<='2021-11-30';
    SELECT * FROM view1;
#View 2: Uses nested queries with the ANY or ALL operator and uses a GROUP BY clause
	# lists the make, model and mileage for vehicles that have a mileage below 10000, grouped by make
    DROP VIEW IF EXISTS view2;
	CREATE VIEW view2 as
    SELECT make,model,mileage from vehicle 
    where mileage = ANY(SELECT mileage from vehicle where mileage<10000) 
    GROUP BY make;
    SELECT * FROM view2;
#View 3: A correlated nested query
	#Find all the "like new" vehicles with lower than average mileage
    DROP VIEW IF EXISTS view3;
	CREATE VIEW view3 as
	SELECT * FROM vehicle as v
    WHERE mileage<(SELECT AVG(mileage) FROM vehicle where v.vehicle_condition='Like New');
    SELECT * FROM view3;
#View 4: Uses a FULL JOIN
		# Lists all the Customer Full names and their payments
		DROP VIEW IF EXISTS view4;
        CREATE VIEW view4 as
        SELECT First_name,last_name,price
		FROM customers FULL
		JOIN Payment
        ON FULL.Customer_ID=Payment.Customer_ID;
        #show view4
		SELECT * from view4;
#View 5: Uses nested queries with any of the set operations UNION, EXCEPT, or INTERSECT
		#get all vehicles who are newer than 2019 or have a mileage lower than 5000
        DROP VIEW IF EXISTS view5;
        CREATE VIEW view5 AS
        SELECT * FROM Vehicle
        WHERE mileage < ANY(SELECT mileage
			   FROM vehicle 
               WHERE mileage <= 5000)
	   UNION
	   SELECT * FROM Vehicle
        WHERE yr > ANY(SELECT yr 
               FROM vehicle 
               WHERE yr=2019);
        SELECT * FROM view5;
        
#view6:Get list of all unavailable vehicles:
		DROP VIEW IF EXISTS view6;
        CREATE VIEW view6 AS
        SELECT Make,Model FROM vehicle
        JOIN rentals
        ON vehicle.vehicle_id=rentals.vehicle_id
        WHERE drop_off is null;
        SELECT * FROM view6;
        
#view7: total revenues
		DROP VIEW IF EXISTS view7;
        CREATE VIEW view7 AS
        SELECT SUM(Price) FROM Rentals;
        SELECT * FROM view7;

#view8: get the names of the customers who live in New York City
		DROP VIEW IF EXISTS view8;
        CREATE VIEW view8 AS
        SELECT first_name,last_name,city from Customers
        where city='New York City';
        SELECT * FROM view8;
        
#view9: Get the Reservation numbers for the customer with the first name ‘Travis’, last name ‘Scott’ and phone number ‘(212) 301-3758’ 
		DROP VIEW IF EXISTS view9;
        CREATE VIEW view9 AS
        SELECT Reservation_ID FROM Rentals
        JOIN Customers
        ON Rentals.Customer_ID=Customers.Customer_ID
        WHERE first_name='Travis' AND last_name='Scott' and cell_num='(212) 301-3758';
        
        SELECT * FROM view9;
        
#view10:
		DROP VIEW IF EXISTS view10;
        CREATE VIEW view10 AS
        SELECT SUM(Price) FROM Rentals
        JOIN Customers
        ON Rentals.customer_id=customers.customer_id
        WHERE first_name='Joel' AND last_name='Embiid';
        SELECT * FROM view10;
#view11: below average costing vehicles
	DROP VIEW IF EXISTS belowAvgPrice;
	CREATE VIEW belowAvgPrice AS
	SELECT Make, Model, Price 
    FROM vehicle WHERE price<= (SELECT AVG(price) FROM vehicle);
    SELECT * FROM belowAvgPrice;