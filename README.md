# Traffic Data App

A secure PHP + MySQL web application to explore Toronto’s traffic volume and classification data. The app includes authentication, data display, filtering, and CRUD operations on `raw_class` data.

---

## Features

-  **User Authentication** (Login, Logout, Register)
- **Data Display**
  - Join view of `raw_volume` + `raw_class`
  - Filter by minimum volume
  - Responsive and accessible tables
- **Admin Tools**
  - Add new traffic classification data (`raw_class`)
  - Update existing data
  - Delete data entries
-  **Navigation Dashboard**
  - Bootstrap-powered cards
  - Visual color-coded links for clarity

---

## Folder Structure


traffic-app/
├── add.php # Add raw_class entry 
├── update.php # Update raw_class entry 
├── delete.php # Delete raw_class entry
├── display_join.php # View joined traffic data
├── display_raw_class.php # View only raw_class table
├── display_raw_volume.php # View only raw_volume table
├── index.php # Dashboard navigation 
├── login.php # Login page + logic
├── logout.php # Logout and destroy session
├── register.php # User registration
├── connection.php # MySQL DB connection
├── functions.php # Shared functions: auth, DB connect
├── css/
│ └── style.css 
└── sql/
└── create_users_table.sql # SQL to create users table


You should also import the raw_class and raw_volume tables from the Toronto Open Data portal (2020–2024 datasets).



Default Authentication
•	Users must be registered to access the dashboard and data features.
•	Sessions are used to protect routes.

Technologies Used
•	PHP 8+
•	MySQL / phpMyAdmin
•	Bootstrap 5
•	HTML5 / CSS3
•	Session-based Authentication

