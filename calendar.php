<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            width: calc(100% / 7);
            height: 75px; /* height stuff can be changed  */
        }

        th {
            background-color: #e74c3c;
        }

        .month-year {
            text-align: center;
            margin-bottom: 10px;
        }

        button {
            cursor: pointer;
        }
        
        h1 {
            color: #e74c3c; /* change the color of the h1 element */
        }

        /* Dropdown button */
        .dropdown {
            position: relative;
            display: inline-block;
            float: right; /*dont understand the squigiles*/
            margin-top: -50px;
        }

        /* Dropdown (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /*fancy schmancy stuff from stackoverflow
        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #f1f1f1;}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {display: block;}

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {background-color: #e74c3c;}
    </style>
</head>
<body>
    <h1>Leap</h1>

    <!-- Dropdown menu for settings -->
    <div class="dropdown">
        <button class="dropbtn">Settings</button>
        <div class="dropdown-content">
            <a href="#">Profile</a>
            <!--<a href="#">Logout</a>-->
            <a href="#" onclick="close_window();return false;">Logout</a>
        </div>
    </div>

    <div class="month-year">
        <button onclick="prevMonth()">Previous</button>
        <span id="currentMonthYear"></span>
        <button onclick="nextMonth()">Next</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody id="calendarBody">
            <!-- Calendar content will be dynamically generated here -->
        </tbody>
    </table>

    <?php
        //function will take number for month
        //  return stuff
    ?>

    <script>
        // Initial values for the current month and year
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        let selectedCell; // To store the clicked cell
    
        // Function to update the calendar based on the current month and year
        function updateCalendar() {
            const calendarBody = document.getElementById('calendarBody');
            const currentMonthYear = document.getElementById('currentMonthYear');
    
            // Clear the previous content
            calendarBody.innerHTML = '';
    
            // Set the current month and year
            currentMonthYear.textContent = `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;
            
            // Update the URL based on current month and year
            calendarURL = `calendar.html?month=${currentMonth + 1}&year=${currentYear}`;
            console.log(calendarURL);

            //  stuff
            window.history.pushState({}, '', calendarURL);
            calendarURL = '';
    
            // Get the first day of the month and the total number of days in the month
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();
    
            // Create the calendar rows
            let row = calendarBody.insertRow();
            for (let i = 0; i < firstDay; i++) {
                row.insertCell();
            }
    
            for (let day = 1; day <= lastDay; day++) {
                const cell = row.insertCell();
                cell.textContent = day;
    
                // Add click event listener to each cell
                cell.addEventListener('click', function() {
                    // Store the clicked cell
                    selectedCell = cell;
                    // Open a pop-up window with text entry boxes
                    const popupWindow = window.open('', '_blank', 'width=400,height=200');
                    popupWindow.document.write(`
                        <h2>Enter Details for ${currentYear}-${currentMonth + 1}-${day}</h2>
                        <form id="popupForm" action="addEvent.php" method ="post">
                            <label for="title">Title:</label><br>
                            <input type="text" id="title" name="title"><br>
                            <label for="location">Location:</label><br>
                            <input type="text" id="location" name="location"><br>
                            <label for="notes">Notes:</label><br>
                            <textarea id="notes" name="notes"></textarea><br><br>
                            <input type="submit" value="Submit">
                        </form>
                    `);
    
                    // Add event listener to form submission
                    popupWindow.document.getElementById('popupForm').addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent default form submission
                        // Get the entered values
                        const title = popupWindow.document.getElementById('title').value;
                        const location = popupWindow.document.getElementById('location').value;
                        const notes = popupWindow.document.getElementById('notes').value;
                        // Update the content of the clicked cell
                        selectedCell.innerHTML = `${day}<br>${title}<br>${location}<br>${notes}`;
                        // Close the popup window
                        popupWindow.close();
                    });
                });
    
                if (row.cells.length === 7) {
                    row = calendarBody.insertRow();
                }
            }
        }
    
        // Function to go to the previous month
        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            updateCalendar();
        }
    
        // Function to go to the next month
        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendar();
        }
    
        // Initial calendar setup
        updateCalendar();
    </script>
    
</body>
</html>
