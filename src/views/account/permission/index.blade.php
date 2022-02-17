@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            @if (session('message'))
            <div class="alert {{ session('class') }}">
                {{ session('message') }}
            </div>
            @endif
        </div>

        <div class="col-lg-12 mb-3">
            <div class="row">
                <div class="col-sm-6">
                    <a class="btn btn-sm btn-success" href="{{route('account.permission.create')}}">Add Permission</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-end">
                            <h4 class="card-title ">PERMISSION</h4>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-striped mb-3">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Nama
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Action Name
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th style="width: 10%;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = $permissions->currentPage() * $permissions->perPage() - $permissions->perPage() + 1;
                                @endphp
                                @foreach($permissions as $permission)
                                <tr>
                                    <td class="column-index">
                                        {{$i++}}
                                    </td>
                                    <td>
                                        {{$permission->name}}
                                    </td>
                                    <td>
                                        {{$permission->type == 1 ? 'Role' : 'Permission'}}
                                    </td>
                                    <td>
                                        {{$permission->action}}
                                    </td>
                                    <td>
                                        {{$permission->permission == 1 ? 'Active' : ''}}
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{route('account.permission.edit',['permission'=>$permission->id])}}" class="btn btn-sm btn-info"><span class="ti-pencil-alt"></span>Edit</a>
                                        <a href="#delete_modal" class="btn btn-sm btn-danger" id="confirm_delete" data-id="{{$permission->id}}" data-name="{{$permission->name}}"><span class="ti-trash">Delete</span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->links('layouts.pagination.admin') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete_modal" class="modal">
    <div class="modal__content">
        <div class="modal-header">
            <h5 class="modal-title">Apakah anda yakin ingin menghapus data permission <span id="nama"></span> ? </h5>
        </div>
        <div class="modal-body">
            <form id="" action="{{route('account.permission.destroy')}}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <a href="#" class="btn btn-light">Batal</a>
                <button type="submit" class="btn btn-danger mr-2">Delete</button>
            </form>
        </div>
        <a href="#" class="modal__close">&times;</a>

    </div>
</div>

<!-- content-wrapper ends -->
@endsection

@section('js')

<script>
    $(document).on("click", "#confirm_delete", function() {
        var dataId = $(this).data('id');
        $(".modal-body #id").val(dataId);
        $(".modal #nama").text($(this).data('name'));
    });
</script>
@endsection