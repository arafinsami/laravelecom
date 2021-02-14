@extends('admin.admin-master')

@section('admin_content');
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">coupon create</h6>
                
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form action="{{ route('admin.coupon.save') }}" method="POST">
                    @csrf
                    <div class="wd-300">
                        <div class="d-md-flex mg-b-30">
                            <div class="form-group mg-b-0">
                                <label>coupon name: <span class="tx-danger">*</span></label>
                                <input type="text" name="couponName" class="form-control wd-200 wd-sm-250"
                                    placeholder="coupon name">
                            </div>
                        </div>
                        <div class="d-md-flex mg-b-30">
                            <div class="form-group mg-b-0">
                                <label>choose status: <span class="tx-danger">*</span></label>
                                <select name="status" class="form-control select2" style="min-width: 248px;">
                                    <option>select status</option>
                                    <option value="1"> Active</option>
                                    <option value="0">In Active</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
