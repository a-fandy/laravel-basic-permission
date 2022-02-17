@extends('layouts.admin.app')
@section('css')

@endsection
@section('content')
<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-11 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{isset($action)? $action : ''}} PERMISSION</h4>
                    <div class="row mt-3 justify-content-center">
                        <form class="col-md-12" method="POST" action="{{route($url)}}">
                            @csrf
                            <input type="hidden" name="id" value="{{old('id')}}">
                            <input type="hidden" name="child" value="{{old('child')}}">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2"></div>
                                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="nama" value="{{old('name')}}">
                                            @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2"></div>
                                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control js-basic-single" id="type" name="type">
                                                        <option value="">...</option>
                                                        <option value="role" @if(old('type')=='role' ) selected @endif>Role</option>
                                                        <option value="permission" @if(old('type')=='permission' ) selected @endif>Permission</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    @error('type')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2"></div>
                                        <label for="action" class="col-sm-2 col-form-label">Action</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="action" name="action" placeholder="action" value="{{old('action')}}">
                                            @error('action')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2"></div>
                                        <label for="permission" class="col-sm-2 col-form-label">Permission</label>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control js-basic-single" id="permission" name="permission">
                                                        <option value="">...</option>
                                                        <option value="0" @if(old('permission')=='0' ) selected @endif>Disable</option>
                                                        <option value="1" @if(old('permission')=='1' ) selected @endif>Active</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    @error('permission')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <div class="col-sm-2"></div>
                                        <label for="description" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="description" name="description" placeholder="keterangan" value="{{old('description')}}">
                                            @error('description')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-start mt-3">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <a href="{{route('account.permission.index')}}" class="btn btn-secondary btn-sm">Cancel</a>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <button type="submit" class="btn btn-sm btn-info">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    @error('child')
                                    <span class="invalid-feedback d-block mb-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <h5 class="card-title ">TABLE PERMISSION</h5>
                                </div>
                                <div class="table-responsive pt-3 col-md-12">
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
                                                    <input type="checkbox" id="child-list-all">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i = 1;
                                            @endphp
                                            @foreach($permissions as $permission)
                                            @if($permission->name != null)
                                            <tr>
                                                <td class="column-index">
                                                    {{$i++}}
                                                </td>
                                                <td>
                                                    {{$permission->name}}
                                                </td>
                                                <td style="width:30px;">
                                                    <div>
                                                        <input type="checkbox" class="child_list" name="child_list[]" id="child-list-{{$permission->id}}" value="{{$permission->id}}" @if(in_array($permission->id,old('child_list',[]))) checked @endif>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection

@section('js')
<script>
    if ($(".js-basic-single").length) {
        $(".js-basic-single").select2({
            placeholder: "select",
        });
    }

    $("#child-list-all").click(function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    checked_all = $('.child_list:checked').length == $('.child_list').length;
    if (checked_all) {
        $('#child-list-all').prop('checked', true);
    }
</script>
@endsection