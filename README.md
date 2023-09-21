# ToucanTech Demo Project

## Prerequisites

Before running this project, please ensure you have the following prerequisites:

1. Web Server: This is due to how this project was solely ran on localhost.

2. Database Setup: Make sure you have a MySQL database named `toucantech_db` and then execute the SQL code located in `config/create_tables.sql` to create the necessary tables.

## Project Structure

The project is organized into models, views, and controllers for members and schools so here's a quick breakdown of the key tasks I completed in order of priority:

1. Database Setup and Configuration:
   - Created the database structure.
   - Configured the database connection in `config/database.php`.

2. Model-View-Controller (MVC) Architecture:
   - Established the MVC pattern for code organization.

3. Member Model and Controller:
   - Created the Member model (`app/Models/members_model.php`) and controller (`app/Controllers/members_controller.php`) for managing member data.

4. School Model and Controller:
   - Created the School model (`app/Models/schools_model.php`) and controller (`app/Controllers/schools_controller.php`) for managing school data.

5. Member and School Views:
   - Designed views for listing, adding, and updating members and schools.

6. Member-School Relationship:
   - Established a relationship between members and schools which allows members to be associated with multiple schools.

7. Adding Members and Schools:
   - Implemented functionality to add new members and schools to the database.

8. Listing Members and Schools:
   - Developed views and controllers to display lists of members and schools with their respective details.

9. Navigation and Linking:
    - Created navigation links and buttons for easy navigation.

10. Styling and UI Enhancements:
    - Applied CSS styles and Bootstrap classes to improve the user interface.

11. Error Handling and Debugging:
    - Implemented error handling and validation for user input and database operations and added logging and debugging statements for troubleshooting when attempting to fulfill CRUD principle (now removed).

12. Final Testing and Validation:
    - Performed thorough testing to ensure the application works correctly.

13. Final Review and Completion:
    - Reviewed and refined the project for completion.


## Final Thoughts

Before I committed the final files, I wanted to apply the CRUD principle to make this demo project more responsive by giving you guys the ease of updating and deleting the data directly from the UI through the use of modal windows and JavaScript and rather not from the backend but unfortunately, I ran into errors that took a lot more time to attempt to fix than I initially anticipated but I was able to complete the project and I am disappointed that I couldn't apply this principle as it is something that I am well capable of implementing but despite this, my project does fulfill all the objectives/requirements laid out to me and I look forward to hopefully explaining more about it in detail.

Thank You,
Ore Deru.
