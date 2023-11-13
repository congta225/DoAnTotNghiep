@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name}} || Biến thể item
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
            <a href="{{route('vendor.products-variant-item.index',
            ['productId' => $product->id, 'variantId' => $variant->id])}}" class="btn btn-warning mb-4"><i class="fas fa-long-arrow-left"></i> Quay lại</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Thêm biến thể item</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant-item.store')}}" method="POST">
                    @csrf

                    <div class="form-group wsus__input">
                        <label>Tên biến thể</label>
                        <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                    </div>

                    <div class="form-group wsus__input">
                        <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                    </div>
                    <div class="form-group wsus__input">
                        <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Tên item</label>
                        <input type="text" class="form-control" name="name" value="">
                    </div>

                    <div class="form-group wsus__input">
                        <label>Giá <code>(đặt bằng 0 nếu sản phẩm không tăng thêm)</code></label>
                        <input type="text" class="form-control" name="price" value="">
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Mặc định?</label>
                        <select id="inputState" class="form-control" name="is_default">
                            <option value="">--------------Chọn------------</option>
                          <option value="1">Có</option>
                          <option value="0">Không</option>
                        </select>
                    </div>

                    <div class="form-group wsus__input">
                        <label for="inputState">Trạng thái</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="1">Hoạt động</option>
                          <option value="0">Dừng hoạt động</option>
                        </select>
                    </div>
                    <button type="submmit" class="btn btn-primary">Thêm</button>
                </form>
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
