import bluetooth
import sys
import json
from datetime import datetime

# Get the articles array passed from the Laravel controller
articles_json = sys.argv[1]
articles = json.loads(articles_json)

table_number = articles[0]["table"]

mac_address = articles[0]["printer"]

# Array of printer MAC addresses
printer_macs = [mac_address]  # Modify as needed "60:6E:41:62:DE:20", "60:6E:41:62:DE:1F"

# Get current date
current_date = datetime.now().strftime("%d/%m/%Y")
current_hour = datetime.now().strftime("%H:%M:%S")


def replace_special_chars(text):
    replacements = {
        'č': 'c', 'ć': 'c', 'đ': 'dj', 'š': 's', 'ž': 'z',
        'Č': 'C', 'Ć': 'C', 'Đ': 'Dj', 'Š': 'S', 'Ž': 'Z'
    }
    for original, replacement in replacements.items():
        text = text.replace(original, replacement)
    return text


# Function to print articles to a Bluetooth printer
def print_to_printer(printer_mac, articles):
    port = 1  # Typically used for Bluetooth SPP (Serial Port Profile)

    try:
        sock = bluetooth.BluetoothSocket(bluetooth.RFCOMM)
        sock.connect((printer_mac, port))
        print(f"Connected to {printer_mac}")

        BOLD_ON = b"\x1B\x45\x01"  # Turn on bold
        BOLD_OFF = b"\x1B\x45\x00"  # Turn off bold
        CENTER_ALIGN = b"\x1B\x61\x01"  # Center alignment
        LEFT_ALIGN = b"\x1B\x61\x00"  # Left alignment

        # Print date
        sock.send(BOLD_ON)
        sock.send(replace_special_chars("--------------------------------"))
        sock.send(BOLD_OFF)
        sock.send(CENTER_ALIGN)
        sock.send(replace_special_chars("GoldenOrder\n").encode('ascii'))
        sock.send(LEFT_ALIGN)
        sock.send(BOLD_ON)
        sock.send(replace_special_chars("--------------------------------"))
        sock.send(BOLD_OFF)
        sock.send(f"Datum: {current_date}\n")
        sock.send(f"Vrijeme: {current_hour}\n")
        sock.send(f"Sto broj: {table_number}\n")
        sock.send("--------------------------------")

        #sock.send(message.encode('utf-8'))  # Ensure the message is encoded to bytes

        # Print article details
        for article in articles:
            article_line = replace_special_chars(f"{article['quantity']} x {article['title']}\n")
            sock.send(article_line.encode('ascii'))

            extras = article.get("extras", [])
            for extra in extras:
                extra_line = replace_special_chars(f"  + {extra}\n")
                sock.send(extra_line.encode('ascii'))


        # Print the total amount
        total_price = sum(item['quantity'] * item['price'] for item in articles)
        sock.send("--------------------------------")
        sock.send("\n")
        sock.send(f"Ukupno:           {total_price:.2f}KM\n")
        sock.send("--------------------------------")
        sock.send(f"Ovo je narudzba,a ne fiskalni racun!\n")
        sock.send("\n\n")
        sock.send(f"Software by Alaska d.o.o.\n")
        sock.send(f"+387 63 240 216\n")

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
