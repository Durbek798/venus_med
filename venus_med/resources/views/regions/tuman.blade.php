@php
    $isAdmin = Auth()->user()->admin;
    $userViloyat = Auth()->user()->viloyat_id;
@endphp
@extends('admin.app')
@section('content')
    @if ($isAdmin == 1)
        <div class="container">
            @foreach ($viloyats as $viloyat)
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="text-center">{{ $viloyat->name }}dagi tumanlar</h3>

                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#addTumanModal{{ $viloyat->id }}">
                            +
                        </button>
                        <div class="modal fade" id="addTumanModal{{ $viloyat->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <form action="/regions/add-tuman" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <select name="viloyat_id" class="form-select">
                                                <option value="{{ $viloyat->id }}">
                                                    {{ $viloyat->name }}
                                                </option>
                                            </select>

                                            <br />

                                            <input type="text" name="name" class="form-control"
                                                placeholder="Tuman nomi" />
                                        </div>

                                        <div class="modal-footer">
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
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Viloyat nomi</th>
                                    <th>Tuman nomi</th>
                                    <th>Sozlamalar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $s = 1; @endphp @foreach ($tumans as $tuman)
                                    @if ($viloyat->id == $tuman->viloyat_id)
                                        <tr>
                                            <td>{{ $s++ }}</td>
                                            <td>{{ $viloyat->name }}</td>
                                            <td>{{ $tuman->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteTumanModal{{ $tuman->id }}">
                                                    <i class='bx bx-trash-alt'></i>
                                                </button>

                                                <div class="modal fade" id="deleteTumanModal{{ $tuman->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content p-3">
                                                            <span>Siz haqiqatdan ham
                                                                <span class="text-primary">{{ $tuman->name }}</span>ni
                                                                o'chirmoqchimisiz?</span>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Yopish
                                                                </button>
                                                                <a href="/regions/delete-tuman/{{ $tuman->id }}"
                                                                    class="btn btn-danger">O'chirish</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editTumanModal{{ $tuman->id }}">
                                                    <i class='bx bxs-pencil'></i>
                                                </button>

                                                <div class="modal fade" id="editTumanModal{{ $tuman->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content p-3">
                                                            <form action="/regions/edit-tuman/{{ $tuman->id }}"
                                                                method="post">

                                                                @csrf
                                                                <select name="viloyat_id" class="form-select">
                                                                    <option value="{{ $viloyat->id }}">
                                                                        {{ $viloyat->name }}</option>
                                                                </select>
                                                                <br>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $tuman->name }}" placeholder="Tuman nomi" />
                                                                <div class="modal-footer">
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if ($isAdmin == 2)
        <div class="container">
            @foreach ($viloyats as $viloyat)
                @if ($userViloyat == $viloyat->id)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h3 class="text-center">{{ $viloyat->name }}dagi tumanlar</h3>

                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#addTumanModal{{ $viloyat->id }}">
                                +
                            </button>
                            <div class="modal fade" id="addTumanModal{{ $viloyat->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form action="/regions/add-tuman" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <select name="viloyat_id" class="form-select">
                                                    <option value="{{ $viloyat->id }}">
                                                        {{ $viloyat->name }}
                                                    </option>
                                                </select>

                                                <br />

                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Tuman nomi" />
                                            </div>

                                            <div class="modal-footer">
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
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Viloyat nomi</th>
                                        <th>Tuman nomi</th>
                                        <th>Sozlamalar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $s = 1; @endphp @foreach ($tumans as $tuman)
                                        @if ($viloyat->id == $tuman->viloyat_id)
                                            <tr>
                                                <td>{{ $s++ }}</td>
                                                <td>{{ $viloyat->name }}</td>
                                                <td>{{ $tuman->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTumanModal{{ $tuman->id }}">
                                                        <i class='bx bx-trash-alt'></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteTumanModal{{ $tuman->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content p-3">
                                                                <span>Siz haqiqatdan ham
                                                                    <span
                                                                        class="text-primary">{{ $tuman->name }}</span>ni
                                                                    o'chirmoqchimisiz?</span>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Yopish
                                                                    </button>
                                                                    <a href="/regions/delete-tuman/{{ $tuman->id }}"
                                                                        class="btn btn-danger">O'chirish</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editTumanModal{{ $tuman->id }}">
                                                        <i class='bx bxs-pencil'></i>
                                                    </button>

                                                    <div class="modal fade" id="editTumanModal{{ $tuman->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content p-3">
                                                                <form action="/regions/edit-tuman/{{ $tuman->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <select name="viloyat_id" class="form-select">
                                                                        <option value="{{ $viloyat->id }}">
                                                                            {{ $viloyat->name }}</option>
                                                                    </select>
                                                                    <br>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $tuman->name }}"
                                                                        placeholder="Tuman nomi" />
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
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
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection
