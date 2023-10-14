@extends('admin.app') 
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Viloyatlar</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <button
                                type="button"
                                class="btn btn-light"
                                data-bs-toggle="modal"
                                data-bs-target="#addViloyatModal"
                            >
                                #
                            </button>
                            <div
                                class="modal fade"
                                id="addViloyatModal"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form
                                            action="/regions/add-viloyat"
                                            method="post"
                                        >
                                            @csrf
                                            <input type="text" class="form-control" name="name">

                                            <div class="model-footer">
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
                        <th>Viloyat nomi</th>
                        <th>Sozlamalar</th>
                    </tr>
                </thead>
                @php $s = 1 ; @endphp
                 @foreach ($viloyats as $viloyat) 
                

                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>@php echo $s++; @endphp</td>
                        <td>{{$viloyat->name}}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteViloyatModal{{$viloyat->id}}"
                            >
                                <i class="bx bxs-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="deleteViloyatModal{{$viloyat->id}}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <span
                                            >Siz haqiqatdan ham
                                            <span class="text-primary"
                                                >{{$viloyat->name}}</span
                                            >ni o'chirmoqchimisiz?</span
                                        >
                                        <div class="model-footer">
                                            <br />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Yopish
                                            </button>
                                            <a
                                                href="/regions/delete-viloyat/{{$viloyat->id}}"
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
                                data-bs-target="#editUserModal{{$viloyat->id}}"
                            >
                                <i class="bx bx-pencil"></i>
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="editUserModal{{$viloyat->id}}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form
                                            action="/regions/edit-viloyat/{{$viloyat->id}}"
                                            method="post"
                                            enctype="multipart/form-data"
                                        >
                                            @csrf
                                            <input
                                                type="text"
                                                class="form-control"
                                                value="{{$viloyat->name}}"
                                                name="name"
                                            /><br />

                                            <div class="model-footer">
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
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection