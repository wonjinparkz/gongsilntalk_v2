<?php

namespace App\Http\Controllers\community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Magazine;
use App\Models\Notice;
use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| 커뮤니티 관리자
|--------------------------------------------------------------------------
|
| - 커뮤니티 목록 관리
|       - 커뮤니티 목록 보기 (O)
|       - 커뮤니티 상세 보기 (O)
|       - 댓글 보기 (O)
|       - 커뮤니티 상태 수정 (O)
|
*/

class CommunityPcController extends Controller
{

    public function communityListView(Request $request): View
    {
        $is_community = $request->community ?? 0;

        if ($is_community == 0) {
            $magazineList = Magazine::select()->withCount('replys')
            ->where('type', '=', $request->type ?? 0);

            // 정렬
            $magazineList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

            // 페이징
            $result = $magazineList->paginate($request->per_page == null ? 10 : $request->per_page);
        }else if($is_community == 1) {

        }


        $noticeList = Notice::select()->where('is_blind', '0')->get();

        return view('www.community.community_list', compact('result','noticeList'));
    }
}
