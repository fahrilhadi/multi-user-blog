# Multi User Blog App

An **intermediate-level blog application** built with **Laravel 12**, **Laravel Breeze**, and **TailwindCSS**. This project goes beyond basic authentication by implementing a **multi-user system** with role-based access (user & admin), a full **CRUD post management**, **post status (publish, pending & rejected)**, and an **admin dashboard**.

## Screenshots

**Index Page (Empty State — No Posts Yet)**

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/28cc836a-c66c-46fe-b2b5-7d986e244bfd" /><br>

**Index Page (With Posts)**

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/3fe67091-e489-4a83-a2a2-6794f949d9e2" /><br>

**Post Detail (Read More)**

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/d3377772-6922-436c-ad1b-bf220f7d5db3" /><br>

**Login Page**

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/578a23d3-edfc-47f5-af33-866b0a86244c" /><br>

**Register Page**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/b2763bde-3a73-461c-8091-eec9b60b5497" /><br>

**Admin Dashboard Page (Empty State — No Posts Yet)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/723a724e-ba4e-456b-97da-96d710a03a35" /><br> 

**Admin Dashboard Page (With Posts)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/5dadbdd9-3994-4b08-8d03-60754ba9b2a5" /><br> 

**Admin View Post (Approve or Reject)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/771801f6-0504-40e8-a499-8f7b4c76a3cf" /><br>

**Admin View Approved Posts**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/2a89a6cf-13ba-4a0f-9046-d47de1069a87" /><br> 

**Admin Delete Rejected Posts**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/a87b68ae-37fa-40b8-a939-a7497a443431" /><br> 

**User Dashboard Page (Empty State — No Posts Yet)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/8aced740-992f-48cf-b77f-bd7ea743d54c" /><br> 

**User Dashboard Page (With Posts)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/67f73a03-954e-4bf7-ad26-f3193c374a3c" /><br> 

**User Create Post**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/9c085e0d-0d7c-4d72-b6db-ab9ceaee70ea" /><br> 

**User Edit Post**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/df9ccad5-de55-44d9-84ab-d25dc74a5e85" /><br> 

**User View Post (After Approval)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/a8e7ed8c-07ae-47de-9ec9-79899a3ff535" /><br> 

**User Delete Post**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/cc07f669-e390-4c7b-95d6-c8a62993a044" /><br> 

## Tech Stack

- **Backend:** Laravel 12  
- **Frontend:** Blade Templates + TailwindCSS  
- **Database:** MySQL 
- **Version Control:** GitHub  

## Quick Start

```bash
# Clone repository
git clone https://github.com/fahrilhadi/multi-user-blog.git
cd multi-user-blog

# Install dependencies
composer install
npm install
npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Serve application
php artisan serve
