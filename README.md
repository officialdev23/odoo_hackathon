# AssetFlow Pro - Enterprise Asset Management System

AssetFlow Pro is a clean, modern, and high-performance IT and physical asset tracking solution designed for corporate environments. It features a curated warm-sand and earth-tone design theme (#fefae0 and #d4a373) and a responsive, card-based interface styled using Bootstrap 5, vanilla CSS3 variables, Chart.js, and GSAP animations.

---

## Default Credentials

Use these credentials to log in as the system administrator:

* **Email:** `admin@assetflow.com`
* **Password:** `admin123`

---

## Core Features

1. **Dashboard Home:**
   * High-contrast card-based widgets displaying total asset counts, employees, allocations, and pending maintenance reports.
   * Executive summaries and graphical indicators of company allocations.

2. **Asset Directory:**
   * Track asset codes, names, categories, departments, vendors, serial numbers, and purchase dates.
   * Edit and view modals for inline data updates and details fetching without reloading.
   * Image upload support for asset identification.

3. **Employee Directory:**
   * Dynamic lists of active/inactive staff, designated roles, and department associations.
   * Seamless inline edit/view modals.

4. **Asset Allocation (Check-Out/Check-In):**
   * Link assets to employees with custom allocation dates and optional expected return dates.
   * Strict datetime format safeguards (null conversion fallback) to prevent database exceptions on modern strict-mode MySQL instances.
   * Real-time status synchronization (setting assets to Allocated or Available automatically).

5. **Organization Setup:**
   * Manage corporate departments (IT, HR, Sales, Accounts).
   * Define asset categories (Laptops, Desktops, Monitors, Printers).

6. **Executive Reports & Analysis (Hybrid):**
   * Responsive visual reports powered by Chart.js displaying smooth curved line graphs (tension: 0.4) and colorful pie charts styled with a custom earth palette.
   * Entrance animations powered by GSAP.
   * Printer-friendly layouts supporting standalone direct links (/pages/reports.php) and print-to-PDF styles.

---

## Technology Stack

* **Backend:** PHP (Object-Oriented Programming, MVC structure, PDO Secure Queries)
* **Frontend:** Bootstrap 5, FontAwesome 6, Google Fonts (Poppins), Vanilla CSS3 variables
* **Charts & Animation:** Chart.js (v4), GSAP (v3)
* **Database:** MySQL (Structured tables with foreign keys)

---

## Project Architecture

```
AssetFlow/
├── assets/
│   ├── css/
│   │   └── main.css      # Core Design System, colors, variables, and animations
│   ├── js/
│   │   └── app.js        # Ajax modal handlers and event listeners
│   └── uploads/          # User-uploaded asset images
├── config/
│   └── config.php        # Database connection and BASE_URL constants
├── controllers/          # Business logic handlers (Assets, Allocation, Employee)
├── layouts/              # Reusable UI headers, footers, sidebars, and navbars
├── models/               # Database query models (PDO query executions)
├── pages/                # Dynamic module templates loaded inside the dashboard
├── dashboard.php         # Main application panel shell
├── login.php             # Secure authentication view
└── signup.php            # Employee registration view
```

---

## Setup & Installation

1. **Prerequisites:**
   * Install WampServer, XAMPP, or an equivalent PHP/MySQL local server environment.
   * Ensure PHP version is 7.4 or higher.

2. **Deployment:**
   * Move/copy the `AssetFlow` directory into your server's root folder (e.g., `C:\wamp\www\` or `htdocs`).
   * Import the database SQL dump file into your local phpMyAdmin or MySQL Server (create a database named `assetflow`).

3. **Configuration:**
   * Edit `config/config.php` and configure your database host, database name, username, and password:
     ```php
     define("DB_HOST", "localhost");
     define("DB_NAME", "assetflow");
     define("DB_USER", "root");
     define("DB_PASS", "");
     define("BASE_URL", "http://localhost:8080/odoo_hackathon/AssetFlow/");
     ```

4. **Access the System:**
   * Open your browser and navigate to: `http://localhost/odoo_hackathon/AssetFlow/` (or your configured local server address).
