#drop and create new tables
CREATE SCHEMA `dms-project` ;
use `dms-project`;
DROP TABLE IF EXISTS Customers, Rentals, Payment, Store, Vehicle;
CREATE TABLE Customers (
  Customer_ID INT NOT NULL AUTO_INCREMENT,
  First_Name varchar(1000),
  Last_Name VARCHAR(1000),
  Street varchar(1000),
  Street_Num int(10),
  City varchar(1000),
  Province varchar(1000),
  Country varchar(1000),
  Postal_Code VARCHAR(6),
  Email varchar(1000),
  Cell_Num VARCHAR(20),
  Drivers_License_Num VARCHAR(1000),
  PRIMARY KEY (Customer_ID)
  );
  
  CREATE TABLE Store(
  Store_ID int NOT NULL AUTO_INCREMENT,
  Street varchar(1000),
  Street_Num int(10),
  City varchar(1000),
  Province varchar(1000),
  Country varchar(1000),
  Postal_Code VARCHAR(6),
  Phone_Num VARCHAR(20),
  PRIMARY KEY (Store_ID)
  );

CREATE TABLE Vehicle (
  Vehicle_ID int NOT NULL AUTO_INCREMENT,
  Make VARCHAR(1000),
  Model varchar(1000),
  Yr int(4),
  Color varchar(1000),
  Mileage int(10),
  vehicle_condition VARCHAR(10000),
  Seat_Num INT,
  Price DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (Vehicle_ID)
  );
  
create table Rentals (
  Reservation_ID int  NOT NULL AUTO_INCREMENT,
  Price DECIMAL(8,2) NOT NULL,
  Pick_Up date,
  Drop_Off date,
  Pick_Up_Location int NOT NULL,
  Drop_Off_Location int,
  Pick_Up_Time TIME,
  Drop_Off_Time TIME,
  Customer_ID int NOT NULL,
  Vehicle_ID int  NOT NULL,
  PRIMARY KEY (Reservation_ID),
  FOREIGN KEY (Customer_ID) REFERENCES Customers(Customer_ID),
  FOREIGN KEY (Pick_Up_Location) REFERENCES Store(Store_ID),
  FOREIGN KEY (Drop_Off_Location) REFERENCES Store(Store_ID),
  FOREIGN KEY (Vehicle_ID) REFERENCES Vehicle(Vehicle_ID),
  KEY `price` (Price)
  );
  CREATE TABLE Payment (
   Card_Num VARCHAR(16) NOT NULL,
   Card_Type VARCHAR(1000),
   Card_Expiry DATE,
   Security_code INT(3),
   Customer_ID INT NOT NULL,
   Price DECIMAL(8,2) NOT NULL,
   PRIMARY KEY (Card_Num),
   FOREIGN KEY (Customer_ID) REFERENCES Customers(Customer_ID),
   FOREIGN KEY (Price) REFERENCES Rentals(Price)
   );
   
   #populate tables with example data
   INSERT INTO Customers(First_Name,last_name,street,street_num,city,province,country,postal_code,email,cell_num,drivers_license_num) 
   VALUES ('Susan','Nasus','Sand Street',2,'Whitby','ON','Canada','L1G0B7','sanus12@gmail.com','(416) 939-1234',' A2364-76385-934524'),
			('Joel','Embiid','Simcoe Street',21,'Oshawa','ON','Canada','L0B1G5','jembiid@yahoo.ca','(416) 939-4716','A5273-92573-737896'),
			('Travis','Scott','4th Street',4,'New York City','NY','USA','100001','sickomode@gmail.com','(212) 301-3758','478-126-683'),
            ('Marvins','Room','October Street',6,'Fresno','CA','USA','93650','myroom@gmail.com','(559) 472-4582','I14284670'),
            ('Emma','Whatson','Main Street',57,'Vancouver','BC','Canada','V5R1N1','em@yahoo.ca','(778) 318-2699','8526395'),
            ('George','Clueney','Charles Street',83,'Jersey City','NJ','USA','07030','gclueney@gmail.com','(908) 946-0083','T45953337106821');
   INSERT INTO Store(street,street_num,city,province,country,postal_code,phone_num) 
   VALUES ('Simcoe St',2000,'Oshawa','ON','Canada','L1G0C5','(289) 872-6342'),
		  ('George St',547,'Whitby','ON','Canada','L1P8R5','(647) 209-3843'),
          ('Bidwell St',435,'Vancouver','BC','Canada','V6G1S5','(416) 823-9843'),
          ('Vernon St',8137,'New York','NY','USA','10002','(289) 764-3821'),
          ('Brickell St',952,'Fresno','CA','USA','93727','(647) 755-5677'),
          ('Chestnut Ave',125,'Oaklyn','NJ','USA','08107','(647) 234-1234');
   INSERT INTO Vehicle(make,model,yr,color,mileage,vehicle_condition,seat_num,price) 
   VALUES('Audi','RS7',2021,'Black',5000,'Like New',5,300),
		 ('BMW','X5M',2019,'Silver',12000,'Used',5,300),
         ('Mercedes Maybach','S580',2021,'Grey',8000,'Like New',5,350),
         ('Rolls Royce','Ghost',2020,'White',5000,'Like New',5,500),
         ('Porsche','Taycan Turbo',2021,'Red',4000,'Like New',5,350),
         ('Lamborghini','Aventador SVJ',2022,'Black',2000,'Like New',2,500);
         
   INSERT INTO Rentals(price,pick_up,drop_off,pick_up_location,drop_off_location,Pick_Up_Time,Drop_Off_Time,Customer_ID,Vehicle_ID) 
   VALUES (350,'2021-10-25','2021-10-25',2,2,'09:00:00','17:00:00',1,5),
		  (700,'2021-10-31','2021-11-01',5,5,'11:00:00','15:00:00',4,2),
		  (1400,'2021-10-31','2021-11-04',2,1,'17:00:00','09:00:00',2,6),
		  (350,'2021-11-03','2021-11-4',4,4,'10:00:00','10:00:00',3,3),
		  (700,'2021-11-04','2021-11-06',3,3,'20:00:00','17:00:00',1,4),
		  (700,'2021-10-27','2021-10-29',6,6,'16:30:00','21:00:00',6,1);
   INSERT INTO Rentals(price,pick_up,pick_up_location,Pick_Up_Time,Customer_ID,Vehicle_ID)
   VALUES (700,'2021-10-27',6,'16:30:00',6,1);
   
   INSERT INTO Payment(Card_Num,Card_Type,Card_Expiry,Security_code,Customer_ID,Price) 
   VALUES ('8476836500938561','Visa','2024-05-12',401,1,350),
		  ('7462943718535482','Visa','2023-11-10',773,2,1400),
		  ('0192127452935124','Mastercard','2024-06-02',251,3,350),
          ('6681923851103857','Visa','2022-03-30',599,4,700),
          ('4320483719284651','Mastercard','2023-01-11',629,1,700),
          ('1922837561034752','Mastercard','2022-10-23',091,6,700);
          
   #view data populated into tables
   SELECT * FROM Customers;
   SELECT * FROM Store;
   SELECT * FROM Vehicle;
   SELECT * FROM Rentals;
   SELECT * FROM Payment;