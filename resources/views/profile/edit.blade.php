@extends('layouts.shop')

@section('title', 'Profile - ' . config('app.name'))

@section('content')
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Your <span>Profile</span></h2>
    </div>

    <div class="max-w-2xl mx-auto space-y-6">
        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</section>
@endsection