@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Slider</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Thêm Slider</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tải ảnh lên</label>
                            <input type="file" class="form-control" name="banner">
                        </div>

                        <div class="form-group">
                            <label>Loại</label>
                            <input type="text" class="form-control" name="type" value="{{old('type')}}">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="title"  value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label>Giá từ</label>
                            <input type="text" class="form-control" name="starting_price" value="{{old('starting_price')}}">
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input type="text" class="form-control" name="btn_url" value="{{old('btn_url')}}">
                        </div>
                        <div class="form-group">
                            <label>Số thứ tự</label>
                            <input type="text" class="form-control" name="serial" value="{{old('serial')}}">
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
