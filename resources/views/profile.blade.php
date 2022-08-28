<x-guest-layout>


    <h3 class="mb-3">Profile</h3>

    <div class="row">
        <div class="col-md-8 mb-3">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <img src="{{ asset('images/'.Auth::user()->profile->foto_profile) }}" class="profile-big">

                @if ($errors->any())
                    <div class="mb-4">
                        <div class="fs-5 text-danger">
                            {{ __('Maaf ada yang salah.') }}
                        </div>

                        <ul class="mt-3 text-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Profile</label>
                    <img id="preview" src="" class="img-fluid d-none mb-3" />
                    <input class="form-control" type="file" name="foto-profile" id="foto" onchange="preview()">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                        value="{{ old('name', Auth::user()->name) }}">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username"
                        value="{{ old('username', Auth::user()->username) }}">
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Biografi</label>
                    <textarea class="form-control" id="bio" name="bio" rows="2">{{ old('bio', $profile->bio) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $profile->tanggal_lahir) }}">
                </div>
                <button type="submit" class="btn btn-success text-white mb-3 w-100">Simpan</button>
            </form>

        </div>
        <div class="col-md-4 mb-3">
            <div class="sticky-top" style="top : 1rem;">

                <form method="POST" action="{{ route('logout') }}" class="d-md-block d-none mb-4">
                    @csrf

                    <a :href="route('logout')" class="btn btn-danger w-100 text-white"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>

                <h3 class="mb-3">Madingku</h3>
                @if (Auth::user()->madings->count() != 0)

                    <div id="mading-list">
                        @foreach (Auth::user()->madings as $mading)
                            <div class="mading-item">
                                <img src="{{ asset('images/' . $mading->foto_mading) }}">
                                <h6 class="me-auto">{{ $mading->judul }}</h6>
                                <button type="button"
                                    onclick="edit('{{ $mading->id }}','{{ $mading->judul }}', '{{ $mading->konten }}')"
                                    class="btn btn-primary btn-sm text-white">Edit</button>
                                <form action="{{ route('mading.delete', $mading->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm text-white"
                                        onclick="return confirm('Apakah kamu yakin menghapus data ini')">Hapus</button>
                                </form>
                            </div>
                        @endforeach

                    </div>
                @else
                    <p>kamu belum buat mading <strong>Buat dulu yaw</strong></p>
                @endif

                <h3 class="mb-3">Form Mading</h3>

                <div id="mading-edit">
                    <form action="{{ route('mading.store') }}" method="post" id="form-edit" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="foto_mading" class="form-label">Mading</label>
                            <img id="preview" src="{{ asset('images/default.jpg') }}"
                                class="img-fluid d-none mb-3" />
                            <input class="form-control" type="file" name="foto" id="foto_mading" onchange="preview()">
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                placeholder="judul">
                        </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten</label>
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

                        <div class="btn-group w-100">
                            <span onclick="reset()" type="reset"
                                class="btn btn-secondary text-white mb-3 w-50">Batal</span>
                            <button type="submit" id="btn-submit"
                                class="btn btn-success text-white mb-3 w-50">Tambah</button>
                        </div>
                    </form>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="d-md-none d-block">
                    @csrf

                    <a :href="route('logout')" class="btn btn-danger w-100 text-white"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script>
        let editUrl = "{{ route('home') }}";
        let addUrl = "{{ route('mading.store') }}";

        function edit(id, judul, konten) {
            document.querySelector('#form-edit').action = editUrl + '/mading/update/' + id;
            document.querySelector('#btn-submit').innerText = 'Perbarui';
            document.querySelector('#judul').value = judul;
            document.querySelector('#konten').value = konten;
        }

        function reset() {
            document.querySelector('#form-edit').action = addUrl;
            document.querySelector('#btn-submit').innerText = 'Tambah';
            document.querySelector('#judul').value = '';
            document.querySelector('#konten').value = '';
        }
    </script>

</x-guest-layout>
