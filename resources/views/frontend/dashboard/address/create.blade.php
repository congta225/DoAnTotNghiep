@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Thêm mới</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{route('user.address.store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Họ tên <b>*</b></label>
                      <input type="text" placeholder="Họ tên" name="name">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Email</label>
                      <input type="email" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Số điện thoại <b>*</b></label>
                      <input type="text" placeholder="Số điện thoại" name="phone">
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Mã ZIP <b>*</b></label>
                      <input type="text" placeholder="Zip Code" name="zip" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="wsus__check_single_form">
                            <select class="select_2" name="country" id="city">
                                <option value="" selected>Chọn tỉnh thành</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="wsus__check_single_form">
                            <select class="select_2" name="state" id="district" >
                                <option value="" selected>Chọn quận huyện</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="wsus__check_single_form">
                            <select class="select_2" name="city" id="ward" >
                                <option value="" selected>Chọn phường xã</option>
                            </select>
                        </div>
                    </div>
                </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Địa chỉ cụ thể <b>*</b></label>
                      <input type="text" placeholder="Address" name="address">
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                    <button type="submit" class="common_btn">Thêm</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
