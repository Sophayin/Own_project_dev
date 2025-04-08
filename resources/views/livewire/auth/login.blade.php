<section class="flex-column align-items-center justify-content-center py-4">
    <div class="container pt-2">
        <div class="container card-body mt-5 " style="width: 80%;">
            <div class=" p-3 row d-flex">
                <div class="col-lg-12 d-flex text-center justify-content-center">
                    <div class="row text-center d-flex justify-content-center">
                        <div class="col-lg-3 col-md-3 col-sm-12 w-50 justify-content-center">
                            <div class="col-12 d-flex justify-content-center mt-5">
                                <img src="{{asset('assets/auth/image.png')}}" alt="" width="740px" height="140px"
                                    style="border: 1px solid Lightgray;">
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-4">
                                <h3 class="mt-3">Welcome To Expense</h3>
                            </div>
                            <div class="row mb-5">
                                @if($msgInvalidCredential)
                                <div class="alert border-danger alert-dismissible fade show" id="msgMessage">
                                    {{$msgInvalidCredential}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                                <form class="row g-3 needs-validation" wire:submit.prevent="doLogin">
                                    <div class="col-12" style="margin-top: -5px;">
                                        <input type="text" class="form-control custom-input @error('username') is-invalid @enderror"
                                            placeholder="Username" wire:model="username" style="border-radius: 50px;">
                                        @error("username")
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <input type="password"
                                            class="form-control custom-input @error('password') is-invalid @enderror"
                                            placeholder="Password" wire:model="password" style="border-radius: 50px;">
                                        @error("password")
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="remember_me"
                                                value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <button class="btn btn-primary w-100 btn_login" type="submit"
                                            style="border: none; border-radius: 50px !important;">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>