@extends('layouts.app')

@section('title')
    Store Category Page
@endsection

@section('content')
    <div class="page-content page-home">
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Categories</h5>
            </div>
          </div>
          <div class="row">
            @forelse ($categories as $category)
                  <div
                      class="col-6 col-md-3 col-lg-2"
                      data-aos="fade-up"
                      data-aos-delay="100"
                  >
                      <a href="{{route('category-detail', $category->slug)}}" class="component-categories d-block">
                      <div class="categories-image">
                          <img
                          src="{{Storage::url($category->photo)}}"
                          alt=""
                          class="w-100"
                          />
                      </div>
                      <p class="categories-text">{{$category->name}}</p>
                      </a>
                  </div>
              @empty
                  <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                      No Category Found.
                  </div>
              @endforelse
          </div>
        </div>
      </section>
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Products</h5>
            </div>
          </div>
          <div class="row">
            @forelse ($products as $product)
                <div
                    class="col-6 col-md-4 col-lg-3"
                    data-aos="fade-up"
                    data-aos-delay="100"
                    >
                    <a href="{{route('detail', $product->slug)}}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div
                                class="products-image"
                                style="
                                @if($product->galleries)
                                    background-image: url('{{Storage::url($product->galleries->first()->photo)}}')
                                @else
                                    backgroun-color: #eee
                                @endif
                                "
                            ></div>
                        </div>
                        <div class="products-text">{{$product->name}}</div>
                        <div class="products-price">{{$product->price}}</div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Product Found.
                </div>
            @endforelse
          </div>
          <div class="row">
            <div class="col-12 mt-4">{{ $products->links() }}</div>
          </div>
        </div>
      </section>
    </div>
@endsection