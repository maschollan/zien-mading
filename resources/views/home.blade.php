<x-guest-layout>

    <div class="row flex-row-reverse">
        <div class="col-md-4">
            <div class="sticky-top" style="top : 1rem;">
                @auth
                    <h3 class="mb-3">Mading Baru</h3>
                    <div class="card border-success mb-3">
                        <div class="card-header d-flex">
                            <img src="{{ asset('images/'.Auth::user()->profile->foto_profile) }}" class="card-profile">
                            <div class="card-name">
                                <div class="h4 font-weight-bold mb-0 w-100">{{ Auth::user()->name }}</div>
                                <small class="text-secondary">{{ '@' . Auth::user()->username }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mading.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="foto" class="form-label"
                                        onclick="preview('#preview', '#foto')">Mading</label>
                                    <img id="preview" src="" class="img-fluid d-none mb-3" />
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="judul">
                                </div>
                                <div class="mb-3">
                                    <label for="konten" class="form-label">konten</label>
                                    <textarea class="form-control" id="konten" name="konten" rows="2"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="konten" class="form-label">Tags</label>
                                    <div class="card px-3 py-1" style="max-height: 80px; overflow-y:auto">
                                        @foreach ($tags as $tag)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}"
                                                    name="tags[]" value="{{ $tag->id }}">
                                                <label class="form-check-label"
                                                    for="tag-{{ $tag->id }}">{{ ucwords($tag->nama) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success text-white mb-3 w-100">Kirim</button>
                            </form>
                        </div>
                    </div>
                @endauth
                <h3 class="mb-3">Populer Tag</h3>
                <ul class="nav flex-column text-success">
                    @foreach ($popular_tag as $item)
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="{{ route('tag.show', $item->nama) }}">{{ $item->nama }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            @if (isset($isTag))
                <h3 class="mb-4">Mading dengan tag <strong>{{ $selected_tag }}</strong> </h3>
            @endif
            @if (isset($isProfile))
                <h3 class="mb-4">Mading oleh <strong>{{ $profile->name }}</strong> </h3>
            @endif
            @foreach ($madings as $mading)
                <div class="card border-success mb-5">
                    <a class="card-header d-flex text-success" style="text-decoration: none"
                        href="{{ route('profile.id', $mading->user->id) }}">
                        <img src="{{ asset('images/' . $mading->user->profile->foto_profile) }}"
                            class="card-profile">
                        <div class="card-name">
                            <div class="h4 font-weight-bold mb-0 w-100">{{ $mading->user->name }}</div>
                            <small class="text-secondary">{{ '@' . $mading->user->username }}</small>
                        </div>
                    </a>
                    <img src="{{ asset('images/' . $mading->foto_mading) }}" class="img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $mading->judul }}</h5>
                        <p class="card-text">{{ $mading->konten }}.</p>
                        <div>
                            tags :
                            @foreach ($mading->tags as $tag)
                                <a href="{{ route('tag.show', $tag->slug) }}"
                                    class="badge bg-success text-decoration-none">{{ $tag->nama }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">terakhir diperbarui
                            {{ $mading->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach

            <div>
                {{ $madings->links() }}
            </div>
        </div>
    </div>

</x-guest-layout>
