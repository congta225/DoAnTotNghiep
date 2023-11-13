@php
    $address = json_decode($order->order_address);

@endphp

@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} || Đơn hàng
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
                        <h3><i class="far fa-user"></i> Chi tiết đặt hàng</h3>
                        <div class="wsus__dashboard_profile">

                            <!--============================
                            INVOICE PAGE START
                        ==============================-->
                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Thông tin hóa đơn</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>Thông tin vận chuyển</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Mã đơn hàng: #{{ $order->invocie_id }}</h5>
                                                            <h6>Trạng thái đặt hàng:
                                                                {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                            </h6>
                                                            <p>Phương thức thanh toán: {{ $order->payment_method }}</p>
                                                            <p>Trạng thái thanh toán: {{ $order->payment_status === 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
                                                            <p>Mã giao dịch: {{ $order->transaction->transaction_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                Tên sản phẩm
                                                            </th>
                                                            <th class="amount">
                                                                Nhà cung cấp
                                                            </th>

                                                            <th class="amount">
                                                                Đơn giá
                                                            </th>

                                                            <th class="quentity">
                                                                Số lượng
                                                            </th>
                                                            <th class="total">
                                                                Tổng cộng
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->orderProducts as $product)
                                                            @if ($product->vendor_id === Auth::user()->vendor->id)
                                                                @php
                                                                    $variants = json_decode($product->variants);
                                                                    $total = 0;
                                                                    $total += $product->unit_price * $product->qty;
                                                                @endphp
                                                                <tr>
                                                                    <td class="name">
                                                                        <p>{{ $product->product_name }}</p>
                                                                        @foreach ($variants as $key => $item)
                                                                            <span>{{ $key }} :
                                                                                {{ $item->name }}(
                                                                                {{ number_format($item->price,0,'.','.') }}{{ $settings->currency_icon }}
                                                                                )</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="amount">
                                                                        {{ $product->vendor->shop_name }}
                                                                    </td>
                                                                    <td class="amount">

                                                                        {{ number_format($product->unit_price,0,'.','.') }}{{ $settings->currency_icon }}
                                                                    </td>

                                                                    <td class="quentity">
                                                                        {{ $product->qty }}
                                                                    </td>
                                                                    <td class="total">

                                                                        {{number_format(($product->unit_price * $product->qty),0,'.','.')  }}{{ $settings->currency_icon }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">

                                            <p><span>Tổng tiền:</span> {{number_format($total,0,'.','.')}}{{ $settings->currency_icon }}
                                                 </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--============================
                            INVOICE PAGE END
                        ==============================-->

                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('vendor.orders.status', $order->id) }}">
                                        <div class="form-group mt-5">
                                            <label for="" class="mb-2">Trạng thái đặt hàng</label>
                                            <select name="status" id="" class="form-control">
                                                @foreach (config('order_status.order_status_vendor') as $key => $status)
                                                    <option {{ $key === $order->order_status ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $status['status'] }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-primary mt-3" type="submit">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="mt-5 float-end">
                                        <button class="btn btn-warning print_invoice">In đơn hàng</button>
                                    </div>
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

@push('scripts')
    <script>
        $('.print_invoice').on('click', function() {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(printBody.html());

            window.print();

            $('body').html(originalContents);

        })
    </script>
@endpush
