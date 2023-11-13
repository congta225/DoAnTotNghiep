@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Danh mục chính</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Thêm danh mục</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.category.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Biểu tượng</label>
                             <div>
                                <button class="btn btn-primary" data-icon="" data-selected-class="btn-danger"
                                data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
                             </div>

                        </div>
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Hoạt động</option>
                              <option value="0">Dừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Thêm mới</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection
