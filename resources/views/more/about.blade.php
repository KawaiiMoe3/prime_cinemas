@extends('layouts.index')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/more.css') }}">
@endsection

@section('title', 'About Us | PrimeCinemas')

@section('content')
<div class="container about-container">
    <div class="about-content">
        <h1>Our Cinema Story</h1>
        
        <p>At PrimeCinemas, we're redefining movie magic. Since 2010, we've grown from a single-screen theater to Malaysia's most innovative cinema chain, blending cutting-edge technology with unforgettable experiences.</p>
        
        <div class="about-card">
            <h3>Why Movie Lovers Choose Us</h3>
            <ul class="custom-list">
                <li>Crystal-clear 4K laser projection with Dolby Vision</li>
                <li>Immersive Dolby Atmos sound systems</li>
                <li>Luxury recliners with premium legroom</li>
                <li>Advanced online booking with seat selection</li>
                <li>Diverse programming from blockbusters to arthouse</li>
            </ul>
        </div>
        
        <h3>Our Vision</h3>
        <p>We believe cinema should be more than just watching - it should be an event. Our theaters are designed as social spaces where film lovers can gather, discuss, and celebrate storytelling.</p>
        
        <div class="about-card">
            <h3>Community Roots</h3>
            <p>We're proud to support Malaysian filmmakers through our Young Talent program, host free educational screenings for schools, and maintain eco-friendly operations with solar-powered locations.</p>
        </div>
        
        <h3>Meet the Team</h3>
        <p>Our passionate crew makes the magic happen every day:</p>
        
        <div class="about-team">
            <div class="team-member">
                <h4>Tan Jun Sam</h4>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <h4>Wong Kien Haw</h4>
                <p>Director of Operations</p>
            </div>
            <div class="team-member">
                <h4>Tang Weng Yee</h4>
                <p>Chief Technology Officer</p>
            </div>
            <div class="team-member">
                <h4>Tan Zhen Zhong</h4>
                <p>Customer Experience Manager</p>
            </div>
        </div>
    </div>
</div>
@endsection