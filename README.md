🏥 Medicare- Hospital Management System

A comprehensive, role-based healthcare management system built with PHP and MySQL that streamlines medical operations and improves patient care through specialized dashboards for patients, doctors, and administrators.

🌟 Features
👥 Role-Based Access Control
Patients: Book appointments, view medical history, select doctors, manage profiles
Doctors: Manage appointments, update patient records, create prescriptions, track schedules
Administrators: Full system control, user management, analytics, and reporting
💻 Technical Features
Secure authentication system with password hashing
Responsive design with clean, professional UI
Appointment management with status tracking
Medical history and prescription records
Comprehensive admin dashboard with statistics
Database initialization with sample data
🛠️ Technology Stack
Frontend: HTML5, CSS3, JavaScript
Backend: PHP
Database: MySQL (with PDO)
Styling: Custom CSS with Font Awesome icons
Server: XAMPP compatible
📁 Project Structure
medicare-system ├── config.php # Database configuration and session management
├── index.php # Login page with authentication
├── register.php # User registration system
├── dashboard.php # Role-based routing
├── patient.php # Patient dashboard
├── doctor.php # Doctor dashboard
├── admin.php # Administrator dashboard
├── about.php # About us page
├── contact.php # Contact information
├── init_db.php # Database initialization
├── logout.php # Session termination
├── header.php # Consistent header
├── footer.php # Consistent footer
├── style.css # Comprehensive styling
└── README.md # This file

🚀 Installation & Setup
Prerequisites
XAMPP/WAMP/MAMP server installed
Web browser with JavaScript enabled
Installation Steps
Clone or download the project files
Place the project folder in your server's root directory (e.g., htdocs for XAMPP)
Start Apache and MySQL services in your XAMPP Control Panel
Open your browser and navigate to "http://localhost/phpmyadmin"
Create a new database named "medicare_db"
Navigate to "http://localhost/your-project-folder/init_db.php" to initialize the database with sample data
Access the application at "http://localhost/your-project-folder/index.php"
Default Login Credentials
After initialization, use these credentials to login:

Patient:

Email: patient@example.com
Password: password
Role: Patient
Doctor:

Email: doctor@example.com
Password: password
Role: Doctor
Administrator:

Email: admin@example.com
Password: password
Role: Admin
📊 Database Schema
The system uses three main tables:

users: Stores patient, doctor, and admin information
appointments: Manages appointment scheduling and status
medical_history: Tracks patient diagnoses and prescriptions
🎯 Usage Guide
For Patients:
Register or login with patient credentials
Book appointments with available doctors
View medical history and appointment status
Update personal profile information
For Doctors:
Login with doctor credentials
View and manage appointment schedule
Update appointment statuses
Create prescriptions for patients
Maintain profile information
For Administrators:
Login with admin credentials
Manage all users (add, edit, delete)
Oversee all appointments
View system analytics and reports
Configure system settings
🔒 Security Features
Password hashing using PHP's password_hash()
Session-based authentication
Role-based access control
SQL injection prevention with PDO prepared statements
Input validation on forms
🎨 Customization
The system can be customized by:

Modifying the color scheme in style.css (CSS variables)
Adding new fields to database tables
Extending functionality in respective role-based files
Customizing the UI in HTML/PHP files
📈 Future Enhancements
Potential improvements for the system:

Email integration for appointment reminders
Payment gateway integration
Advanced reporting and analytics
Mobile-responsive improvements
Real-time chat functionality
Electronic health records (EHR) integration
🆘 Support
For support or questions about this healthcare management system, please create an issue in the repository or contact the development team.

Acknowledgments
Font Awesome for icons
PHP and MySQL communities for documentation
XAMPP for local server environment
Medicare: For Healthy Life - Revolutionizing healthcare management through technology and compassionate care.
