@extends('layouts.app')

@section('title', 'Dashboard - AHASS')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid animate-fadeIn">
    <div class="stats-card">
        <div class="icon"><i class="fas fa-users"></i></div>
        <h5>Total Pelanggan</h5>
        <div class="stats-number">{{ $total_pelanggan }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-motorcycle"></i></div>
        <h5>Total Motor</h5>
        <div class="stats-number">{{ $total_motor }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-box"></i></div>
        <h5>Total Item</h5>
        <div class="stats-number">{{ $total_item }}</div>
    </div>
    
    <div class="stats-card">
        <div class="icon"><i class="fas fa-receipt"></i></div>
        <h5>Total Transaksi</h5>
        <div class="stats-number">{{ $total_transaksi }}</div>
    </div>
</div>
@endsection
