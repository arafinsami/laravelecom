@extends('admin.admin-master')

@section('admin_content');
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Admin</a>
            <span class="breadcrumb-item active">Add Product</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm">
                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Add New Product</h6>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('admin.product.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="productName"
                                            value="{{ old('productName') }}" placeholder="product name">
                                        @error('productName')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">product_code: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="productCode"
                                            value="{{ old('productCode') }}" placeholder="product code">
                                        @error('productCode')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="price" value="{{ old('price') }}"
                                            placeholder="product price">
                                        @error('price')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="productQuantity"
                                            value="{{ old('productQuantity') }}" placeholder="product quantity">
                                        @error('productQuantity')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="categoryId"
                                            data-placeholder="Choose country">
                                            <option label="Choose category"></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->categoryName }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('categoryId')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="brandId"
                                            data-placeholder="Choose country">
                                            <option label="Choose brand"></option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brandName }}</option>
                                            @endforeach
                                        </select>
                                        @error('brandId')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Short Description: <span
                                                class="tx-danger">*</span></label>
                                        <textarea name="shortDescription" id="summernote"></textarea>
                                        @error('shortDescription')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Long Description: <span
                                                class="tx-danger">*</span></label>
                                        <textarea name="longDescription" id="summernote2"></textarea>
                                        @error('longDescription')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Main thambnail: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="imageOne">
                                        @error('imageOne')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image Two: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="imageTwo">
                                        @error('imageTwo')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image Three: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="imageThree">
                                        @error('imageThree')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-layout-footer">
                                <button class="btn btn-info mg-r-5">Add Products</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
