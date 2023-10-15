@extends('admin.app')
@section('content')
    <div class="row container">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Sozlamalari</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">

                        @if (Auth::user()->photo == null)
                            <img src="/backend/user.png" class="d-block rounded" height="100" width="100"
                                id="uploadedAvatar" />
                        @else
                            <img src="/userPhotos/{{ Auth::user()->photo }}" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" data-bs-toggle="modal" data-bs-target="#showUserPhoto">

                            <!-- Modal -->
                            <div class="modal fade" id="showUserPhoto" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <img src="/userPhotos/{{ Auth::user()->photo }}" width="100%">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="button-wrapper">
                            <form method="POST" action="/users/change-user-photo/{{ $getUserData->id }}"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Yangi rasm Yuklash</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" name="photo" />

                                </label>
                                <button type="submit" style="display: none" id="send"
                                    class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Yuborish</span>
                                </button>
                                <script>
                                    document.getElementById('upload').addEventListener('change', function() {
                                        document.getElementById('send').style.display = 'block';
                                    });
                                </script>
                            </form>


                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Ismingiz</label>
                                <input class="form-control" type="text" id="firstName" name="name"
                                    value="{{ $getUserData->name }}" autofocus />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $getUserData->email }}" />
                            </div>
                            @if ($getUserData->viloyat_id)
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Viloyat</label>
                                    @foreach ($viloyatlar as $viloyat)
                                        @if ($getUserData->viloyat_id == $viloyat->id)
                                            <input disabled type="text" class="form-control disabled" id="organization"
                                                name="viloyat" value="{{ $viloyat->name }}" />
                                        @endif
                                    @endforeach

                                </div>
                            @endif
                            @if ($getUserData->tuman_id)
                                @foreach ($tumanlar as $tuman)
                                    @if ($getUserData->tuman_id == $tuman->id)
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Tuman</label>
                                            <input disabled type="text" class="form-control" id="tuman"
                                                name="tuman" value="{{  $tuman->name }}" />
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            @if ($getUserData->kasalxona_id)
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Kasalxona</label>
                                    <input disabled type="text" class="form-control" id="zipCode" name="kasalxona"
                                        value="{{ $getUserData->kasalxona_id }}" />
                                </div>
                            @endif



                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
