@extends('layouts.auth')

@section('content')

    <div class="page-content page-auth" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center row-login">
            <div class="col-lg-4">
              <h2>
                Memulai untuk jual beli <br />
                dengan cara terbaru
              </h2>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label>Full Name</label>
                  <input type="text"
                    id="name"
                    v-model="name"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{old('name')}}"
                    required
                    autocomplete="name"
                    autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email"
                    id="email"
                    v-model="email"
                    @change="checkForEmailAvailability()"
                    class="form-control @error('email') is-invalid @enderror"
                    :class="{'is-invalid' : this.email_unavailable}"
                    name="email" value="{{old('email')}}"
                    required
                    autocomplete="email">
                    @error('email')
                      <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required
                    autocomplete="new-password" />
                  @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    required
                    autocomplete="new-password" />
                  @error('password_confirmation')
                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Store</label>
                  <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="is_store_open"
                      id="openStoreTrue"
                      v-model="is_store_open"
                      :value="true"
                    />
                    <label for="openStoreTrue" class="custom-control-label"
                      >Iya, boleh</label
                    >
                  </div>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="is_store_open"
                      id="openStoreFalse"
                      v-model="is_store_open"
                      :value="false"
                    />
                    <label for="openStoreFalse" class="custom-control-label"
                      >Tidak, terimakasih</label
                    >
                  </div>
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>Nama Toko</label>
                  <input type="text"
                    v-model="store_name"
                    id="store_name"
                    class="form-control @error('store_name') is-invalid @enderror"
                    name="store_name"
                    required
                    autocomplete
                    autofocus>
                    @error('store_name')
                      <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>Kategori</label>
                  <select name="category" class="form-control">
                    <option value="" disabled>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>

                <button
                  type="submit"
                  class="btn btn-success btn-block mt-4"
                  :disabled="this.email_unavailable"
                >
                  Sign Up Now
                </button>
                <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                  Back to Sign In
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
        //   this.$toasted.error("Maaf, email sudah terdaftar.", {
        //     position: "top-center",
        //     className: "rounded",
        //     duration: 1000,
        //   });
        },
        methods: {
          checkForEmailAvailability: function() {
            var self = this;

            axios.get('{{route('api-register-check')}}', {
                params: {
                  email: this.email
                }
              })
              .then(function (response) {
                // handle success
                if(response.data == 'Available') {
                  self.$toasted.error(
                    "Email tersedia.", {
                      position: "top-center",
                      className: "rounded",
                      duration: 1000,
                    }
                  )
                  self.email_unavailable = false;
                } else {
                  self.$toasted.error(
                    "Email sudah terdaftar.", {
                      position: "top-center",
                      className: "rounded",
                      duration: 1000,
                    }
                  )
                  self.email_unavailable = true;
                }
              })
          }
        },
        data() {
          return {
            name: "Yoedi Arianto",
            email: "emailtest@gmail.com",
            password: "",
            is_store_open: true,
            store_name: "",
            email_unavailable: false
          }
        },
      });
    </script>
@endpush


