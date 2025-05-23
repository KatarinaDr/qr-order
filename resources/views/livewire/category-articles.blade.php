<div>
    <div class="top-bar">
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <div class="welcome-container">
            <b><p class="welcome-text">Dobrodošli u Pub Klek!</p></b>
        </div>
    </div>

    <div class="main">
        <div class="left" id="leftMenu">
            <div class="category-container">
                @foreach($categories as $category)
                    @if($category->article->count() > 0)
                        <button
                            wire:model="selectedCategory"
                            class="category-button"
                            wire:click="save('{{ $category->id }}')">
                            <b>{{ $category->name }}</b>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="right">
            <div class="article-card-container">
                @foreach($articles as $article)
                    <div class="article-card">
                            <div class="article-card-header" wire:click="showArticle({{ $article->id }})" style="cursor: pointer;">
                                {{ $article->title }}
                            </div>
                            <div class="article-card-body">
                                <img src="{{ asset($article->image_url) }}" alt="{{ $article->title }}" style="width: 100px; height: 100px; border-radius: 30px; margin-bottom: 10px; cursor: pointer" wire:click="showArticle({{ $article->id }})">
                                <input style="border-radius: 40px; margin-bottom: 10px; border-color: black; border-width: 1px; width:100px; height: 30px; padding-left: 10px;" placeholder="Napomena:">
                                <div class="price">
                                    <b>{{ Str::limit($article->price) }} KM</b>
                                </div>
                            </div>
                        <div class="article-card-footer">
                            <button class="card-button" wire:click="addToDestination({{ $article->id }})"><b>+</b></button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination w-full flex justify-center">
                {{ $articles->links('components.pagination') }}
            </div>

            <div class="footer">
                <h3>Vaša korpa:</h3><br>

                <table class="custom-table">
                    <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Količina</th>
                        <th>+/-</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $row)
                        <tr>
                            <td>{{ $row['title'] }}</td>
                            <td>{{ $row['quantity'] }}</td>
                            <td>
                                <div class="article-card-footer"><button class="card-button" wire:click="increase({{ $row['id'] }})">+</button></div>
                                <div class="article-card-footer"><button class="card-button" wire:click="decrease({{ $row['id'] }})">-</button></div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="total-container">
                    <h3>Ukupno: {{ $total }} KM</h3>
                </div>

                <div class="screen-buttons-container">
                    <button class="screen-button left-button" wire:click="confirmCancelOrder"><b>Otkaži narudžbu</b></button>
                    <button class="screen-button right-button" wire:click="naruciHranu" onclick="disableButtonFor4Seconds(this)"><b>Napravi narudžbu</b></button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleMenu() {
        const leftMenu = document.getElementById('leftMenu');
        leftMenu.classList.toggle('open');
    }

    document.addEventListener('click', function(event) {
        const leftMenu = document.getElementById('leftMenu');
        const menuToggle = document.querySelector('.menu-toggle');
        const isClickInsideMenu = leftMenu.contains(event.target);
        const isClickOnToggle = menuToggle.contains(event.target);

        if (leftMenu.classList.contains('open') && !isClickInsideMenu && !isClickOnToggle) {
            leftMenu.classList.remove('open');
        }
    });
</script>
