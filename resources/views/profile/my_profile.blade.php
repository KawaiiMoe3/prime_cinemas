@extends('layouts.index')

@section('title', 'My Profile | PrimeCinemas')

@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<script src="{{ asset('js/profile.js') }}"></script>

@section('content')
<div class="profile-container">
    <div class="profile-layout">

        <div class="profile-block profile-user__member">
            <div class="profile-user__member-details">
                <div class="profile-user__member-details-info">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="profile-logo">
                    <p class="card-number">Card No.: {{ $user->card_number ?? 'N/A' }}</p>
                </div>
                <div class="profile-user__qrcode">
                    {!! QrCode::size(150)->generate($user->card_number) !!}
                </div>
            </div>
            <hr class="profile-divider">
            <p class="profile-instruction">Present this code at the counter to collect and redeem more MovieMoney!</p>
            <a href="{{ route('profile.my_orders') }}" class="btn-profile">MY ORDERS</a>
        </div>

        <div class="profile-user__detail">
            <div class="profile-user__greeting">
                <i class="fa-solid fa-user profile-icon"></i>
                <span id="greeting-username">Hi, {{ $user->username ?? 'Guest' }}</span>
            </div>
            <!-- Contact Info Block -->
            <div id="contact-info" class="profile-block">
                <div class="profile-block__title">Contact Info</div>
                <div class="profile-block__description">Update your contact details for account recovery and notifications.</div>
                <hr>
                <div class="profile-contact">
                    <div class="profile-contact__block">
                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">MOBILE NO.</div>
                                <div class="profile-contact__block-content-value">{{ $user->phone ?? 'N/A' }}</div>
                            </div>
                            <button id="updateMobileBtn" class="btn-update">Update</button>
                        </div>
                    </div>
                    <div class="profile-contact__block">
                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">EMAIL</div>
                                <div class="profile-contact__block-content-value">{{ $user->email ?? 'N/A' }}</div>
                            </div>
                            <a href="#" id="updateEmailBtn" class="btn-update">Update</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Info Block -->
            <div id="profile-info" class="profile-block">
                <div class="profile-block__header">
                    <div class="profile-block__title">Profile Info</div>
                    <div class="profile-block__actions">
                        <a href="#" class="profile-block__header-btn edit-btn">Edit</a>
                        <button class="profile-block__header-btn cancel-btn d-none" id="cancel-btn">Cancel</button>
                        <button class="save-btn d-none" id="save-btn">Save</button>
                    </div>
                </div>
                <hr>
                <div class="profile-contact profile-edit-section">
                    <div class="profile-contact__block">
                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">NAME</div>
                                <div class="profile-contact__block-content-value" id="name-value">{{ $user->username ?? 'N/A' }}</div>
                                <input type="text" class="profile-input profile-edit-field d-none" id="name-input" value="{{ $user->username ?? '' }}">
                            </div>
                        </div>

                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">STATE</div>
                                <div class="profile-contact__block-content-value" id="state-value" data-selected="{{ $user->state }}">{{ $user->state ?? 'N/A' }}</div>
                                <select class="profile-input profile-edit-field d-none" id="state-input" onchange="updateDistrictOptions()"></select>
                            </div>
                        </div>

                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">DISTRICT</div>
                                <div class="profile-contact__block-content-value" id="district-value" data-selected="{{ $user->district }}">{{ $user->district ?? 'N/A' }}</div>
                                <select class="profile-input profile-edit-field d-none" id="district-input">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="profile-contact__block">
                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">DATE OF BIRTH</div>
                                <div class="profile-contact__block-content-value" id="dob-value" data-value="{{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') ?? 'N/A' }}">
                                    {{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') ?? 'N/A' }}
                                </div>
                                <input type="date" class="profile-input profile-edit-field d-none" id="dob-input" value="{{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') ?? '' }}">
                            </div>
                        </div>
                        <div class="profile-contact__block-content">
                            <div>
                                <div class="profile-contact__block-content-label">GENDER</div>
                                <div class="profile-contact__block-content-value" id="gender-value">{{ $user->gender ?? 'N/A' }}</div>
                                <div class="gender-buttons profile-edit-gender-field d-none" id="gender-input">
                                    <button type="button" class="gender-btn" data-gender="Male">Male</button>
                                    <button type="button" class="gender-btn" data-gender="Female">Female</button>
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
