@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Biến thể sản phẩm</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Thêm biến thể</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.products-variant.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên biến thể</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product" value="{{request()->product}}">
                        </div>
                        <div class="form-group">
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
        </section>

@endsection
