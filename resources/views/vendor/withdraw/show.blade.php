@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Tạo yêu cầu rút tiền
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Yêu cầu rút tiền</h3>
            <div class="wsus__dashboard_profile">
              <div class="row">
                <div class="wsus__dash_pro_area col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Phương thức rút tiền</b></td>
                                <td>{{ $request->method }}</td>
                            </tr>
                            <tr>
                                <td><b>Phí rút tiền</b></td>
                                <td>{{ ($request->withdraw_charge / $request->total_amount) * 100 }} %</td>
                            </tr>

                            <tr>
                                <td><b>Số tiền phí</b></td>
                                <td>{{ $request->withdraw_charge }}{{ $settings->currency_icon }} </td>
                            </tr>
                            <tr>
                                <td><b>Số tiền rút</b></td>
                                <td> {{ $request->total_amount }}{{ $settings->currency_icon }}</td>
                            </tr>
                            <tr>
                                <td><b>Tổng tiền rút được</b></td>
                                <td> {{ $request->withdraw_amount }}{{ $settings->currency_icon }}</td>
                            </tr>
                            <tr>
                                <td><b>Trạng thái</b></td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($request->status == 'paid')
                                    <span class="badge bg-success">Trả tiền</span>
                                    @else
                                    <span class="badge bg-danger">Từ chối</span>

                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Thông tin tài khoản</b></td>
                                <td>{!! $request->account_info !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection


