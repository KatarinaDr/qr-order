<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <div class="swiper-slide">
                        <tr>    
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->description }}</td>
                            <td>{{ $article->price }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->created_at }}</td>
                            <td>{{ $article->updated_at }}</td>
                        </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

