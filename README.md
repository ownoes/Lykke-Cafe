# Project Setup Guide

## Requirements
Before running this project, ensure you have the following installed:
- **XAMPP** (to run Apache and MySQL)
- **An IDE with Live Server Support** (e.g., VS Code with the Live Server extension)

## Setup Instructions

1. **Install XAMPP** if you haven't already.
2. **Move the Project to the `htdocs` Folder**:
   - Locate your XAMPP installation directory (e.g., `C:\xampp\`).
   - Place the project folder inside the `htdocs` directory (`C:\xampp\htdocs\your-project-folder`).
3. **Import the SQL Database**:
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin/`).
   - Create a new database (e.g., `lykke_kafe`).
   - Import the attached `.sql` file into this database.
4. **Start XAMPP Services**:
   - Open XAMPP and **start** both the **Apache** and **MySQL** modules.
5. **Run the Web Application**:
   - Open your browser and go to:
     ```
     http://localhost/your-project-folder/Welcome.html
     ```
   - To access the admin panel, go to:
     ```
     http://localhost/your-project-folder/admin.php
     ```

Your application should now be running! 🚀
