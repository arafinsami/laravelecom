@extends('admin.admin-master')

@section('product')
    active
@endsection

@section('admin_content');
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
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

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
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
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->productName }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">InActive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/product/edit/' . $product->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href="{{ url('admin/product/delete/' . $product->id) }}"
                                            class="btn btn-danger">Delete</a>
                                        @if ($product->status == 1)
                                            <a href="{{ url('admin/product/inactive/' . $product->id) }}"
                                                class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                                        @else
                                            <a href="{{ url('admin/product/active/' . $product->id) }}"
                                                class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                                        @endif
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
