@extends('admin.admin-master')

@section('admin_content');
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Coupon edit</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">coupon edit</h6>
                <form action="{{ route('admin.coupon.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="couponId" value="{{ $coupon->id }}">
                    
                    <div class="wd-300">
                        <div class="d-md-flex mg-b-30">
                            <div class="form-group mg-b-0">
                                <label>coupon name: <span class="tx-danger">*</span></label>
                                <input type="text" name="couponName" value="{{ $coupon->couponName }}"
                                    class="form-control wd-200 wd-sm-250" placeholder="coupon name" required>
                            </div>
                        </div>
                        <div class="d-md-flex mg-b-30">
                            <div class="form-group mg-b-0">
                                <label>coupon discount: <span class="tx-danger">*</span></label>
                                <input type="text" name="discount" value="{{ $coupon->discount }}" class="form-control wd-200 wd-sm-250"
                                    placeholder="coupon discount">
                            </div>
                        </div>
                        <div class="d-md-flex mg-b-30">
                            <div class="form-group mg-b-0">
                                <label>choose status: <span class="tx-danger">*</span></label>
                                <select name="status" class="form-control select2" data-placeholder="choose status"
                                    style="min-width: 248px;">
                                    <option value="1" @if ($coupon->status == '1') ? selected : null @endif> Active</option>
                                    <option value="0" @if ($coupon->status == '0') ? selected : null @endif>In Active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">submit</button>
                    </div>
                </form>
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
