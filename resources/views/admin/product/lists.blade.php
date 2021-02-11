@extends('admin.admin-master')

@section('product')
    active
@endsection

@section('admin_content');
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">

                <h6 class="card-body-title">product lists</h6>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-wrapper">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">create product</a>
                    <table id="brand_table" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Product name</th>
                                <th class="wd-15p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->brandName }}</td>
                                    <td>
                                        @if ($brand->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/brand/edit/' . $brand->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ url('admin/brand/delete/' . $brand->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
