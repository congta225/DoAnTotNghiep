
@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Yêu cầu của nhà cung cấp</h1>
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row mt-4">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Phương thức rút tiền</b></td>
                                <td>{{ $request->method }}</td>
                            </tr>
                            <tr>
                                <td><b>Tổng tiền rút</b></td>
                                <td> {{ $request->total_amount }}{{ $settings->currency_icon }}</td>
                            </tr>
                            <tr>
                                <td><b> Phí rút tiền</b></td>
                                <td>{{ ($request->withdraw_charge / $request->total_amount) * 100 }} %</td>
                            </tr>

                            <tr>
                                <td><b>Số tiền phí</b></td>
                                <td> {{ $request->withdraw_charge }}{{ $settings->currency_icon }}</td>
                            </tr>
                            <tr>
                                <td><b>Số tiền rút được</b></td>
                                <td>{{ $request->withdraw_amount }}{{ $settings->currency_icon }} </td>
                            </tr>
                            <tr>
                                <td><b>Trạng thái</b></td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($request->status == 'paid')
                                    <span class="badge bg-success">Đã trả</span>
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
        </section>

        <section class="section">
            <div class="section-body">
              <div class="invoice">
                <div class="invoice-print">
                  <div class="row mt-4">
                    <div class="col-md-4">
                        <form action="{{ route('admin.withdraw.update', $request->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" class="form-control" id="">
                                    <option @selected($request->status === 'pending') value="pending">Chờ xử lý</option>
                                    <option @selected($request->status === 'paid') value="paid">Đã trả</option>
                                    <option @selected($request->status === 'declined') value="declined">Từ chối</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>

@endsection

