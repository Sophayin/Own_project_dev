<section class="flex-column align-items-center justify-content-center py-4">
    <div class="container pt-2">
        <div class="container card mt-5 " style="width: 80%;">
            <div class=" p-3 row d-flex">
                <div class="col-lg-5">
                    <div class="container">
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <img src="{{asset('assets/svg/ciclelogo121.jpg')}}" alt="Phsar121" width="140px" height="140px" style="border: 1px solid Lightgray; border-radius: 50%;">
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-4">
                            <h3 class="mt-3">Login</h3>
                        </div>
                        <div class="row mb-5">
                            @if($msgInvalidCredential)
                            <div class="alert border-danger alert-dismissible fade show" id="msgMessage">
                                {{$msgInvalidCredential}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form class="row g-3 needs-validation" wire:submit.prevent="doLogin">
                                <div class="col-12" style="margin-top: -5px;">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" wire:model="username" style="border-radius: 50px;">
                                    @error("username")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" wire:model="password" style="border-radius: 50px;">
                                    @error("password")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="remember_me" value="true" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <button class="btn btn-primary w-100" type="submit" style="border: none; border-radius: 50px; background: #034C72;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12 d-none d-sm-block">
                            <img src="{{asset('assets/svg/login.jpg')}}" alt="Phsar121" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>