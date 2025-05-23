<div>
    <button wire:click="backToList" class="back-button"><b>←</b></button>

    <div class="card-wrapper">
        <div class="card-main">
            <div class="card-head">
                {{ $article->title }}
            </div>
            <div class="card-details">
                <img src="{{ asset($article->image_url) }}" alt="{{ $article->title }}" class="w-full rounded-[30px] mb-2.5">
                <div>
                    <b> {{ $article->description }} </b>
                </div>
                <div class="card-cost">
                    <b>{{ Str::limit($article->price) }} KM</b>
                </div>
            </div>
            <div class="article-card-footer">
                <button class="card-button" wire:click="addToDestination({{ $article->id }})"><b>+</b></button>
            </div>
        </div>

        <style>
            .card-wrapper {
                display: flex;
                justify-content: center;
                align-items: start;
                min-height: 100vh;
                width: 100%;
                padding: 10px;
                box-sizing: border-box;
                margin-top: 30px;
            }

            .card-main {
                position: relative;
                background-color: white;
                border: 2px solid #333333;
                border-radius: 30px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
                width: 80%;
                max-width: 60vw;
                height: 530px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                overflow: auto;
                display: flex;
                flex-direction: column;
                padding: 15px;
            }

            .card-main:hover {
                transform: scale(1.05);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
                z-index: 10;
            }

            .back-button {
                background-color: #6b1111;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 10px;
                font-size: 17px;
                cursor: pointer;
                margin-top: 15px;
                margin-left: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: background-color 0.3s ease;
                text-align: center;
            }

            .back-button:hover {
                background-color: white;
                color: black;
            }

            .card-head {
                background-color: #8E1616;
                padding: 10px;
                font-size: 18px;
                font-weight: bold;
                color: white;
                text-align: center;
                border-radius: 10px;
                margin: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .card-details {
                padding: 10px;
                font-size: 14px;
                line-height: 1.6;
                text-align: center;
                color: #3f402b;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .card-details img {
                max-width: 50%;
                height: auto;
                object-fit: cover;
                border-radius: 30px;
            }

            .card-cost {
                font-weight: bold;
                margin-top: 20px;
                color: black;
            }
        </style>
    </div>

</div>
