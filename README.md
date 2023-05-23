# FEUP TROUBLE TICKETS - Project LTW06G03

This is the repository for Project LTW06G03, developed by:
- José Martins (UP202108794)
- Francisco Cardoso (UP202108793)

## Project Overview: Feup Trouble Ticket (FTT)

FTT (Feup Trouble Ticket) is an innovative website developed by two students from FEUP (Faculty of Engineering, University of Porto) to streamline the process of problem-solving for students. The primary goal of FTT is to provide a user-friendly platform that eliminates the need for students to physically visit the university and allows them to create support tickets for prompt assistance from designated staff members.

### Features and Technologies

FTT incorporates the following features and technologies:

- Web Application: FTT is a web-based application that utilizes a combination of front-end and back-end technologies to deliver its functionalities.

- User Roles and Functionality:
  - Students: Students can create support tickets by providing a concise title and clear description of their problem. They can associate their tickets with the relevant department to ensure efficient routing. The system automatically corrects any misclassifications and assigns the ticket to the appropriate staff member. Students can expect timely responses and updates throughout the support process.
  - Staff Members: Designated staff members are assigned to assist students with their tickets. They communicate with the students, work towards resolving their problems, and provide updates on the progress. Once a problem is successfully resolved, staff members mark the ticket as closed.

- Ticket Management: FTT offers a comprehensive ticket management system that allows students and staff members to track and monitor the status of their tickets. This includes features such as ticket assignment, updates, and closure.

- Department Routing: FTT includes a department categorization system that ensures tickets are routed to the appropriate staff members based on the nature of the problem. This streamlines the problem-solving process and ensures efficient allocation of resources.

- Real-time Communication: FTT facilitates real-time communication between students and staff members through integrated messaging or notification systems. This enables effective collaboration and ensures prompt assistance.

- Technologies Used: The project utilizes a range of web technologies, including HTML, CSS, JavaScript, and PHP, along with a backend database powered by SQLite. The website ensures secure data storage and incorporates measures to prevent security vulnerabilities such as SQL injection and XSS attacks.

The objective of the FTT project is to deliver an efficient and user-friendly trouble ticket system for students, ensuring their prompt problem resolution and enhancing their overall experience.


## Installation and Setup

To run the project locally, follow these steps:

1. Clone the repository:
   ```
   git clone git@github.com:FEUP-LTW-2023/project-ltw06g03.git
   ```

2. Change to the project directory:
   ```
   cd project-ltw06g03
   ```

3. Switch to the appropriate branch:
   ```
   git checkout final-delivery-v2
   ```

4. Set up the database:
   ```
   sqlite3 database/database.db < database/database.sql
   sqlite3 database/database.db < database/popular.sql
   ```

5. Start the PHP development server:
   ```
   php -S localhost:9000
   ```

## Usage

Once the project is set up and the PHP development server is running, you can access the application by opening your web browser and navigating to http://localhost:9000 .

