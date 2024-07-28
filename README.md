# Boosters

## Overview
Imagine you have the task from UN about world gold mining. You store data about all countries (country name and planned gold mining), companies (country, email) and all gold mining (by company, when it occurred and mined gold weight). You need an interface to manage countries data and companies and view a report. Last week you’ve been at the frontend development conference and heard that JSON REST API is the industry standard nowadays and you decided to create your own tool for your task using this approach.

## Requirements
There are four screens in the application:
1. Country management
2. Company management
3. View all countries that mining more than planned weight
4. From all companies that exceed planned mining weight view companies that mined more than others from the same company (Leaders).

Application interface consists of 3 tabs or pages: Countries, Companies, Leaders. It would be nice to see a single-page application here, but it’s not a requirement. Note, that also we’ve got some ideas on the look & feel of the application and components you could use (see below), we are flexible about the frontend implementation. You will not be judged based on the appearance of the interface.

## Installation

1. Create Laravel project
```bash
composer create-project --prefer-dist laravel/laravel boosters
```

2. Navigate to the project directory
```bash
cd boosters
```

3. Clone the repository
```bash
git init
git remote add origin https://github.com/BelomorUA/boosters.git
git add .
git commit -m "tmp commit"
git reset --hard
git fetch origin
git merge -X theirs origin/master --allow-unrelated-histories
```

4. Install the dependencies
```bash
composer install
npm install
```

5. Copy .env.example to .env and configure your environment variables

```bash
cp .env.example .env
```

6. Generate the application key

```bash
php artisan key:generate
```

7. Run the database migrations
```bash
php artisan migrate
```

8. Seed the database with test data
```bash
php artisan db:seed
```

9. Build the front-end assets
```bash
npm run dev
```

10. Serve the application
```bash
php artisan serve
```

11. Open the project in your browser
Navigate to http://127.0.0.1:8000

11. Open the Leaders page and generate temporary data(press once "Generate Data" button)
http://127.0.0.1:8000/leaders

## Usage

### Home Page

The home page of the application provides a comprehensive overview of the gold mining statistics. It includes the following sections:

1. **Number of Countries**: Displays the total number of countries available in the system.

2. **Number of Companies in Each Country**: Lists each country with the corresponding number of companies operating within that country.

3. **Total Mined Gold in Each Country**: Shows the total amount of gold mined in each country, aggregated from all companies in that country.

4. **Monthly Report**: Presents a detailed table that indicates which countries met their gold mining plan for each month of the year 2024. The table includes:
    - Year-Month
    - Country Name
    - Total Mined Gold (kg)
    - Planned Gold Mining (kg)
    - Status (Achieved or Not Achieved)

5. **Gold Mining Over Time**: A line chart visualizing the total gold mined over time. This chart aggregates data by year and month, providing a clear view of the mining trends.

### Countries

Manage the list of countries and their planned gold mining.

1. Navigate to the "Countries" tab.
2. View the list of countries with their planned gold mining amounts.
3. To add a new country, click the "Add" button, fill in the country name and planned gold mining amount, and submit the form.
4. To edit an existing country, click the "Edit" button next to the country, update the information, and submit the form.
5. To delete a country, click the "Delete" button next to the country.

### Companies

Manage the list of companies and their details.

1. Navigate to the "Companies" tab.
2. View the list of companies with their emails and associated countries.
3. To add a new company, click the "Add" button, fill in the company name, email, and select the country from the dropdown, then submit the form.
4. To edit an existing company, click the "Edit" button next to the company, update the information, and submit the form.
5. To delete a company, click the "Delete" button next to the company.

### Leaders

View the report of countries that exceeded their planned gold mining and the top companies.

1. Navigate to the "Leaders" tab.
2. Select a month from the dropdown menu to view the report for that specific month.
3. Click the "Show report" button to display the countries that exceeded their planned gold mining amounts for the selected month.
4. Click the "Generate data" button to generate random mining data for the last 6 months based on predefined rules.
5. View the list of companies that mined more than others from the same country, sorted by the amount of total mining weight from max to min.
