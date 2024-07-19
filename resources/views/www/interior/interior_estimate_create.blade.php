<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">인테리어</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <form method="post" action="{{ route('www.interior.estimate.create') }}">
        <div class="body">

            <h1>인테리어</h1>
        </div>
    </form>
</x-layout>
