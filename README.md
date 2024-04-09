# 🎟️ TicketWise 🎟️

TicketWise is a ticket booking system application built with Python, Flask, and Vue.js.

## Overview

TicketWise allows users to book tickets for various events. Administrators can manage events, set ticket prices, and specify the maximum number of attendees. Users can view event details and reserve tickets. Email notifications are sent to users upon successful reservation.

## Setup

### Prerequisites

- Python 3.x
- Node.js
- MySQL

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/TicketWise.git
   
2. Install Python dependencies
    ```bash
    pip install -r requirements.txt

3. Install Vue.js dependencies:
    ```bash
    cd frontend
    npm install
    
4. Set up the MySQL database:
    - Create a new database for TicketWise.
    - Update the database configuration in config.py.
      
### Running the Application

1. Start the Flask backend:
    ```bash
    python app.py

2. Start the Vue.js frontend (in a separate terminal window):
    ```bash
    cd frontend
    npm run serve

3. Open your browser and navigate to http://localhost:8080 to access TicketWise.

## Contribution Guidelines

Contributions to TicketWise are welcome! Here are some guidelines to follow:
 - Fork the repository and create a new branch for your feature or bug fix.
 - Make sure your code follows the project's coding style and conventions.
 - Write clear and concise commit messages.
 - Submit a pull request detailing the changes you've made.

## License
This project is licensed under the MIT License.
