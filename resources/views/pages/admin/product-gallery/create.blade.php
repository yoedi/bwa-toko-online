@extends('layouts.admin')

@section('title')
    Product Galleries
@endsection

@section('content')
  <div class="section-content section-content-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Product Galleries</h2>
        <p class="dashboard-subtitle">Create New Gallery</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-md-12">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <div class="card">
              <div class="card-body">
                <form action="{{route('product-gallery.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="form-control">
                          @foreach ($products as $product)
                              <option value="{{$product->id}}">{{$product->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Foto Produk</label>
                        <input type="file" name="photo" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-right">
                      <button class="btn btn-success px-5">Save Now</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
