@extends('admin.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">Adminlar</h3>
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
                @php $s = 1 ; @endphp @foreach ($users as $user)
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>@php echo $s++; @endphp</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <img src="/backend/user.png" width="40px" alt="" />
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteUserModal{{$user->id}}"
                            >
                                O'chirish
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="deleteUserModal{{$user->id}}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <span
                                            >Siz haqiqatdan ham
                                            <span class="text-primary"
                                                >{{$user->name}}</span
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
                                                href="/deleteUser/{{$user->id}}"
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
                                data-bs-target="#deleteUserModal{{$user->id}}"
                            >
                                Tahrirlash
                            </button>

                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="deleteUserModal{{$user->id}}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content p-3">
                                        <form action="/editUser/{{$user->id}}" method="post">
                                            <input type="text" class="form-control" value="{{$user->name}}"><br>
                                            <input type="text" class="form-control" value="{{$user->email}}"><br>
                                            <input type="text" class="form-control" placeholder="parol"><br>
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
                                                href="/deleteUser/{{$user->id}}"
                                                class="btn btn-danger"
                                                >O'chirish</a
                                            >
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
