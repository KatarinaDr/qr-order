<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Random Restaurant</title>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- Custom Styles -->
        <style>
            body {
                background-color: #2c2c2c; /* Dark grey background */
                /*background-image: url('path-to-your-background-image.jpg'); /* Optional: Add a background image */
                background-size: cover;
                background-attachment: fixed;
                color: #ffffff;
                font-family: 'Arial', sans-serif;
                padding-left: 30px;
                padding-right: 30px;
                margin: 0;

            }
            
            /* Style for buttons */
            .category-list {
                display: flex;
                flex-direction: column; /* Arrange buttons vertically */
                width: 100%; /* Ensure the list takes the full width of the page */
                padding: 0;
                margin: 0;
            }



            /* Container for the category buttons */
            .category-container {
                display: flex;
                overflow-x: auto; /* Allows horizontal scrolling */
                white-space: nowrap;
                padding: 10px 0;
                scrollbar-width: none; /* Hides scrollbar for Firefox */
                -ms-overflow-style: none; /* Hides scrollbar for Internet Explorer and Edge */
            }

            .category-container::-webkit-scrollbar {
                display: none; /* Hides scrollbar for Chrome, Safari, and Opera */
            }

            /* Styling for the category buttons */
            .category-button {
                background-color: #cc6600; /* Very dark orange */
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 14px;
                cursor: pointer;
                margin-right: 10px; /* Space between buttons */
                white-space: nowrap;
                transition: background-color 0.3s ease;
                flex-shrink: 0; /* Prevent buttons from shrinking */
            }

            .category-button:last-child {
                margin-right: 0; /* Removes the margin after the last button */
            }

            .category-button:hover {
                background-color: #ff8c00; /* Lighter orange on hover */
            }

            /* Style for tables*/
            .custom-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                background-color: #1c1c1c; /* Black background */
                color: #ffffff;
                font-family: Arial, sans-serif;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
                border-radius: 10px;
                overflow: hidden;
            }

            .custom-table th, .custom-table td {
                border-bottom: 2px solid #333333;
                padding: 12px 15px;
                text-align: left;
            }

            .custom-table th {
                background-color: #333333; /* Dark grey for headers */
                color: #FFA726; /* Orange text for headers */
            }

            .custom-table tbody tr {
                transition: background-color 0.3s ease;
            }

            .custom-table tbody tr:nth-child(even) {
                background-color: #222222; /* Slightly lighter black for alternate rows */
            }

            .custom-table tbody tr:hover {
                background-color: #333333; /* Dark grey on hover */
            }

            .custom-table tbody tr:last-child td {
                border-bottom: none;
            }

            .custom-table td:first-child, .custom-table th:first-child {
                border-left: none;
            }

            .custom-table td:last-child, .custom-table th:last-child {
                border-right: none;
            }
        
            
            /* Special group button style (+/-) */
            .special-group-list {
                display: flex;
                flex-direction: column;
                align-items: center; /* Center the buttons horizontally */
                width: 100%;
                padding: 0;
                margin: 20px 0; /* Add some spacing around this group */
            }

            .special-group-btn {
                background-color: #1c1c1c; /* Black background */
                color: #ffffff;
                border: 2px solid #333333;
                padding: 15px 20px;
                margin: 10px 0;
                text-align: center;
                font-size: 18px;
                width: 50%; /* Adjust the width to be narrower */
                max-width: 400px; /* Optionally set a maximum width */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .special-group-btn:hover, .special-group-btn.active {
                background-color: #333333;
                transform: scale(1.02);
                cursor: pointer;
            }

 
            /* Article card css style */
            .article-card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px; /* Space between cards */
                padding: 20px;
            }

            .article-card {
                background-color: #1c1c1c; /* Dark background for the card body */
                color: #ffffff;
                border: 2px solid #333333;
                border-radius: 8px; /* Rounded corners */
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.6); /* Shadow for a fancy effect */
                width: 100%; /* Full width on small screens */
                max-width: 300px; /* Limit max width for larger screens */
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                overflow: hidden;
            }

            .article-card-header {
                background-color: #333333; /* Different color for the card header */
                padding: 10px 15px;
                font-size: 18px;
                font-weight: bold;
                color: #ff8c00; /* Dark orange color for header text */
                text-align: center;
                border-bottom: 2px solid #ff8c00; /* Optional border to separate header */
            }

            .article-card-body {
                padding: 15px;
                font-size: 14px;
                line-height: 1.6;
                text-align: left;
                color: #cccccc; /* Lighter color for body text */
            }

            .article-card-footer {
                display: flex;
                justify-content: center; /* Center the button horizontally */
                align-items: center;
                padding: 10px 15px;
                border-top: 1px solid #444444; /* Border separating the footer */
            }

            .article-card-footer .card-button {
                background-color: #cc6600; /* Very dark orange button */
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 16px; /* Slightly larger font size */
                cursor: pointer;
                width: 80%; /* Occupies 80% of the footer's width */
                text-align: center;
                transition: background-color 0.3s ease;
            }

            .article-card-footer .card-button:hover {
                background-color: #ff8c00; /* Lighter orange on hover */
            }

            /* Make order and cancel buttons */
            .screen-buttons-container {
                display: flex;
                justify-content: space-between;
                padding: 20px; /* Space between the buttons and the edges of the screen */
            }

            .screen-button {
                color: #ffffff;
                border: none;
                padding: 10px 15px; /* Small size */
                border-radius: 5px;
                font-size: 14px; /* Smaller font size */
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .right-button {
                background-color: #cc6600; /* Very dark orange for left button */
            }

            .right-button:hover {
                background-color: #ff8c00; /* Lighter orange on hover */
            }

            .left-button {
                background-color: #ff0000; /* Red for the right button */
            }

            .left-button:hover {
                background-color: #e60000; /* Darker red on hover */
            }



    </style>
    @livewireStyles
</head>
<body>
    <center><h1>Welcome to the Random Restaurant</h1></center>
    
    <h3>Hello, Customer!</h3>

    <h3>Choose menu by category:</h3>

    @livewire('category-articles')

    <h1> </h1>
    <h1> </h1>
    <h1> </h1>
    <h1> </h1>
    <h1> </h1>
    <h1> </h1>
    <h1> </h1>
    <center><h1> Thank you for visiting us!</h1></center>
    <h1> </h1>
    <h1> </h1>
    
        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        @livewireScripts

        <!-- Initialize Swiper -->
        <script>
                Livewire.on('orderPlaced', message => {
                    Swal.fire({
                        title: 'Success!',
                        text: message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
                
                Livewire.on('orderEmpty', message => {
                    Swal.fire({
                        title: 'Empty!',
                        text: message,
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                });

                Livewire.on('cancelOrderPopup', () => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to cancel the order?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch('cancelOrder'); // Calls the Livewire method to cancel the order
                            Swal.fire(
                                'Canceled!',
                                'Your order has been canceled.',
                                'success'
                            );
                        }
                    });
                });

              var swiper = new Swiper('.category-swiper', {
                slidesPerView: 3, // Show up to 3 slides at a time
                spaceBetween: 10, // Space between slides
                freeMode: true, // Allows slides to move freely without snapping to slides
                grabCursor: true, // Changes the cursor to a grabbing hand on hover
                breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                }
            });
        </script>
</body>
</html>
