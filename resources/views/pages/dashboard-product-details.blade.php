@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Details
@endsection

@section('content')
  <div class="section-content section-content-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Shirup Marzzan</h2>
        <p class="dashboard-subtitle">
          Product Details <i class="ri-product-hunt-fill"></i>
        </p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Product Name</label>
                        <input
                          type="text"
                          name="name"
                          class="form-control"
                          value="{{ $product->name }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Price</label>
                        <input
                          type="number"
                          name="price"
                          class="form-control"
                          value="{{ $product->price }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control">
                          <option value="{{ $product->category_id }}">Tidak Diganti ({{ $product->category->name }})</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-right">
                      <button
                        type="submit"
                        class="btn btn-success px-5 btn-block"
                      >
                        Save Now
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  @foreach ($product->galleries as $gallery)
                    <div class="col-md-4">
                      <div class="gallery-container">
                        <img
                          src="{{ Storage::url($gallery->photo ?? '') }}"
                          alt=""
                          class="w-100"
                        />
                        <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery"
                          ><img src="/images/icon-delete.svg" alt=""
                        /></a>
                      </div>
                    </div>
                  @endforeach
                  
                  <div class="col-12">
                    <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <input
                        type="file"
                        name="photo"
                        id="file"
                        style="display: none"
                        onchange="form.submit()"
                      />
                      <button
                        type="button"
                        class="btn btn-secondary btn-block mt-3"
                        onclick="thisFileUpload()"
                      >
                        Add Photo
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor');
  </script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endpush