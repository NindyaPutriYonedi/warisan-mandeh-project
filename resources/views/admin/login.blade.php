@extends('layouts.app')

@section('content')

<div class="container py-5 d-flex justify-content-center align-items-center"
     style="min-height: 85vh; background: #F8F9FA;">

    <div class="text-center px-4 py-5"
         style="
            width: 420px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
         ">

        <div class="mx-auto mb-4"
             style="
                width: 60px;
                height: 6px;
                border-radius: 10px;
                background: #ff7a00;
             ">
        </div>

        {{-- Title --}}
        <h4 class="fw-semibold text-orange mb-4">
            Login
        </h4>

        {{-- Error --}}
        @if(session('error'))
            <div class="alert alert-danger small text-center mb-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.login.process') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text border-0"
                          style="background: rgba(244,162,97,0.15);">
                        <i class="bi bi-person text-orange"></i>
                    </span>
                    <input type="email"
                           name="email"
                           class="form-control border-0"
                           placeholder="Email"
                           style="background: rgba(244,162,97,0.15);"
                           required>
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text border-0"
                          style="background: rgba(244,162,97,0.15);">
                        <i class="bi bi-lock text-orange"></i>
                    </span>
                    <input type="password"
                           name="password"
                           class="form-control border-0"
                           placeholder="Password"
                           style="background: rgba(244,162,97,0.15);"
                           required>
                </div>
            </div>

            {{-- Button --}}
            <button class="btn w-100 py-2 fw-semibold"
                    style="
                        background: #ff7a00;
                        color: #ffffff;
                        border-radius: 14px;
                    ">
                Login
            </button>
        </form>

    </div>

</div>

@endsection
