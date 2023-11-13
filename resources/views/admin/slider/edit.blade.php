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
                    <h4>Cập nhật Slider</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Ảnh hiển thị</label>
                            <br>
                            <img width="200" src="{{asset($slider->banner)}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>Tải ảnh lên</label>
                            <input type="file" class="form-control" name="banner">
                        </div>

                        <div class="form-group">
                            <label>Loại</label>
                            <input type="text" class="form-control" name="type" value="{{$slider->type}}">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="title"  value="{{$slider->title}}">
                        </div>
                        <div class="form-group">
                            <label>Giá từ</label>
                            <input type="text" class="form-control" name="starting_price" value="{{$slider->starting_price}}">
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input type="text" class="form-control" name="btn_url" value="{{$slider->btn_url}}">
                        </div>
                        <div class="form-group">
                            <label>Số thứ tự</label>
                            <input type="text" class="form-control" name="serial" value="{{$slider->serial}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$slider->status == 1 ? 'selected': ''}} value="1">Hoạt động</option>
                              <option {{$slider->status == 0 ? 'selected': ''}} value="0">Dừng hoạt động</option>
                            </select>
                          </div>
                        <button type="submmit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
