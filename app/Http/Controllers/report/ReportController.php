<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\CommunityReport;
use App\Models\ReplyReport;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * 커뮤니티 글 신고 목록 보기
     */
    public function communityReportListView(Request $request): View
    {
        $reportList = CommunityReport::with('community')
            ->select(
                'community_report.*',
                'users.nickname as author_nickname',
                'users.type as author_type'
            );

        // 신고한 회원 닉네임
        if (isset($request->author_nickname)) {
            $reportList->where('users.nickname', 'like', "%{$request->author_nickname}%");
        }

        // 작성자의 조건 추가
        if (isset($request->report_nickname)) {
            $report_nickname = $request->report_nickname;
            $reportList->whereHas('community.users', function ($query) use ($report_nickname) {
                $query->where('users.nickname', 'like', "%{$report_nickname}%");
            });
        }

        // 작성자 타입
        if ($request->has('report_type') && $request->report_type > -1) {
            $reportList->where('community_report.type', '=', "$request->report_type");
        }

        // 신고일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $reportList->DurationDate('community_report.created_at', $request->from_created_at, $request->to_created_at);
        }


        // 작성자
        $reportList->join('users', 'community_report.users_id', '=', 'users.id');

        // 정렬
        $reportList->orderBy('community_report.created_at', 'desc')->orderBy('id', 'desc');

        $result = $reportList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.report.community_report-list', compact('result'));
    }

    /**
     * 커뮤니티 글 신고 목록 보기
     */
    public function replyReportListView(Request $request): View
    {
        $reportList = ReplyReport::with('reply')
            ->select(
                'reply_report.*',
                'users.nickname as author_nickname',
                'users.type as author_type'
            );

        // 신고한 회원 닉네임
        if (isset($request->author_nickname)) {
            $reportList->where('users.nickname', 'like', "%{$request->author_nickname}%");
        }

        // 작성자의 조건 추가
        if (isset($request->report_nickname)) {
            $report_nickname = $request->report_nickname;
            $reportList->whereHas('reply.users', function ($query) use ($report_nickname) {
                $query->where('users.nickname', 'like', "%{$report_nickname}%");
            });
        }

        // 작성자 타입
        if ($request->has('report_type') && $request->report_type > -1) {
            $reportList->where('reply_report.type', '=', "$request->report_type");
        }

        // 신고일 from ~ to
        if (isset($request->from_created_at) && isset($request->to_created_at)) {
            $reportList->DurationDate('reply_report.created_at', $request->from_created_at, $request->to_created_at);
        }


        // 작성자
        $reportList->join('users', 'reply_report.users_id', '=', 'users.id');

        // 정렬
        $reportList->orderBy('reply_report.created_at', 'desc')->orderBy('id', 'desc');

        $result = $reportList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result->appends(request()->except('page'));

        return view('admin.report.reply_report-list', compact('result'));
    }
}
