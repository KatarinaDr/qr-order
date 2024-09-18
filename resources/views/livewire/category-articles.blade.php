<div >

<label for="category">Slide left and right and press on category:</label>
        <div class="category-container">
            @foreach($categories as $category)
                @if($category->article->isNotEmpty())
                <button
                    wire:model="selectedCategory" 
                    class="category-button" 
                    wire:click="save('{{ $category->id }}')">
                    {{ $category->name }}
                </button>
                @endif
            @endforeach
        </div>

        <div>
            <h4>List of articles for choosen category:</h4>
        </div>
        
        <div class="article-card-container">
            @foreach($articles as $article)
                <div class="article-card">
                    <div class="article-card-header">
                        {{ $article->title }}
                    </div>
                    
                    <div class="article-card-body">
                        
                        Description: 
                        {{ Str::limit($article->description, 1000) }} <!-- Limit content length for preview -->
                        <div></div>
                        Price: 
                        {{ Str::limit($article->price) }} <!-- Limit content length for preview -->
                    </div>
                    
                    <div class="article-card-footer">
                        <button class="card-button" wire:click="addToDestination({{ $article['id'] }})" >Add</button>
                    </div>
                </div>
            @endforeach
        </div>

    <div>
            <h3>List of your orders:</h3>
    </div>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <table  class="custom-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>QTY</th>
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
            </div>
        </div>
    </div>


    <h3>Total: {{ $total }} KM</h3>

    <div class="screen-buttons-container">
            <button class="screen-button left-button" wire:click="confirmCancelOrder">Cancel Order</button>
            <button class="screen-button right-button" wire:click="naruciHranu">Make Order</button>
    </div>

    

    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif
    
    
</div>