CREATE TABLE Customers(
CustomerID VARCHAR(14) NOT NULL PRIMARY KEY,
FirstName VARCHAR(30),
MiddleName VARCHAR(10),
LastName VARCHAR(30),
Birthdate DATE

);

CREATE TABLE CustomerAddresses(
CustomerID VARCHAR(14) NOT NULL PRIMARY KEY,
FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
StreetAddress VARCHAR(30),
City VARCHAR(30),
HomeState VARCHAR(30),
Country VARCHAR(30),
ZipCode VARCHAR(12)
);

CREATE TABLE CustomerAccounts(
CustomerID VARCHAR(14) NOT NULL PRIMARY KEY,
FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
Email VARCHAR(50),
UserName VARCHAR(20),
Password VARCHAR(8)
);

CREATE TABLE Products (
ItemID INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
Code VARCHAR(20) NOT NULL,
Name VARCHAR(30),
Image text NOT NULL,
Price FLOAT
);


CREATE TABLE Orders(
CustomerID VARCHAR(14) NOT NULL,
FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
OrderID VARCHAR(14) NOT NULL PRIMARY KEY,
OrderStatus VARCHAR(14),
OrderDate DATE
);

CREATE TABLE ProductOrders(
OrderID VARCHAR(14) NOT NULL,
FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
Code VARCHAR(20) NOT NULL,
ItemID  INT(12),
Quanity INT
);



INSERT INTO Products (Code, Name, Image, Price) VALUES
('FLS','Flamingo Shirt', 'img/products/flamingoShirt.jpg', 35.99),
('GJ','Geisha Jacket', 'img/products/skullgeishaJacket.jpg', 79.99),
('GH', 'Geisha Hoodie', 'img/products/geishaHoodie.jpg', 49.99),
('AH', 'Adidas Hoodie', 'img/products/adidasHoodie.jpg', 59.99),
('AMT', 'All Might T-Shirt', 'img/products/allMightShirt.jpg', 99.99),
('CH', 'Champion Hoodie', 'img/products/championHoodie.jpg', 45.99),
('CS', 'Champion Shirt', 'img/products/championShirt.jpg', 89.99),
('NH', 'Nike Hoodie', 'img/products/nikeHoodie.jpg', 49.99);
