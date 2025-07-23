<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pub Klek</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom Styles -->
    @livewireStyles
</head>
<style>
    body {
        background-image: url({{ asset('images/klek.jpg') }});
        background-size: cover;
        background-attachment: fixed;
        /*background: linear-gradient(to top, #7f1d1d, #1a202c);*/
        color: #ffffff;
        margin: 0;
        font-family: Grenze, serif;
        min-height: 100vh;
        overflow: hidden; /* Prevent body scrolling */
    }

    .main {
        display: flex;
        flex-direction: row;
        width: 100%;
        min-height: 100vh;
        position: relative;
    }


    .left {
        position: fixed;
        top: 0;
        left: -100%;
        width: 80%;
        max-width: 250px;
        height: 100vh;
        background-color: rgba(142, 22, 22, 0.95);
        padding: 10px 5px;
        overflow-y: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
        z-index: 100;
        transition: left 0.3s ease;
    }

    .left.open {
        left: 0;
    }

    .right {
        width: 100%;
        padding: 20px 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow-y: auto;
        height: 100vh;
        box-sizing: border-box;
    }

    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: black;
        height: 80px;
        width: 100%;
        box-sizing: border-box;
        flex-wrap: wrap;
    }

    .menu-toggle {
        background-color: #8E1616;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        margin-left: 10px;
    }

    .center-text {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        min-width: 200px;
    }

    .welcome-container {
        flex-grow: 1;
        display: flex;
        justify-content: center;
    }

    .welcome-text {
        color: white;
        margin: 0;
        text-align: center;
        font-size: 18px;
        white-space: nowrap;
    }

    .logout-button {
        background-color: #e3342f;
        color: white;
        border: none;
        padding: 8px 5px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        margin-right: 10px;
        white-space: nowrap;
    }

    .category-container {
        display: flex;
        flex-direction: column;
        gap: 7px;
        width: 100%;
        align-items: center;
        justify-content: center;
    }

    .category-container::-webkit-scrollbar {
        display: none;
    }

    .category-button {
        background-color: black;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 15px;
        font-size: 13px;
        cursor: pointer;
        width: 100%;
        text-align: center;
        transition: background-color 0.3s ease;
        white-space: normal;
        overflow-wrap: break-word;
        box-sizing: border-box;
    }

    .category-button:hover {
        background-color: white;
        color: black;
    }

    .article-card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 10px 0;
    }

    .article-card {
        background-color: white;
        color: black;
        border: 2px solid #333333;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        width: calc(50% - 15px);
        max-width: 140px;
        min-height: 350px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-sizing: border-box;
        overflow: hidden;
    }

    .article-card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
    }

    .article-card-header {
        background-color: #8E1616;
        padding: 10px;
        font-size: 12px;
        font-weight: bold;
        color: white;
        text-align: center;
        border-radius:  0;
        width: 100%;
        min-height: 80px; /* Adjusted for flexibility */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-wrap: break-word; /* Ensure title wraps */
        box-sizing: border-box;
    }

    .article-card-body {
        font-size: 12px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    .article-card-body img {
        width: 80%; /* Scale image relative to card */
        max-width: 100px;
        height: auto; /* Maintain aspect ratio */
        border-radius: 30px;
        margin-bottom: 10px;
    }

    .article-card-body input {
        border-radius: 40px;
        margin-bottom: 10px;
        border-color: black;
        border-width: 1px;
        width: 80%; /* Scale input relative to card */
        max-width: 100px;
        height: 30px;
        padding-left: 10px;
        font-size: 12px;
        box-sizing: border-box;
    }

    .article-card-footer {
        display: flex;
        justify-content: center;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    .article-card-footer .card-button {
        background-color: black;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 30px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        text-align: center;
        transition: background-color 0.3s ease;
        box-sizing: border-box;
    }

    .article-card-footer .card-button:hover {
        background-color: gray;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        width: 100%;
        flex-direction: column;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3.5px;
        font-family: sans-serif;
    }

    .pagination-button {
        padding: 0.625rem 1.5rem;
        background-color: #B2B2B2;
        color: black;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s ease-in-out;
    }

    .pagination-button:hover:not(:disabled) {
        background-color: #B2B2B2;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .pagination-button:disabled {
        background-color: #B2B2B2;
        opacity: 0.7;
        cursor: not-allowed;
    }

    .pagination-page {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #B2B2B2;
        color: white;
        border-radius: 30px;
        border: none;
        font-weight: 600;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .pagination-page:hover:not(.active) {
        background-color: #B2B2B2;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .pagination-page.active {
        background-color: #EEEEEE;
        color: black;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .pagination-ellipsis {
        padding: 0.5rem 0.75rem;
        color: #6b7280;
        font-size: 12px;
        user-select: none;
    }

    .pagination-info {
        display: flex;
        justify-content: center;
        margin-top: 1.5rem;
        color: white;
        font-size: 12px;
        font-weight: 500;
    }

    .footer {
        width: 90%;
        background-color: #333333;
        color: #EEEEEE;
        padding: 30px;
        box-shadow: 0 -5px 10px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        margin-bottom: 170px;
        border-radius: 50px;
    }

    .buttons {
        display: flex;
        flex-direction: row;
        height: 50px;
        gap: 20px;
    }

    .buttons .all-orders {
        background-color: lightblue;
        color: black;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        padding-left: 15px;
        padding-right: 15px;
        font-size: 15px;
    }
    .buttons .lock-table {
        background-color: red;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        padding-left: 15px;
        padding-right: 15px;
        font-size: 15px;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: #333333;
        color: #ffffff;
        font-family: sans-serif;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        border-radius: 0;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .custom-table th, .custom-table td {
        border-bottom: 2px solid #333333;
        padding: 12px 15px;
        text-align: center;
    }

    .custom-table th {
        background-color: #333333;
        color: #EEEEEE;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #222222;
    }

    .custom-table tbody tr:hover {
        /*background-color: #333333;*/
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

    .custom-table img {
        width: 70px;
        height: 70px;
        border-radius: 20px;
    }

    .total-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        width: 100%;
    }

    .screen-buttons-container {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        width: 100%;
    }

    .screen-button {
        color: #ffffff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        min-width: 120px;
    }

    .right-button {
        background-color: #89AC46;
    }

    .left-button {
        background-color: #ff0000;
    }

    .left-button:hover {
        background-color: #e60000;
    }

    .price {
        font-size: 12px;
        font-weight: bold;
        color: #3f402b;
        text-align: center;
        overflow-wrap: break-word;
    }

    .alert-success {
        background-color: #28a745;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
    }

    /* Mobile responsiveness */
    @media (max-width: 480px) {
        .left {
            max-width: 120px;
        }

        .article-card {
            width: calc(50% - 10px); /* Two cards per row with adjusted gap */
            max-width: 120px;
            min-height: 300px;
        }

        .article-card-header {
            font-size: 10px;
            min-height: 60px;
            padding: 8px;
        }

        .article-card-body {
            font-size: 10px;
        }

        .article-card-body img {
            width: 70%;
            max-width: 90px;
            height: auto;
        }

        .article-card-body input {
            width: 70%;
            max-width: 80px;
            height: 25px;
            font-size: 10px;
        }

        .article-card-footer .card-button {
            padding: 8px 15px;
            font-size: 14px;
        }

        .category-button {
            font-size: 14px;
            padding: 8px;
        }

        .footer {
            padding: 20px;
        }

        .custom-table th, .custom-table td {
            padding: 8px 10px;
            font-size: 12px;
        }

        .custom-table img {
            width: 50px;
            height: 50px;
        }

        .screen-buttons-container {
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .screen-button {
            width: 100%;
            max-width: 200px;
        }
    }

</style>
<body>


{{--<h3>Hello, Customer!</h3>--}}

{{--<h3>Izaberite kategoriju:</h3>--}}

@livewire('category-articles')


<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@livewireScripts

<!-- Initialize Swiper -->
<script>
    function disableButtonFor4Seconds(button) {
        button.disabled = true;
        setTimeout(() => {
            button.disabled = false;
        }, 4000);
    }

    Livewire.on('orderPlaced', message => {
        Swal.fire({
            title: 'Uspješno!',
            text: message,
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
                setTimeout(() => {
                    Swal.hideLoading();
                    Swal.enableButtons();
                }, 4000);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('tables') }}";
            }
        });
    });

    Livewire.on('orderEmpty', message => {
        Swal.fire({
            title: 'Korpa je prazna!',
            text: message,
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    });

    Livewire.on('tableInactive', message => {
        Swal.fire({
            title: 'Sto nije aktivan!',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });

    Livewire.on('cancelOrderPopup', () => {
        Swal.fire({
            title: 'Da li ste sigurni da zelite da otkazete narudzbu?',
            text: "Are you sure you want to cancle the order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Da, otkazi!',
            cancelButtonText: 'Ne, zadrzi'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('cancelOrder');
                Swal.fire(
                    'Narudzba otkazana!',
                    'Order successfully canceled.',
                    'success'
                );
            }
        });
    });

    var swiper = new Swiper('.category-swiper', {
        slidesPerView: 3,
        spaceBetween: 10,
        freeMode: true,
        grabCursor: true,
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
