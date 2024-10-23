import bluetooth
import sys
import json
from datetime import datetime

# Get the articles array passed from the Laravel controller
articles_json = sys.argv[1]
articles = json.loads(articles_json)

table_number = articles[0]["table"]

# Array of printer MAC addresses
printer_macs = ["60:6E:41:62:DE:1F"]  # Modify as needed "60:6E:41:62:DE:20", 

# Get current date
current_date = datetime.now().strftime("%d/%m/%Y %H:%M:%S")

# Function to print articles to a Bluetooth printer
def print_to_printer(printer_mac, articles):
    port = 1  # Typically used for Bluetooth SPP (Serial Port Profile)

    try:
        sock = bluetooth.BluetoothSocket(bluetooth.RFCOMM)
        sock.connect((printer_mac, port))
        print(f"Connected to {printer_mac}")

        # Print date
        sock.send(f"Datum: {current_date}\n")
        sock.send("\n")
        sock.send("--------------------------------")
        sock.send("\n")
        message = f"Narudzba za sto broj: {table_number}"
        sock.send(message.encode('utf-8'))  # Ensure the message is encoded to bytes
        sock.send("\n")

        # Print article details
        for article in articles:
            sock.send(f"{article['title']}\n")
            sock.send(f"Kolicina: {article['quantity']}x    Cijena: {article['price']}KM\n")

        # Print the total amount
        total_price = sum(item['quantity'] * item['price'] for item in articles)
        sock.send("\n")
        sock.send("--------------------------------")
        sock.send("\n")
        sock.send(f"Total: {total_price:.2f}KM\n")

        # Paper cut buffer
        sock.send("\n\n\n")

        # Close the socket
        sock.close()
        print(f"Message sent successfully to {printer_mac}!")

    except bluetooth.BluetoothError as e:
        print(f"Bluetooth error: {e}")
    except Exception as e:
        print(f"An error occurred: {e}")

# Print to all printers in the array
for printer_mac in printer_macs:
    print_to_printer(printer_mac, articles)
