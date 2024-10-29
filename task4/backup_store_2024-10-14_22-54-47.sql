CREATE TABLE Customer (
        customer_id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(20)
    );


CREATE TABLE `CustomerOrder` (
        order_id INTEGER PRIMARY KEY AUTOINCREMENT,
        customer_id INTEGER NOT NULL,
        order_date DATE NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL,
        FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON DELETE CASCADE
    );


CREATE TABLE Product (
        product_id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        stock_quantity INTEGER NOT NULL
    );


CREATE TABLE Order_Product (
        order_id INTEGER NOT NULL,
        product_id INTEGER NOT NULL,
        quantity INTEGER NOT NULL,
        PRIMARY KEY (order_id, product_id),
        FOREIGN KEY (order_id) REFERENCES CustomerOrder(order_id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES Product(product_id) ON DELETE CASCADE
    );


