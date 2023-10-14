@php
   $isAdmin = Auth()->user()->admin;
@endphp

@extends('admin.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Adminlar</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <button
                                type="button"
                                class="btn btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#addUserModal"
                            >
                                #
                            </button>
                            <div
                                class="modal fade"
                                id="addUserModal"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form
                                            action="/users/add-user"
                                            method="post"
                                            enctype="multipart/form-data"
                                        >
                                            @csrf
                                            @if ($isAdmin == 1)
                                                <select name="admin_id" class="form-select">
                                                <option value="Null">Admin turini tanlang</option>
                                                @foreach ($admins as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            <br>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Ism"
                                                name="name"
                                            /><br />
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Email"
                                                name="email"
                                            /><br />
                                            <input
                                                type="password"
                                                class="form-control"
                                                placeholder="parol"
                                                name="password"
                                            /><br />
                                            @if ($isAdmin == 1)
                                                <select name="viloyat_id" class="form-select">
                                                    <option value="Null">Viloyatni tanlang</option>
                                                    @foreach ($viloyatlar as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            @elseif ($isAdmin == 2)
                                                <select name="viloyat_id" class="form-select">
                                                    <option value="Null">Tumanni tanlang</option>
                                                    @foreach ($tumanlar as $tuman)
                                                        @if (Auth()->user()->viloyat_id == $tuman->viloyat_id)
                                                            <option value="{{ $tuman->id }}">{{ $tuman->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <br>
                                            @endif
                                            <div class="d-grid">
                                                <label
                                                    for="userPhotoInput"
                                                    class="btn btn-primary"
                                                    >Rasm</label
                                                >
                                                <input
                                                    name="photo"
                                                    type="file"
                                                    class="form-control"
                                                    hidden
                                                    id="userPhotoInput"
                                                /><br />
                                            </div>

                                            <div class="modal-footer">
                                                <br />
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Yopish
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success"
                                                >
                                                    Saqlash
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
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
                            <img
                                type="button"
                                data-bs-target="#showUserPhotoModal{{ $user->id }}"
                                data-bs-toggle="modal"
                                src="/userPhotos/{{ $user->photo }}"
                                width="40px"
                                alt=""
                            />
                            <div
                                class="modal fade"
                                id="showUserPhotoModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <img
                                            src="/userPhotos/{{ $user->photo }}"
                                            class="rounded"
                                            alt=""
                                        />
                                        <div class="modal-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal{{ $user->id }}"
                            >
                                <i class="bx bxs-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="deleteUserModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <span
                                            >Siz haqiqatdan ham
                                            <span class="text-primary"
                                                >{{ $user->name }}</span
                                            >ni o'chirmoqchimisiz?</span
                                        >
                                        <div class="modal-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                            <a
                                                href="/users/delete-user/{{ $user->id }}"
                                                class="btn btn-danger"
                                                >O'chirish</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                type="button"
                                class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}"
                            >
                                <i class="bx bx-pencil"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="editUserModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form
                                            action="/users/edit-user/{{ $user->id }}"
                                            method="post"
                                            enctype="multipart/form-data"
                                        >
                                            @csrf
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{ $user->name }}"
                                                name="name"
                                            /><br />
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{ $user->email }}"
                                                name="email"
                                            /><br />
                                            <input
                                                type="password"
                                                class="form-control"
                                                placeholder="parol"
                                                name="password"
                                            /><br />
                                            <div class="d-grid">
                                                <label
                                                    for="editUserPhotoInput"
                                                    class="btn btn-primary"
                                                    >Rasm</label
                                                >
                                                <input
                                                    name="photo"
                                                    type="file"
                                                    class="form-control"
                                                    id="editUserPhotoInput"
                                                /><br />
                                            </div>

                                            <div class="modal-footer">
                                                <br />
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Yopish
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="btn btn-success"
                                                >
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

@foreach ($users as $user)
@if ($user->admin === Null)
<br /><br />
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Yangi doydalanuvchilar</h3>
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
                @php $a = 1 ; @endphp
                 @foreach ($users as $user) 
                 @if ($user->admin === Null)
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>@php echo $a++; @endphp</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->photo === null)
                            <img src="/backend/user.png" width="40px" alt="" />
                            @else
                            <img
                                type="button"
                                data-bs-target="#showUserPhotoModal{{ $user->id }}"
                                data-bs-toggle="modal"
                                src="/userPhotos/{{ $user->photo }}"
                                width="40px"
                                alt=""
                            />
                            <div
                                class="modal fade"
                                id="showUserPhotoModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class "modal-content p-3">
                                        <img
                                            src="/userPhotos/{{ $user->photo }}"
                                            class="rounded"
                                            alt=""
                                        />
                                        <div class="modal-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal{{ $user->id }}"
                            >
                                <i class="bx bxs-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="deleteUserModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <span
                                            >Siz haqiqatdan ham
                                            <span class="text-primary"
                                                >{{ $user->name }}</span
                                            >ni o'chirmoqchimisiz?</span
                                        >
                                        <div class="modal-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                            <a
                                                href="/users/delete-user/{{ $user->id }}"
                                                class="btn btn-danger"
                                                >O'chirish</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                type="button"
                                class="btn btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#setUserToAdminModal{{ $user->id }}"
                            >
                                <i class="bx bx-check-double"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="setUserToAdminModal{{ $user->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <span
                                            >Siz haqiqatdan ham
                                            <span class="text-primary"
                                                >{{ $user->name }}</span
                                            >ni admin qilmoqchimisiz?</span
                                        >
                                        <div class="modal-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                            <a
                                                href="/users/set-user-to-admin/{{ $user->id }}"
                                                class="btn btn-success"
                                                >Admin Qilish</a
                                            >
                                        </div>
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
@endif
@endforeach

@endsection
