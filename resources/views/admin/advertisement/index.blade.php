@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Cài đặt</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Ảnh quảng cáo trang chủ 1</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Ảnh quảng cáo trang chủ 2</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Ảnh quảng cáo trang chủ 3</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Ảnh quảng cáo trang chủ 4</a>
                            <a class="list-group-item list-group-item-action" id="list-product-list" data-toggle="list" href="#list-product" role="tab">Ảnh quảng cáo trang sản phẩm</a>
                            <a class="list-group-item list-group-item-action" id="list-cart-list" data-toggle="list" href="#list-cart" role="tab">Ảnh quảng cáo trang giỏ hàng</a>
                          </div>
                        </div>
                        <div class="col-10">
                          <div class="tab-content" id="nav-tabContent">

                            @include('admin.advertisement.homepage-banner-one')

                            @include('admin.advertisement.homepage-banner-two')

                            @include('admin.advertisement.homepage-banner-three')

                            @include('admin.advertisement.homepage-banner-four')

                            @include('admin.advertisement.product-page-banner')

                            @include('admin.advertisement.cart-page-banner')

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
        </section>

@endsection
