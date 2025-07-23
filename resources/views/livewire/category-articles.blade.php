@php use Illuminate\Support\Str; @endphp

<div>
    <div class="top-bar">
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>

        <div class="center-text">
            <p class="welcome-text"><b>Dobrodošli u Pub Klek!</b></p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Sign out</button>
        </form>
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
{{--                            <img src="{{ asset($article->image_url) }}" alt="{{ $article->title }}" style="width: 100px; height: 100px; border-radius: 30px; margin-bottom: 10px; cursor: pointer" wire:click="showArticle({{ $article->id }})">--}}
                            <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" wire:click="showArticle({{ $article->id }})" style="cursor: pointer;" />
                            <input style="border-radius: 40px; margin-bottom: 10px; border-color: black; border-width: 1px; width:100px; height: 30px; padding-left: 10px;" placeholder="Napomena: " wire:model="notes.{{ $article->id }}">
                            <div>
                                @if($article->tags)
                                    <div class="extras" style="margin-bottom: 10px;">
                                        @foreach($article->tags as $extra)
                                            @php
                                                $slug = Str::slug($extra['name'], '_');
                                                $value = $extra['name'];
                                            @endphp
                                            <label style="display: flex; align-items: center; font-size: 10px; text-align: start;">
                                                <input type="checkbox"
                                                       wire:model.defer="extras.{{ $article->id }}.{{ $slug }}"
                                                       value="{{ $value }}"
                                                       style="width: 15px; height: 15px; margin-right: 5px;">
                                                {{ $extra['name'] }}
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="price" wire:click="showArticle({{ $article->id }})" style="cursor: pointer;">
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
                <div class="buttons">
                    <button class="all-orders"><b>📝 Sve narudzbe</b></button>
                    <button type="button" class="lock-table" wire:click="lockTable"><b>🔒 Zakljuci sto</b></button>
                </div>

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

    Livewire.on('reset-checkboxes', (event) => {
        const articleId = event.articleId;
        const checkboxes = document.querySelectorAll(`input[wire\\:model\\.defer="extras.${articleId}"]`);
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        const noteInput = document.querySelector(`input[wire\\:model\\.defer="notes.${articleId}"]`);
        if (noteInput) {
            noteInput.value = '';
        }
    });
</script>
