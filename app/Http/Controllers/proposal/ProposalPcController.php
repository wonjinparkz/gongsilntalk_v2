<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\CorpProduct;
use App\Models\CorpProductAddress;
use App\Models\CorpProductFacility;
use App\Models\CorpProductPrice;
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

        info($request);
        return view('www.proposal.corpProduct_create2', compact('request'));
    }

    /**
     * 기업 이전 제안서 등록 화면
     */
    public function corpProposalProductCreate3View(Request $request): View
    {
        return view('www.proposal.corpProduct_create3', compact('request'));
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
            return redirect(route('www.product.create2.view'))->withErrors($validator)
                ->withInput();
        }

        return Redirect::route('www.corp.proposal.product.create3.view', compact('request'));
    }

    /**
     * 기업 이전 제안서 등록
     */
    public function corpProposalProductCreate(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.corp.proposal.product.create3.view'))->withErrors($validator)
                ->withInput();
        }

        info($request);

        $address_id = 0;

        $address_city = explode(' ', $request->address);
        $address_city = $address_city[0].' '.$address_city[1];

        $addressList = CorpProductAddress::select()->where('city', $address_city)->where('users_id',  Auth::guard('web')->user()->id)->first();

        if (!isset($addressList)) {
            $address = CorpProductAddress::create([
                'users_id' =>  Auth::guard('web')->user()->id,
                'city' => $address_city
            ]);

            $address_id = $address->id;
        } else {
            $address_id = $addressList->id;
        }

        // DB 추가
        $result = CorpProduct::create([
            'corp_proposal_id' => $request->corp_proposal_id,
            'corp_product_address_id' => $address_id,
            'product_type' => $request->product_type,
            'type' => $request->type,
            'address_lat' => isset($request->address_lat) ? $request->address_lat : 0,
            'address_lng' => isset($request->address_lng) ? $request->address_lng : 0,
            'address' => $request->address,
            'address_detail' => isset($request->address_detail) ? $request->address_detail :  $request->product_name,
            'product_name' => $request->product_name,
            'exclusive_area' => $request->exclusive_area,
            'exclusive_square' => $request->exclusive_square,
            'floor_number' => $request->floor_number,
            'total_floor_number' => $request->total_floor_number,
            'move_type' => $request->move_type,
            'move_date' => $request->move_date,
            'is_service' => isset($request->is_service) ? $request->is_service : 0,
            'service_price' => $request->service_price,
            'heating_type' => $request->heating_type,
            'parking_count' => $request->parking_count,
            'product_content' => $request->product_content,
            'content' => $request->content,
            'is_delete' => 0
        ]);

        if (count($request->option) > 0) {
            foreach ($request->option as $option) {
                CorpProductFacility::create([
                    'corp_product_id' => $result->id,
                    'type' => $option
                ]);
            }
        }

        CorpProductPrice::create([
            'corp_product_id' => $result->id,
            'payment_type' => $request->payment_type,
            'price' => $request->{'price_' . $request->payment_type},
            'month_price' => $request->{'month_price_' . $request->payment_type},
            'premium_price' => $request->premium_price,
            'acquisition_tax' => $request->acquisition_tax,
            'support_price' => $request->support_price,
            'etc_price' => $request->etc_price,
            'loan_rate_one' => $request->loan_rate_one,
            'loan_rate_two' => $request->loan_rate_two,
            'loan_interest' => $request->loan_interest,
            'is_invest' => isset($request->is_invest) ? $request->is_invest : 0,
            'invest_price' => $request->invest_price,
            'invest_month_price' => $request->invest_month_price
        ]);

        $this->imageWithCreate($request->product_image_ids, CorpProduct::class, $result->id);

        return Redirect::route('www.mypage.corp.proposalproduct.list.view', [$request->corp_proposal_id]);
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
