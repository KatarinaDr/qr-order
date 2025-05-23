#!/usr/bin/env python3
import subprocess
import tempfile
import sys
import json

# Get the order data from command line arguments
order_data = sys.argv[1]  # The first argument is the order data

# Initialize an empty string for the text to print
text_to_print = ""

# Optionally parse JSON if needed
try:
    orders = json.loads(order_data)
    
    # Extract information for printing
    if orders:
        # Print the first number of the table
        table_number = orders[0]['table']
        text_to_print += f"Narudzba za sto: {table_number}\n"
        text_to_print += "-" * 41 + "\n"  # Continuous line of dashes
        
        # Iterate over each order item
        for order in orders:
            title = order['title']
            quantity = order['quantity']
            text_to_print += f"{title}\nKolicina: {quantity}\n"  # Separate lines for title and quantity

        text_to_print += "-" * 41 + "\n\n"  # Continuous line of dashes after printing all items



except json.JSONDecodeError:
    text_to_print = "Invalid order data."

# Add line feeds for skipping lines and cut command
text_to_print += "\n\n\n"  # Skip 3 lines
text_to_print += "\x1D\x56\x00"  # Command to cut the paper (specific to printer command)

# Create a temporary file
with tempfile.NamedTemporaryFile(delete=False) as temp_file:
    temp_file.write(text_to_print.encode('utf-8'))
    temp_file_path = temp_file.name

# Specify your printer name
printer_name = 'EPSON_TM-T88VII'  # Updated printer name

# Print the temporary file
subprocess.run(['lp', '-d', printer_name, temp_file_path])

# Optionally, delete the temporary file after printing
import os
os.remove(temp_file_path)

