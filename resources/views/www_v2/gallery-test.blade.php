@extends('layouts.staging')

@section('title', '갤러리 테스트 - 공실앤톡')

@section('content')
<div class="gallery-test-page">
    <div style="padding: 40px 0;">
        <h1 style="text-align: center; margin-bottom: 40px;">평수별 인테리어 갤러리</h1>
        
        {{-- Tab Gallery Component --}}
        <x-v2.gallery.tab-gallery />
    </div>
</div>
@endsection