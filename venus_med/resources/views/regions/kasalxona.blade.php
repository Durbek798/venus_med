@php
    $isAdmin = Auth()->user()->admin;
   $userTuman = Auth()->user()->tuman_id;
   $userViloyat = Auth()->user()->viloyat_id;
@endphp

@extends('admin.app')

@section('content')
<div class="container">
    @foreach ($tumans as $tuman)
        @if ($isAdmin == 1 )
            <div class="card mt-4">
            <div class="card-body">
                <h3 class="text-center">{{ $tuman->name }}dagi kasalxonalar</h3>

                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addKasalxonaningModal{{$tuman->id}}">
                    +
                </button>
                <div class="modal fade" id="addKasalxonaningModal{{$tuman->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-3">
                            <form action="/regions/add-kasalxona" method="post">
                                @csrf
                                <div class="form-group">
                                @foreach ($viloyats as $viloyat)
                                    @if ($userViloyat == $viloyat->id)
                                        <select name="viloyat_id" class="form-select">
                                            <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                        </select>
                                        <br>

                                    @endif

                                        @if ($tuman->viloyat_id == $viloyat->id)
                                        <select name="viloyat_id" class="form-select">
                                            <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                        </select>
                                        <br>

                                    @endif

                                @endforeach
                                    <select name="tuman_id" class="form-select">
                                        <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                    </select>
                                    <br>
                                    <input type="text" name="name" class="form-control" placeholder="kasalxona nomi">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish</button>
                                    <button type="submit" class="btn btn-success">Saqlash</button>
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
                            <th>Kasalxona nomi</th>
                            <th>Sozlamalar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $s = 1; @endphp
                        @foreach ($kasalxonas as $kasalxona)
                        @foreach ($viloyats as $viloyatItem)

                        @if($viloyatItem->id == $tuman->viloyat_id)
                        @if ($tuman->id == $kasalxona->tuman_id)
                        <tr>
                            <td>{{ $s++ }}</td>
                            <td>{{ $viloyatItem->name }}</td>
                            <td>{{ $tuman->name }}</td>
                            <td>{{ $kasalxona->name }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteKasalxonaModal{{ $kasalxona->id }}">
                                    <i class='bx bxs-trash-alt'></i>
                                </button>
                                <div class="modal fade" id="deleteKasalxonaModal{{ $kasalxona->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content p-3">
                                            <span>Siz haqiqatdan ham <span class="text-primary">{{ $kasalxona->name }}</span>ni
                                                o'chirmoqchimisiz?</span>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish
                                                </button>
                                                <a href="/regions/delete-kasalxona/{{$kasalxona->id}}" class="btn btn-danger">O'chirish</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editKasalxonaModal{{ $kasalxona->id }}">
                                    <i class='bx bxs-edit'></i>
                                </button>
                                <div class="modal fade" id="editKasalxonaModal{{ $kasalxona->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content p-3">
                                            <form action="/regions/edit-kasalxona/{{$kasalxona->id}}" method="post">
                                                @csrf
                                                @foreach ($viloyats as $viloyat)
                                                    @if ($userViloyat == $viloyat->id)
                                                        <select name="viloyat_id" class="form-select">
                                                            <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                        </select>
                                                        <br>
                                                    @endif
                                                    @if ($tuman->viloyat_id == $viloyat->id)
                                                        <select name="viloyat_id" class="form-select">
                                                            <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                        </select>
                                                        <br>

                                                    @endif
                                                @endforeach
                                                <select name="tuman_id" class="form-select" >
                                                    <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                                </select>
                                                <br>
                                                <input type="text" name="name" class="form-control" value="{{$kasalxona->name}}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Yopish</button>
                                                    <button type="submit" class="btn btn-success">Saqlash</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        @endif
        @foreach ($viloyats as $vil)
            @if($isAdmin == 2 && $userViloyat == $vil->id && $vil->id == $tuman->viloyat_id)
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="text-center">{{ $tuman->name }}dagi kasalxonalar</h3>

                        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addTumanModal{{$tuman->id}}">
                            +
                        </button>
                        <div class="modal fade" id="addTumanModal{{$tuman->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-3">
                                    <form action="/regions/add-kasalxona" method="post">
                                        @csrf
                                        <div class="form-group">
                                        @foreach ($viloyats as $viloyat)
                                            @if ($userViloyat == $viloyat->id)
                                                <select name="viloyat_id" class="form-select">
                                                    <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                </select>
                                                <br>

                                            @endif
                                            @if ($tuman->viloyat_id == $viloyat->id)
                                                <select name="viloyat_id" class="form-select">
                                                    <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                </select>
                                                <br>

                                            @endif
                                        @endforeach
                                            <select name="tuman_id" class="form-select">
                                                <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                            </select>
                                            <br>
                                            <input type="text" name="name" class="form-control" placeholder="kasalxona nomi">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
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
                                    <th>Kasalxona nomi</th>
                                    <th>Sozlamalar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $s = 1; @endphp
                                @foreach ($kasalxonas as $kasalxona)
                                @foreach ($viloyats as $viloyatItem)

                                @if($viloyatItem->id == $tuman->viloyat_id)
                                @if ($tuman->id == $kasalxona->tuman_id)
                                <tr>
                                    <td>{{ $s++ }}</td>
                                    <td>{{ $viloyatItem->name }}</td>
                                    <td>{{ $tuman->name }}</td>
                                    <td>{{ $kasalxona->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteTumanModal{{ $tuman->id }}">
                                            <i class="bx bx-trash-alt"></i>
                                        </button>
                                        <div class="modal fade" id="deleteTumanModal{{ $tuman->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <span>Siz haqiqatdan ham <span class="text-primary">{{ $kasalxona->name }}</span>ni
                                                        o'chirmoqchimisiz?</span>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close
                                                        </button>
                                                        <a href="/regions/delete-kasalxone" class="btn btn-danger">O'chirish</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editKasalxonaModal{{ $kasalxona->id }}">
                                            <i class="bx bx-pencil"></i>
                                        </button>
                                        <div class="modal fade" id="editKasalxonaModal{{ $kasalxona->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-3">
                                                    <form action="/regions/edit-kasalxona/{{$kasalxona->id}}" method="post">
                                                        @csrf
                                                        @foreach ($viloyats as $viloyat)
                                                            @if ($userViloyat == $viloyat->id)
                                                                <select name="viloyat_id" class="form-select">
                                                                    <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                                </select>
                                                                <br>
                                                            @endif
                                                            @if ($tuman->viloyat_id == $viloyat->id)
                                                                <select name="viloyat_id" class="form-select">
                                                                    <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                                </select>
                                                                <br>

                                                            @endif
                                                        @endforeach
                                                        <select name="tuman_id" class="form-select" >
                                                            <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="name" class="form-control" value="{{$kasalxona->name}}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Yopish</button>
                                                            <button type="submit" class="btn btn-success">Saqlash</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach

        @if ($userTuman == $tuman->id && $isAdmin == 3)
            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="text-center">{{ $tuman->name }}dagi kasalxonalar</h3>

                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addTumanModal{{$tuman->id}}">
                        +
                    </button>
                    <div class="modal fade" id="addTumanModal{{$tuman->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-3">
                                <form action="/regions/add-kasalxona" method="post">
                                    @csrf
                                    <div class="form-group">
                                    @foreach ($viloyats as $viloyat)
                                        @if ($userViloyat == $viloyat->id)
                                            <select name="viloyat_id" class="form-select">
                                                <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                            </select>
                                            <br>

                                        @endif
                                        @if ($tuman->viloyat_id == $viloyat->id)
                                            <select name="viloyat_id" class="form-select">
                                                <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                            </select>
                                            <br>

                                        @endif
                                    @endforeach
                                        <select name="tuman_id" class="form-select">
                                            <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                        </select>
                                        <br>
                                        <input type="text" name="name" class="form-control" placeholder="kasalxona nomi">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish</button>
                                        <button type="submit" class="btn btn-success">O'chirish</button>
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
                                <th>Kasalxona nomi</th>
                                <th>Sozlamalar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $s = 1; @endphp
                            @foreach ($kasalxonas as $kasalxona)
                            @foreach ($viloyats as $viloyatItem)

                            @if($viloyatItem->id == $tuman->viloyat_id)
                            @if ($tuman->id == $kasalxona->tuman_id)
                            <tr>
                                <td>{{ $s++ }}</td>
                                <td>{{ $viloyatItem->name }}</td>
                                <td>{{ $tuman->name }}</td>
                                <td>{{ $kasalxona->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteTumanModal{{ $tuman->id }}">
                                        <i class="bx bx-trash-alt"></i>
                                    </button>
                                    <div class="modal fade" id="deleteTumanModal{{ $tuman->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <span>Siz haqiqatdan ham <span class="text-primary">{{ $kasalxona->name }}</span>ni
                                                    o'chirmoqchimisiz?</span>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish
                                                    </button>
                                                    <a href="/regions/delete-kasalxone" class="btn btn-danger">O'chirish</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editKasalxonaModal{{ $kasalxona->id }}">
                                        <i class="bx bx-pencil"></i>
                                    </button>
                                    <div class="modal fade" id="editKasalxonaModal{{ $kasalxona->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content p-3">
                                                <form action="/regions/edit-kasalxona/{{$kasalxona->id}}" method="post">
                                                    @csrf
                                                    @foreach ($viloyats as $viloyat)
                                                        @if ($userViloyat == $viloyat->id)
                                                            <select name="viloyat_id" class="form-select">
                                                                <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                            </select>
                                                            <br>
                                                        @endif
                                                        @if ($tuman->viloyat_id == $viloyat->id)
                                                            <select name="viloyat_id" class="form-select">
                                                                <option value="{{$viloyat->id}}">{{$viloyat->name}}</option>
                                                            </select>
                                                            <br>

                                                        @endif
                                                    @endforeach
                                                    <select name="tuman_id" class="form-select" >
                                                        <option value="{{$tuman->id}}">{{$tuman->name}}</option>
                                                    </select>
                                                    <br>
                                                    <input type="text" name="name" class="form-control" value="{{$kasalxona->name}}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Yopish</button>
                                                        <button type="submit" class="btn btn-success">Saqlash</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection
