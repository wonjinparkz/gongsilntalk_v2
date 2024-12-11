<?php

namespace App\Http\Controllers\proposal;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\CorpProduct;
use App\Models\CorpProductAddress;
use App\Models\CorpProductFacility;
use App\Models\CorpProductPrice;
use App\Models\CorpProposal;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\ProposalProduct;
use App\Models\ProposalRegion;
use App\Models\User;
use App\Models\Zcode;
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
| - 매물 제안서 목록 보기 (ㅇ)
| - 매물 제안서 상세 화면 보기 (ㅇ)
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

        $corpInfo = CorpProposal::select()->where('id', $id)->where('users_id', Auth::guard('web')->user()->id)->first();
        $proposal = CorpProductAddress::select()->where('corp_proposal_id', $id)->where('users_id', Auth::guard('web')->user()->id)->get();

        if (!isset($proposal)) {
            return redirect(route('www.mypage.corp.proposal.list.view'))
                ->withErrors('해당 기업 이전 제안서를 찾을 수 없습니다.')
                ->withInput();
        }

        return view('www.proposal.corpProposalProduct_list', compact('user', 'proposal', 'corpInfo'));
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

        $address_id = 0;

        $address_city = explode(' ', $request->address);
        $address_city = $address_city[0] . ' ' . $address_city[1];

        $addressList = CorpProductAddress::select()
            ->where('city', $address_city)
            ->where('users_id',  Auth::guard('web')->user()->id)
            ->where('corp_proposal_id', $request->corp_proposal_id)->first();

        if (!isset($addressList)) {
            $address = CorpProductAddress::create([
                'users_id' =>  Auth::guard('web')->user()->id,
                'corp_proposal_id' =>  $request->corp_proposal_id,
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
            'is_map' => $request->is_map ?? 0,
            'address' => $request->address,
            'address_detail' => $request->address_detail,
            'product_name' => $request->product_name,
            'exclusive_area' => $request->exclusive_area,
            'exclusive_square' => $request->exclusive_square,
            'floor_number' => $request->floor_number,
            'total_floor_number' => $request->total_floor_number,
            'move_type' => $request->move_type,
            'move_date' => $request->move_date,
            'is_service' => isset($request->is_service) ? $request->is_service : 0,
            'service_price' => str_replace(',', '', $request->service_price) ?: null,
            'cooling_type' => $request->heating_type,
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
            'price' => str_replace(',', '', $request->{'price_' . $request->payment_type}) ?: null,
            'month_price' => str_replace(',', '', $request->{'month_price_' . $request->payment_type}) ?: null,
            'premium_price' => str_replace(',', '', $request->premium_price) ?: null,
            'acquisition_tax' => $request->acquisition_tax,
            'support_price' => str_replace(',', '', $request->support_price) ?: null,
            'etc_price' => str_replace(',', '', $request->etc_price) ?: null,
            'loan_rate_one' => $request->loan_rate_one,
            'loan_rate_two' => $request->loan_rate_two,
            'loan_interest' => $request->loan_interest,
            'is_invest' => isset($request->is_invest) ? $request->is_invest : 0,
            'invest_price' => str_replace(',', '', $request->invest_price) ?: null,
            'invest_month_price' => str_replace(',', '', $request->invest_month_price) ?: null
        ]);

        $this->imageTypeWithCreate($request->product_image_ids, CorpProduct::class, $result->id, 0);
        $this->imageTypeWithCreate($request->product_detail_image_ids, CorpProduct::class, $result->id, 1);

        return Redirect::route('www.mypage.corp.proposalproduct.list.view', [$request->corp_proposal_id]);
    }

    /**
     * 기업 이전 제안서 타입
     */
    public function corpProposalTypeDetailView($id): View
    {
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $corpInfo = CorpProposal::select()->where('id', $id)->where('users_id', Auth::guard('web')->user()->id)->first();
        $address = CorpProductAddress::select()->where('corp_proposal_id', $id)->where('users_id', Auth::guard('web')->user()->id)->orderBy('id', 'asc')->get();

        $products = CorpProduct::select()->where('corp_proposal_id', $id)->orderBy('corp_product_address_id', 'asc')->get();

        return view('www.proposal.proposal-type', compact('user', 'address', 'corpInfo', 'products'));
    }

    /**
     * 기업 이전 제안서 개별 삭제
     */
    public function corpProposalDelete(Request $request): RedirectResponse
    {
        $result = CorpProduct::select()->where('id', $request->delete_id)->first();

        $addressCount = CorpProduct::select()->where('corp_product_address_id', $result->corp_product_address_id)->count();

        if ($addressCount < 2) {
            CorpProductAddress::select()->where('id', $result->corp_product_address_id)->delete();
        }

        CorpProductPrice::select()->where('corp_product_id', $request->delete_id)->delete();
        CorpProductFacility::select()->where('corp_product_id', $request->delete_id)->delete();

        $result->delete();

        return Redirect::back();
    }

    // 기업 이전 제안서 매물 수정
    public function corpProposalProductUpdateView($id): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $product = CorpProduct::select()->where('id', $id)->first();

        return view('www.proposal.corpProduct_update', compact('user', 'product'));
    }

    /**
     * 기업 이전 제안서 등록
     */
    public function corpProposalProductUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return redirect(route('www.corp.proposal.product.update.view', $request->id))
                ->withErrors($validator)
                ->withInput();
        }

        $address_id = 0;

        $address_city = explode(' ', $request->address);
        $address_city = $address_city[0] . ' ' . $address_city[1];

        $addressList = CorpProductAddress::select()
            ->where('city', $address_city)
            ->where('users_id',  Auth::guard('web')->user()->id)
            ->where('corp_proposal_id', $request->corp_proposal_id)->first();

        if (!isset($addressList)) {
            $address = CorpProductAddress::create([
                'users_id' =>  Auth::guard('web')->user()->id,
                'corp_proposal_id' =>  $request->corp_proposal_id,
                'city' => $address_city
            ]);

            $address_id = $address->id;
        } else {
            $address_id = $addressList->id;
        }

        // DB 추가
        $productDate = [
            'corp_proposal_id' => $request->corp_proposal_id,
            'corp_product_address_id' => $address_id,
            'product_type' => $request->product_type,
            'type' => $request->type,
            'address_lat' => isset($request->address_lat) ? $request->address_lat : 0,
            'address_lng' => isset($request->address_lng) ? $request->address_lng : 0,
            'is_map' => $request->is_map ?? 0,
            'address' => $request->address,
            'address_detail' => $request->address_detail,
            'product_name' => $request->product_name,
            'exclusive_area' => $request->exclusive_area,
            'exclusive_square' => $request->exclusive_square,
            'floor_number' => $request->floor_number,
            'total_floor_number' => $request->total_floor_number,
            'move_type' => $request->move_type,
            'move_date' => $request->move_date,
            'is_service' => isset($request->is_service) ? $request->is_service : 0,
            'service_price' => str_replace(',', '', $request->service_price) ?: null,
            'cooling_type' => $request->cooling_type,
            'heating_type' => $request->heating_type,
            'parking_count' => $request->parking_count,
            'product_content' => $request->product_content,
            'content' => $request->content,
            'is_delete' => 0
        ];
        $result = CorpProduct::where('id', $request->id)->update($productDate);

        CorpProductFacility::where('corp_product_id', $request->id)->delete();
        CorpProductPrice::where('corp_product_id', $request->id)->delete();

        if (count($request->option) > 0) {
            foreach ($request->option as $option) {
                CorpProductFacility::create([
                    'corp_product_id' => $request->id,
                    'type' => $option
                ]);
            }
        }

        CorpProductPrice::create([
            'corp_product_id' => $request->id,
            'payment_type' => $request->payment_type,
            'price' => str_replace(',', '', $request->{'price_' . $request->payment_type}) ?: null,
            'month_price' => str_replace(',', '', $request->{'month_price_' . $request->payment_type}) ?: null,
            'premium_price' => str_replace(',', '', $request->premium_price) ?: null,
            'acquisition_tax' => $request->acquisition_tax,
            'support_price' => str_replace(',', '', $request->support_price) ?: null,
            'etc_price' => str_replace(',', '', $request->etc_price) ?: null,
            'loan_rate_one' => $request->loan_rate_one,
            'loan_rate_two' => $request->loan_rate_two,
            'loan_interest' => $request->loan_interest,
            'is_invest' => isset($request->is_invest) ? $request->is_invest : 0,
            'invest_price' => str_replace(',', '', $request->invest_price) ?: null,
            'invest_month_price' => str_replace(',', '', $request->invest_month_price) ?: null
        ]);

        $this->imageTypeWithEdit($request->product_image_ids, CorpProduct::class, $request->id, 0);
        $this->imageTypeWithEdit($request->product_detail_image_ids, CorpProduct::class, $request->id, 1);

        return Redirect::route('www.mypage.corp.proposalproduct.list.view', [$request->corp_proposal_id])->with('message', "건물이 수정 되었습니다.");
    }



    /** ------------------------- 사용자 ------------------------- */


    /**
     * 매물 제안서 등록 1
     */
    public function userProposalCreateFirst(Request $request)
    {
        $zcodeList = Zcode::select()->get();

        if ($request->ajax()) {

            $zcodeList = Zcode::select();

            if ($request->zone != '') {
                $zcodeList->where('zone', 'like', "%{$request->zone}%");
            }

            $zcodeList = $zcodeList->get();
            return response()->json(['zcodeList' => $zcodeList]);
        }

        return view('www.proposal.user-offer-first', compact('request', 'zcodeList'));
    }

    /**
     * 매물 제안서 등록 2
     */
    public function userProposalCreateSecond(Request $request): View
    {
        return view('www.proposal.user-offer-second', compact('request'));
    }

    /**
     * 매물 제안서 등록 3
     */
    public function userProposalCreateThird(Request $request): View
    {
        return view('www.proposal.user-offer-third', compact('request'));
    }

    /**
     * 메물 제안서 등록
     */
    public function userProposalCreate(Request $request)
    {
        $title = ($request->type == 0 ? $request->client_name_0 : $request->client_name_1) . ($request->type == 0 ? ' 상가' : ($request->type == 1 ? ' 지산/사무실/창고' : ' 단독공장')) . ' 제안서';

        $proposal = Proposal::create([
            'users_id' => Auth::guard('web')->user()->id,
            'title' => $title,
            'type' => $request->type,
            'area' => $request->area,
            'square' => $request->square,
            'business_type' => $request->type == 0 ? $request->business_type : null,
            'move_type' => $request->day,
            'users_count' => $request->users_count ?? 0,
            'start_move_date' => $request->start_move_date,
            'ended_move_date' => $request->ended_move_date,
            'payment_type' => $request->budget_type,
            'price' => str_replace(',', '', $request->{'price_' . $request->budget_type}),
            'month_price' => str_replace(',', '', $request->month_price) ?: null,
            'client_name' => $request->type == 0 ? $request->client_name_0 : $request->client_name_1,
            'client_type' => $request->client_type,
            'floor_type' => $request->floor,
            'interior_type' => $request->interior,
            'content' => $request->content ?? '',
            'is_delete' => 0
        ]);

        foreach ($request->region_zone as $key => $region) {
            $regionArr = explode(' ', $region);
            ProposalRegion::create([
                'proposal_id' => $proposal->id,
                'region_code' => $request->region_code[$key],
                'city_name' => $regionArr[0],
                'region_name' => $regionArr[1] . (isset($regionArr[2]) ? ' ' . $regionArr[2] : ''),
            ]);
        }

        $sameIdArray = [];

        $sameList = Product::select('product.id as product_id')
            ->leftjoin('product_price', 'product_price.product_id', 'product.id')
            ->where('product.is_blind', 0)
            ->where('product.is_delete', 0)
            ->where('product.state', 1)
            ->where(function ($query) use ($request) {
                foreach ($request->region_zone as $key => $region) {
                    if ($key == 0) {
                        $query->where('product.region_address', 'like', "%{$region}%");
                    }
                    $query->orWhere('product.region_address', 'like', "%{$region}%");
                }
            })
            ->whereBetween('product.exclusive_area', [
                $request->area - 5,  // 평수 값의 -5
                $request->area + 10  // 평수 값의 +10
            ]);


        if ($proposal->type == 0) {
            $sameList->where('product.type', '=', 3);
        } else if ($proposal->type == 1) {
            $sameList->whereIn('product.type', [0, 1, 2]);
        } else if ($proposal->type == 2) {
            $sameList->where('product.type', '=', 7);
        }

        // 매매일 경우 매매가 검색
        if ($proposal->payment_type == 0) {
            $sameList->where('product_price.payment_type', 0)->whereBetween('product_price.price', [
                $proposal->price * 0.7,  // 가격의 -30%
                $proposal->price * 1.3   // 가격의 +30%
            ]);
        }

        // 임대 또는 월세일 경우 월임대료 검색
        if ($proposal->payment_type == 1) {
            $sameList->whereIn('product_price.payment_type', [1, 2, 4])->whereBetween('product_price.month_price', [
                $proposal->month_price * 0.7,  // 가격의 -30%
                $proposal->month_price * 1.3   // 가격의 +30%
            ]);
        }


        $sameList = $sameList->get();

        // 수정
        foreach ($sameList as $same) {
            ProposalProduct::create([
                'proposal_id' => $proposal->id,
                'product_id' => $same->product_id
            ]);

            array_push($sameIdArray, $same->id);
        }

        // $tempList = Product::select('product.id as product_id')
        //     ->leftjoin('product_price', 'product_price.product_id', 'product.id')
        //     ->where(function ($query) use ($request) {
        //         foreach ($request->region_zone as $key => $region) {
        //             if ($key == 0) {
        //                 $query->where('product.region_address', 'like', "%{$region}%");
        //             }
        //             $query->orWhere('product.region_address', 'like', "%{$region}%");
        //         }
        //     })
        //     ->whereNotIn('product.id', $sameIdArray)
        //     ->get();

        // foreach ($tempList as $temp) {
        //     ProposalProduct::create([
        //         'proposal_id' => $proposal->id,
        //         'product_id' => $temp->product_id
        //     ]);
        // }

        $user = User::select()->where('id', Auth::guard('web')->user()->id)->first();

        $this->kakaoSend('118', $user->name, $user->phone);

        return Redirect::route('www.mypage.proposal.list.view')->with('message', '제안서가 등록 되었습니다.');
    }

    /**
     * 메물 제안서 삭제
     */
    public function userProposalDelete(Request $request)
    {

        $proposal = Proposal::select()->where('id', $request->deleteId)->first();

        ProposalRegion::select()->where('proposal_id', $request->deleteId)->delete();
        ProposalProduct::select()->where('proposal_id', $request->deleteId)->delete();

        $proposal->delete();

        return Redirect::back()->with('message', '제안서가 삭제 되었습니다.');
    }

    /**
     * 메물 투어 요청
     */
    public function userProposalTourCreate(Request $request)
    {

        $product = Product::select()->where('id', $request->tour_id)->first();

        $user = User::select()->where('id', $product->users_id)->first();


        if ($product->user_type == 1) {
            // 투어 요청 알림 추후 수정 필요
            Alarms::create([
                'users_id' => $product->users_id,
                'index' => 0,
                'title' => '투어 요청 안내',
                'body' => '매물번호 ' . $product->product_number . ', ' . $user->name . ', ' . $user->phone,
                'msg' => 'msg',
                'product_id' => $product->id,
                'tour_users_id' => Auth::guard('web')->user()->id,
            ]);

            $androidTokens = [];
            $iosTokens = [];

            $data = [
                'title' => '투어 요청 안내',
                'body' => '매물번호 ' . $product->product_number . ', ' . $user->name . ', ' . $user->phone,
                'index' => intval(0),
            ];

            if ($user->state == "0") {
                if ($user->device_type == "1") {
                    array_push($androidTokens, $user->fcm_key);
                } else if ($user->device_type == "2") {
                    array_push($iosTokens, $user->fcm_key);
                }
            }

            $this->sendAlarm($iosTokens, $androidTokens, $data);
        }

        return Redirect::back()->with('message', '투어가 요청 되었습니다.');
    }

    /**
     * 매물 제안서 상세
     */
    public function userProposalDetailView($id): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $proposal = Proposal::with('regions', 'products')->select()->where('id', $id)->where('users_id', Auth::guard('web')->user()->id)->first();

        return view('www.proposal.my-proposal-offer-list', compact('user', 'proposal'));
    }
}
