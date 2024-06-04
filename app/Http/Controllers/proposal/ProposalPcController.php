<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\CorpProduct;
use App\Models\CorpProposal;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| 관리자 - 매물 제안서
|--------------------------------------------------------------------------
|
| - 매물 제안서 목록 보기 (ㅁ)
| - 매물 제안서 상세 화면 보기 (ㅁ)
|
*/


class ProposalPcController extends Controller
{

    /**
     * 중개사 기업이전 제안서
     */
    public function corpProposalCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'corp_name' => 'required',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('www.mypage.corp.proposal.list.view'))
                ->withErrors($validator)
                ->withInput();
        }

        $result = CorpProposal::create([
            'users_id' => Auth::guard('web')->user()->id,
            'corp_name' => $request->corp_name,
            'position' => $request->position,
            'is_delete' => 0
        ]);

        return Redirect::route('www.mypage.corp.proposal.list.view')->with('message', '기업 이전 제안서를 등록했습니다.');
    }

    /**
     * 기업 이전 제안서 매물 리스트
     */
    public function corpProposalProductListView($id): View
    {

        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();


        $proposal = CorpProposal::with('products')->select()->where('id', $id)->where('users_id', Auth::guard('web')->user()->id)->first();

        if (!isset($proposal)) {
            return redirect(route('www.mypage.corp.proposal.list.view'))
                ->withErrors('해당 기업 이전 제안서를 찾을 수 없습니다.')
                ->withInput();
        }

        return view('www.proposal.corpProposalProduct_list', compact('user', 'proposal'));
    }

    /**
     * 중개사 기업 이름 변경
     */
    public function corpProposalNameUpdate(Request $request): RedirectResponse
    {
        $result = CorpProposal::where('id', $request->corp_id)->update([
            'corp_name' => $request->corp_name
        ]);

        return Redirect::back()->with('message', '기업명을 수정했습니다.');
    }

    /**
     * 기업 이전 제안서 등록 화면
     */
    public function corpProposalProductCreateView($id): View
    {
        $corp_proposal_id = $id;
        return view('www.proposal.corpProduct_create', compact('corp_proposal_id'));
    }

    /**
     * 기업 이전 제안서 등록 화면
     */
    public function corpProposalProductCreate2View(Request $request): View
    {
        Log::info($request->all());

        $result = $request->all();

        return view('www.proposal.corpProduct_create2', compact('result'));
    }

    /**
     * 기업 이전 제안서 등록 체크
     */
    public function corpProposalProductCreateTypeCheck(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.product.create.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.corp.proposal.product.create2.view', compact('request'));
    }

    /**
     * 기업 이전 제안서 등록 체크
     */
    public function corpProposalProductCreatePriceCheck(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.product.create.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.corp.proposal.product.create2.view', compact('request'));
    }


    /**
     * 기업 이전 제안서 타입
     */
    public function corpProposalTypeDetailView(Request $request): View
    {
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();


        return view('www.proposal.proposal-type', compact('user'));
    }
}
