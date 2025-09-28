@if (Auth::id() != $micropost->user->id)
    @if (Auth::user()->is_favorites($micropost->id))
        {{-- お気に入り外すボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-soft btn-block normal-case"
                onclick="return confirm('id = {{ $micropost->id }} のお気に入りを外します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- お気に入りボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-soft btn-block normal-case">favorite</button>
        </form>
    @endif
@endif