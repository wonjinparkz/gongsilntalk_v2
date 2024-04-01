 <!-- nav : s -->
 <nav>
     <ul>
         <li>
             <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}" alt=""></span>홈</a>
         </li>
         <li>
             <a href="sales_list.html">
                 <span>
                     <img src="{{ asset('assets/media/mcnu_ic_2.png') }}" alt="">
                 </span>
                 분양현장
             </a>
         </li>
         <li>
             <a href="m_map.html">
                 <span>
                     <img src="{{ asset('assets/media/mcnu_ic_3.png') }}" alt="">
                 </span>
                 지도
             </a>
         </li>
         <li class=" {{ str_contains(Route::currentRouteName(), 'community') ? 'active' : '' }}">
             <a href="community_contents_list.html">
                 <span>
                     <img src="{{ asset('assets/media/mcnu_ic_5.png') }}" alt="">
                 </span>
                 커뮤니티
             </a>
         </li>
         <li>
             <a href="my_main.html">
                 <span>
                     <img src="{{ asset('assets/media/mcnu_ic_4.png') }}" alt="">
                 </span>
                 마이페이지
             </a>
         </li>
     </ul>
 </nav>
 <!-- nav : e -->
