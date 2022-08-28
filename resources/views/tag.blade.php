<x-guest-layout>

    <h3 class="mb-3">Tag Populer</h3>
    <div class="row">
        @foreach ($tags->slice(0,3) as $tag)
        <div class="col-4">
            <a href="{{ route('tag.show', $tag->slug) }}" class="card mb-3 text-decoration-none" style="min-height: 50px">
                <img class="card-img-top" src="https://source.unsplash.com/featured/600x400/?{{ $tag->nama }}">
                <div class="card-img-overlay d-flex align-item-center" style="background: rgba(0,0,0,.3)">
                    <h1 class="m-0 text-center align-self-center w-100 text-white">{{ $tag->nama }}</h1>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <h3 class="my-3">Tag Lainnya</h3>
    <div class="row justify-content-center">
        @foreach ($tags->slice(3) as $tag)
            <div class="col-3">
                <a href="{{ route('tag.show', $tag->slug) }}" class="card mb-3 bg-light text-dark text-decoration-none">
                    <div class="card-body d-flex align-item-center" style="height:100px">
                        <h4 class="m-0 text-center align-self-center w-100">{{ $tag->nama }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</x-guest-layout>
