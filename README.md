# Social Media Page


# Project Overview:
This project aims to create a fully functional social media page where users can google login, sign up, log in, create posts, like and comment on posts to receiving notifications, and follow other users.

# Features
- User Authentication: Google login, Sign up, log in, and log out and Forgot Password functionalities.
- User Profiles: View and edit user profiles.
- Posts: Create, delete, view and archive posts.
- Likes: Like and unlike posts.
- Comments: Add comments on posts and comment replay.
- Follow System: Follow and unfollow other users.

# Technologies Used
- Frontend:
 HTML,
 Blade Templates,
 bootstrap css,
 Jquery
- Backend:
Laravel
- Database:
 MySQL
- Authentication:
 CSRF(Tokens)
- Others:
 Laravel Eloquent ORM for database interactions

#  Prerequisites
Before you begin, ensure you have the following installed on your system:
- PHP 8.2.12
- Composer 2.7.2
- Laravel 11

# Installation
- Clone the repository:
```bash
git clone https://github.com/abhishekdholariya/socialfeedpage.git
cd socialmediapage
```

- Install dependencies:
```bash
composer install
```

- Set up environment variables:
Update the following variables in the .env file:
```bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
- Run migrations:
```bash
php artisan migrate
```

- Run the development server:
```bash
php artisan serve
``` 

# Usage
### 1. Register a new account or log in with an existing account.
### 2. Create new posts from your profile.
### 3. Like and comment on posts.

# Core Functionalities
### 1. Add/Remove Friend
Users can add or remove friends within the social media platform. This functionality enhances social interaction and network building.
### 2. Like/Unlike Post
Users have the ability to like or unlike posts shared by other users. This feature encourages engagement and interaction among users.
### 3. View Notifications
Users receive notifications when other users like their posts. This feature keeps users informed about interactions and engagements on their content.
### 4. Archive/Unarchive Own Post
Users can archive or unarchive their own posts, allowing them to organize and manage their content.
### 5. Add/Delete Post
Users can create new posts or delete posts as needed, giving them control over their published content.
### 6. View All User Posts
Users can view posts from all users on the platform, fostering community engagement and interaction.
### 7. Edit Profile
Users can edit their profile information, including profile picture, bio, and other details, allowing them to customize their online presence.
### 8. Logout
Users can log out of their accounts securely, ending their current session on the platform.
### 9. View Total Posts
Users can see the total number of posts they've published on the platform, providing insights into their activity.
### 10. View Total Archives
Users can view the total number of archived posts, helping them manage and organize their content effectively.
### 11. View Total Friends List
Users can see the total number of friends they have on the platform, giving them an overview of their social connections.
### 12. Received Welcome Mail
Newly registered users receive a welcome email, providing them with information and guidance on using the platform.
### 13. Send Comments
Users can leave comments on posts shared by other users, facilitating discussions and interactions.
### 14. Reply to Comments
Users can reply to comments on posts, enabling threaded conversations and deeper engagement.
### 15. Forgot Password
Users can reset their password if they forget it by providing their email address. A reset password link will be sent to their email.

# Contributing
Contributions are welcome! Feel free to open issues and pull requests to suggest improvements or report bugs.

