# Blog Project

This project was developed as a part of a university course on PHP. It is a blog application that allows the author to create, delete, and edit blog posts. The main goal of this project was to implement a functional blog platform with user authentication and database management.

## Features

- User registration and login system
- User roles: administrator, blog author, and regular user
- Admin panel for managing blog posts and users
- Creation, deletion, and editing of blog posts
- Optional image upload for each blog post
- Commenting system on blog posts
- Contact section to get in touch with the blog author

## Technologies Used

The project incorporates the following technologies:

- PHP: Server-side scripting language
- MySQL: Relational database management system
- HTML/CSS: Front-end web technologies for the user interface
- JavaScript: Used for dynamic elements like adding comments
- Docker Compose: Containerization tool for easy deployment
- Bootstrap: CSS framework for responsive and visually appealing design

## Implementation Details

The project was implemented using the following key components:

- **User Authentication**: The application includes a secure user authentication system. It uses the Argon2 algorithm to hash passwords and stores unique salts for each user in the database.
- **Database Management**: Blog posts, comments, and user information are stored in a MySQL database. The database is accessed using PHP's PDO (PHP Data Objects) extension, providing a secure and efficient way to interact with the database.
- **Role-Based Access Control**: Different user roles are implemented to control access and privileges. Administrators have full control over the blog, including adding, deleting, and editing posts, as well as managing users and logs. Blog authors can create, delete, and edit their own blog posts. Regular users can add comments to blog posts.
- **Image Storage**: Images uploaded with blog posts are stored as files. The file paths are stored in the database, allowing easy retrieval and display of the images.
- **Front-end Interface**: The user interface is built using HTML, CSS, and Bootstrap. JavaScript is used to enhance the interactivity, such as adding comments without page refresh.
- **Admin Panel**: The admin panel provides a user-friendly interface for managing blog posts, users, and logs. Administrators can perform administrative tasks efficiently through the panel.

## How to Run

To run the project, follow these steps:

1. Clone the repository to your local machine.
2. Install Docker and Docker Compose on your system. (Docker Compose is automatically installed with the Docker Desktop application)
3. Navigate to the project directory.
4. Open a terminal or command prompt in the project directory.
5. Run the following command to start the project:

   ```
   docker-compose up
   ```

   This command will build and start the project using Docker Compose. It will automatically set up the required containers and services along with MySQL database running in the container.

6. Once the project is up and running, you can access it by opening a web browser and entering the following address:

   ```
   http://localhost/pages
   ```

   The blog application will be available on this URL.

## Deployment

For demonstration purposes, the project has also been deployed on AWS for the short period of time. Currently, the website is not available online.

## Screenshots

![Main Page](https://github.com/AntoniKania/php-project/assets/87483058/6963c4cb-a0af-42db-b1da-41fbdf5cd25f)

![Admin Panel](https://github.com/AntoniKania/php-project/assets/87483058/aad99fdc-8b72-4872-adb6-9acab73e1209)
