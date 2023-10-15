@php
    $isAdmin = Auth()->user()->admin;
    $userViloyat = Auth()->user()->viloyat_id;
    $userTuman = Auth()->user()->tuman_id;
@endphp

@extends('admin.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Adminlar</h3>
                <div class="d-grid  gap-2 d-md-flex justify-content-md-end">
                    @if ($isAdmin == 1)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addViloyatAdminModal">
                            Yangi viloyat admin qo'shish
                        </button>
                        <div class="modal fade" id="addViloyatAdminModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <form action="/users/add-viloyat-admin" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <h3 class="text-center">Viloyat Admin</h3>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Ism" name="name" /><br />
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="email" /><br />
                                        <input type="password" class="form-control" placeholder="parol"
                                            name="password" /><br />
                                        <select name="viloyat_id" class="form-select">
                                            <option value="">Viloyatni tanlang</option>
                                            @foreach ($viloyatlar as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>

                                        <br>
                                        <div class="d-grid">
                                            <label for="userPhotoInput" class="btn btn-primary">Rasm</label>
                                            <input hidden name="photo" type="file" class="form-control" hidden
                                                id="userPhotoInput" /><br />
                                        </div>

                                        <div class="modal-footer">
                                            <br />
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                Yopish
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Saqlash
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($isAdmin == 1 || $isAdmin == 2)
                        <script>
                            function updateTumanDatas(select) {
                                var selectedViloyatID = select.value;
                                var tumanSelect = document.querySelector('select[id="tumanUpdate"]');
                                // Barcha tumanlar tanlovini yopamiz
                                tumanSelect.innerHTML = '';

                                // Tanlangan viloyatning ID-si bilan mos tumanlarni tanlab qo'yamiz
                                @foreach ($tumanlar as $tuman)
                                    if ({{ $tuman->viloyat_id }} == selectedViloyatID) {
                                        var option = document.createElement('option');
                                        option.value = {{ $tuman->id }};
                                        option.textContent = '{{ $tuman->name }}';
                                        tumanSelect.appendChild(option);
                                    }
                                @endforeach
                            }
                        </script>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addTumanAdminModal">
                            Yangi Tuman admin qo'shish
                        </button>
                        <div class="modal fade" id="addTumanAdminModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <form action="/users/add-tuman-admin" method="post" enctype="multipart/form-data">
                                        <h3 class="text-center">Tuman Admin</h3>
                                        <br>
                                        @csrf
                                        @if ($isAdmin == 1)
                                            <select name="viloyat_id" class="form-select" onchange="updateTumanDatas(this)">
                                                <option >Viloyatni tanlang</option>
                                                @foreach ($viloyatlar as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <select name="tuman_id" id="tumanUpdate" class="form-select">
                                                <option>Tumanni tanlang</option>
                                            </select>
                                        @endif
                                        @if ($isAdmin == 2)
                                            <select name="viloyat_id"  class="form-select">
                                                @foreach ($viloyatlar as $v)
                                                    @if ($userViloyat == $v->id)
                                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <br>
                                            <select name="tuman_id"  class="form-select">
                                                @foreach ($tumanlar as $tuman)
                                                    @if ($userViloyat == $tuman->viloyat_id)
                                                        <option value="{{ $tuman->id }}"
                                                            data-viloyat="{{ $tuman->viloyat_id }}">
                                                            {{ $tuman->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif


                                        <br>
                                        <input type="text" class="form-control" placeholder="Ism" name="name" /><br />
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="email" /><br />
                                        <input type="password" class="form-control" placeholder="parol"
                                            name="password" /><br />
                                        <br>
                                        <div class="d-grid">
                                            <label for="TumanUserPhotoInput" class="btn btn-primary">Rasm</label>
                                            <input hidden name="photo" type="file" class="form-control" hidden
                                                id="TumanUserPhotoInput" /><br />
                                        </div>

                                        <div class="modal-footer">
                                            <br />
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                Yopish
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Saqlash
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endif


                    @if ($isAdmin == 1 || $isAdmin == 2 || $isAdmin == 3)
                        <script>
                            function updateTumanlar(select) {
                                var selectedViloyatID = select.value;
                                var tumanSelect = document.querySelector('select[id="tuman"]');

                                // Barcha tumanlar tanlovini yopamiz
                                tumanSelect.innerHTML = '';

                                // Tanlangan viloyatning ID-si bilan mos tumanlarni tanlab qo'yamiz
                                @foreach ($tumanlar as $tuman)
                                    if ({{ $tuman->viloyat_id }} == selectedViloyatID) {
                                        var option = document.createElement('option');
                                        option.value = {{ $tuman->id }};
                                        option.textContent = '{{ $tuman->name }}';
                                        tumanSelect.appendChild(option);
                                    }
                                @endforeach
                            }

                            function updateKasalxona(select) {
                                var selectedtumanID = select.value;
                                var kasalxonaSelect = document.querySelector('select[id="kasalxona"]');

                                // Barcha tumanlar tanlovini yopamiz
                                kasalxonaSelect.innerHTML = '';

                                // Tanlangan tumanning ID-si bilan mos tumanlarni tanlab qo'yamiz
                                @foreach ($kasalxonalar as $kasalxona)
                                    if ({{ $kasalxona->tuman_id }} == selectedTumanID) {
                                        var option = document.createElement('option');
                                        option.value = {{ $kasalxona->id }};
                                        option.textContent = '{{ $kasalxona->name }}';
                                        kasalxonaSelect.appendChild(option);
                                    }
                                @endforeach
                            }
                        </script>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addKasalxonaAdminModal">
                            Yangi Kasalxona admin qo'shish
                        </button>
                        <div class="modal fade" id="addKasalxonaAdminModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <form action="/users/add-tuman-admin" method="post" enctype="multipart/form-data">
                                        <h3 class="text-center">Tuman Admin</h3>
                                        <br>
                                        @if ($isAdmin == 1)
                                            <select name="viloyat_id" class="form-select"
                                                onchange="updateTumanlar(this)">
                                                <option> Viloyatni tanlang </option>
                                                @foreach ($viloyatlar as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @if ($isAdmin == 2 || $isAdmin == 3)
                                            <select name="viloyat_id" class="form-select"
                                                onchange="updateTumanlar(this)">
                                                <option> Viloyatni tanlang </option>
                                                @foreach ($viloyatlar as $v)
                                                    @if ($userViloyat == $v->id)
                                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        <br>
                                        @if ($isAdmin == 1 || $isAdmin == 2)
                                            <select name="tuman_id" id="tuman" class="form-select"
                                                onchange="updateKasalxona(this)">
                                                <option> Tumanni Tanlang</option>

                                            </select>
                                        @endif
                                        @if ($isAdmin == 3)
                                            <select name="tuman_id">
                                                @foreach ($tumanlar as $tuman)
                                                    @if ($userTuman == $tuman->id)
                                                        <option value="{{ $tuman->id }}">{{ $tuman->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif

                                        <br>
                                        <select name="kasalxona_id" id="kasalxona" class="form-select">
                                            <option> Kasalxonani tanlang </option>

                                        </select>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Ism"
                                            name="name" /><br />
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="email" /><br />
                                        <input type="password" class="form-control" placeholder="parol"
                                            name="password" /><br />
                                        <br>
                                        <div class="d-grid">
                                            <label for="TumanUserPhotoInput" class="btn btn-primary">Rasm</label>
                                            <input name="photo" type="file" class="form-control" hidden
                                                id="TumanUserPhotoInput" /><br />
                                        </div>

                                        <div class="modal-footer">
                                            <br />
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                Yopish
                                            </button>
                                            <button type="submit" class="btn btn-success">
                                                Saqlash
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ism</th>
                            <th>Email</th>
                            <th>Rasm</th>
                            <th>Sozlamalar</th>
                        </tr>
                    </thead>
                    @php $s = 1 ; @endphp
                    @foreach ($users as $user)
                        @if ($user->admin === '1')
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>@php echo $s++; @endphp</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->photo === null)
                                            <img src="/backend/user.png" width="40px" alt="" />
                                        @else
                                            <img type="button" data-bs-target="#showUserPhotoModal{{ $user->id }}"
                                                data-bs-toggle="modal" src="/userPhotos/{{ $user->photo }}"
                                                width="40px" alt="" />
                                            <div class="modal fade" id="showUserPhotoModal{{ $user->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content p-3">
                                                        <img src="/userPhotos/{{ $user->photo }}" class="rounded"
                                                            alt="" />
                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $user->id }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <span>Siz haqiqatdan ham
                                                        <span class="text-primary">{{ $user->name }}</span>ni
                                                        o'chirmoqchimisiz?</span>
                                                    <div class="modal-footer">
                                                        <br />
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Yopish
                                                        </button>
                                                        <a href="/users/delete-user/{{ $user->id }}"
                                                            class="btn btn-danger">O'chirish</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                            <i class="bx bx-pencil"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <form action="/users/edit-user/{{ $user->id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->name }}" name="name" /><br />
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->email }}" name="email" /><br />
                                                        <input type="password" class="form-control" placeholder="parol"
                                                            name="password" /><br />
                                                        <div class="d-grid">
                                                            <label for="editUserPhotoInput"
                                                                class="btn btn-primary">Rasm</label>
                                                            <input name="photo" type="file" class="form-control"
                                                                id="editUserPhotoInput" /><br />
                                                        </div>

                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                            <button type="submit" class="btn btn-success">
                                                                Saqlash
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <br /><br />
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Viloyat Adminlar</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Viloyat</th>
                            <th>Ism</th>
                            <th>Email</th>
                            <th>Rasm</th>
                            <th>Sozlamalar</th>
                        </tr>
                    </thead>
                    @php $a = 1 ; @endphp
                    @foreach ($users as $user)
                        @if ($user->viloyat_id && $user->tuman_id == null)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>@php echo $a++; @endphp</td>
                                    <td>
                                        @foreach ($viloyatlar as $b)
                                            @if ($user->viloyat_id == $b->id)
                                                {{ $b->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->photo === null)
                                            <img src="/backend/user.png" width="40px" alt="" />
                                        @else
                                            <img type="button" data-bs-target="#showUserPhotoModal{{ $user->id }}"
                                                data-bs-toggle="modal" src="/userPhotos/{{ $user->photo }}"
                                                width="40px" alt="" />
                                            <div class="modal fade" id="showUserPhotoModal{{ $user->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class "modal-content p-3">
                                                        <img src="/userPhotos/{{ $user->photo }}" class="rounded"
                                                            alt="" />
                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $user->id }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <span>Siz haqiqatdan ham
                                                        <span class="text-primary">{{ $user->name }}</span>ni
                                                        o'chirmoqchimisiz?</span>
                                                    <div class="modal-footer">
                                                        <br />
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Yopish
                                                        </button>
                                                        <a href="/users/delete-user/{{ $user->id }}"
                                                            class="btn btn-danger">O'chirish</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                            <i class="bx bx-pencil"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <form action="/users/edit-user/{{ $user->id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->name }}" name="name" /><br />
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->email }}" name="email" /><br />
                                                        <input type="password" class="form-control" placeholder="parol"
                                                            name="password" /><br />
                                                        <div class="d-grid">
                                                            <label for="editUserPhotoInput{{ $user->id }}"
                                                                class="btn btn-primary">Rasm</label>
                                                            <input name="photo" type="file" class="form-control"
                                                                id="editUserPhotoInput{{ $user->id }}" hidden /><br />
                                                        </div>

                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                            <button type="submit" class="btn btn-success">
                                                                Saqlash
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <br><br>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Tuman Adminlar</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Viloyat</th>
                            <th>Tuman</th>
                            <th>Ism</th>
                            <th>Email</th>
                            <th>Rasm</th>
                            <th>Sozlamalar</th>
                        </tr>
                    </thead>
                    @php $a = 1 ; @endphp
                    @foreach ($users as $user)
                        @if ($user->tuman_id && $user->kasalxona_id == null)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>@php echo $a++; @endphp</td>
                                    <td>
                                        @foreach ($viloyatlar as $b)
                                            @if ($user->viloyat_id == $b->id)
                                                {{ $b->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($tumanlar as $b)
                                            @if ($user->tuman_id == $b->id)
                                                {{ $b->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->photo === null)
                                            <img src="/backend/user.png" width="40px" alt="" />
                                        @else
                                            <img type="button" data-bs-target="#showUserPhotoModal{{ $user->id }}"
                                                data-bs-toggle="modal" src="/userPhotos/{{ $user->photo }}"
                                                width="40px" alt="" />
                                            <div class="modal fade" id="showUserPhotoModal{{ $user->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class "modal-content p-3">
                                                        <img src="/userPhotos/{{ $user->photo }}" class="rounded"
                                                            alt="" />
                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal{{ $user->id }}">
                                            <i class="bx bxs-trash-alt"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <span>Siz haqiqatdan ham
                                                        <span class="text-primary">{{ $user->name }}</span>ni
                                                        o'chirmoqchimisiz?</span>
                                                    <div class="modal-footer">
                                                        <br />
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">
                                                            Yopish
                                                        </button>
                                                        <a href="/users/delete-user/{{ $user->id }}"
                                                            class="btn btn-danger">O'chirish</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal{{ $user->id }}">
                                            <i class="bx bx-pencil"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <form action="/users/edit-user/{{ $user->id }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->name }}" name="name" /><br />
                                                        <input type="text" class="form-control"
                                                            value="{{ $user->email }}" name="email" /><br />
                                                        <input type="password" class="form-control" placeholder="parol"
                                                            name="password" /><br />
                                                        <div class="d-grid">
                                                            <label for="editUserPhotoInput{{ $user->id }}"
                                                                class="btn btn-primary">Rasm</label>
                                                            <input name="photo" type="file" class="form-control"
                                                                id="editUserPhotoInput{{ $user->id }}" hidden /><br />
                                                        </div>

                                                        <div class="modal-footer">
                                                            <br />
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Yopish
                                                            </button>
                                                            <button type="submit" class="btn btn-success">
                                                                Saqlash
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
