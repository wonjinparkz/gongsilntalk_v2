<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetAddress;
use App\Models\CalculatorRevenue;
use App\Models\Community;
use App\Models\Product;
use App\Models\SiteProduct;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserPcController extends Controller
{
    /**
     * 내 매물 관리
     */
    public function mypageMainView(Request $request): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $productList = Product::select();

        $productList->where('users.id', Auth::guard('web')->user()->id);

        // 정렬
        $productList->orderBy('product.created_at', 'desc')->orderBy('id', 'desc');

        $result_product = $productList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('www.mypage.productMagagement_list', compact('user', 'result_product'));
    }

    /**
     * 내 매물 관리
     */
    public function productMagagementListView(Request $request)
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $productList = Product::select();

        $productList->where('users_id', Auth::guard('web')->user()->id);

        // 정렬
        $productList->orderBy('product.created_at', 'desc')->orderBy('id', 'desc');

        $result_product = $productList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('www.mypage.productMagagement_list', compact('user', 'result_product'));
    }

    /**
     * 중개사 매물 관리
     */
    public function corpProductMagagementListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.corpProductMagagement_list', compact('user'));
    }

    /**
     * 관심매물
     */
    public function productInterestListView(Request $request)
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        if ($request->ajax()) {
            $type = $request->type ?? 0;

            if ($request->type != 1) {
                // 좋아요한 일반 매물
                $productList = Product::with('images', 'priceInfo')->select(
                    'product.*'
                );
                $productList->leftjoin('product_price', 'product_price.product_id', 'product.id');
                $productList->like('product', Auth::guard('web')->user()->id ?? "");
                $productList->where('like.id', '!=', null);

                // 매물 종류
                if (isset($request->product_type)) {
                    $productList->where('product.type', $request->product_type);
                }

                // 매매/전세/월세 등 여부
                if (isset($request->payment_type)) {
                    $productList->where('product_price.payment_type', $request->payment_type);
                }
                $result = $productList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc')->paginate(12);
            } else {
                // 좋아요한 분양 매물
                $siteProductList = SiteProduct::with('images')->select(
                    'site_product.*'
                );
                $siteProductList->like('site_product', Auth::guard('web')->user()->id ?? "");
                $siteProductList->where('like.id', '!=', null);

                $result = $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('site_product.id', 'desc')->paginate(12);
            }

            $view = view('components.user-mypage-interest-list-layout', compact('result', 'type'))->render();
            return response()->json(['html' => $view]);
        }

        return view('www.mypage.productInterest_list', compact('user'));
    }

    /**
     * 최근 본 매물
     */
    public function productRecentlyListView(Request $request)
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        if ($request->ajax()) {
            $type = $request->type ?? 0;

            if ($request->type != 1) {
                // 최근 본 일반 매물
                $productList = Product::with('images', 'priceInfo')->select(
                    'product.*'
                );
                $productList->leftjoin('product_price', 'product_price.product_id', 'product.id');
                $productList->like('product', Auth::guard('web')->user()->id ?? "");
                $productList->recentProduct('product', Auth::guard('web')->user()->id ?? "");
                $productList->where('recent_product.id', '!=', null);

                // 매물 종류
                if (isset($request->product_type)) {
                    $productList->where('product.type', $request->product_type);
                }

                // 매매/전세/월세 등 여부
                if (isset($request->payment_type)) {
                    $productList->where('product_price.payment_type', $request->payment_type);
                }
                $result = $productList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc')->paginate(12);
            } else {
                // 최근 본 분양 매물
                $siteProductList = SiteProduct::with('images')->select(
                    'site_product.*'
                );
                $siteProductList->like('site_product', Auth::guard('web')->user()->id ?? "");
                $siteProductList->recentProduct('site_product', Auth::guard('web')->user()->id ?? "");
                $siteProductList->where('recent_product.id', '!=', null);
                $result = $siteProductList->orderBy('site_product.created_at', 'desc')->orderBy('site_product.id', 'desc')->paginate(12);
            }

            $view = view('components.user-mypage-interest-list-layout', compact('result', 'type'))->render();
            return response()->json(['html' => $view]);
        }

        return view('www.mypage.my-recently-list', compact('user'));
    }

    /**
     * 기업 이전 제안서
     */
    public function corpProposalListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.corpProposal_list', compact('user'));
    }

    /**
     * 내 자산관리
     */
    public function serviceListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.service_list', compact('user'));
    }

    /**
     * 내 자산관리 등록 1
     */
    public function serviceFirstCreateView(): View
    {
        return view('www.mypage.asset-create-first');
    }

    /**
     * 내 자산관리 등록 2
     */
    public function serviceSecondCreateView(Request $request): View
    {
        info($request);
        return view('www.mypage.asset-create-second', compact('request'));
    }

    /**
     * 내 자산관리 등록 3
     */
    public function serviceThirdCreateView(Request $request): View
    {
        info($request);
        return view('www.mypage.asset-create-third', compact('request'));
    }

    /**
     * 내 자산관리 등록 4
     */
    public function serviceFourthCreateView(Request $request): View
    {
        info($request);
        return view('www.mypage.asset-create-fourth', compact('request'));
    }

    /**
     * 내 자산 등록
     */
    public function serviceCreate(Request $request): RedirectResponse
    {

        info($request);

        $asset_address_id = 0;

        if ($request->asset_address_id == 'N') {
            $assetAddress = AssetAddress::create([
                'users_id' => Auth::guard('web')->user()->id,
                'is_temporary' => $request->is_temporary,
                'is_unregistered' => $request->is_unregistered,
                'address_lat' => $request->address_lat,
                'address_lng' => $request->address_lng,
                'region_code' => $request->region_code,
                'region_address' => $request->region_address,
                'address' => $request->address,
                'old_address' => $request->old_address
            ]);

            $asset_address_id = $assetAddress->id;
        } else {
            $asset_address_id = $request->asset_address_id;
        }

        $result = Asset::create([
            'asset_address_id' => $asset_address_id,
            'type' => $request->type,
            'type_detail' => $request->type_detail,
            'address_dong' => isset($request->address_dong) ? $request->address_dong : null,
            'address_detail' => $request->address_detail_ho,
            'area' => $request->area,
            'square' => $request->square,
            'exclusive_area' => $request->exclusive_area,
            'exclusive_square' => $request->exclusive_square,
            'name_type' => $request->name_type,
            'business_type' => $request->business_type,

            'price' => $request->price,
            'contracted_at' => isset($request->contracted_at) ? $this->integerToDate($request->contracted_at) : null,
            'registered_at' => isset($request->registered_at) ? $this->integerToDate($request->registered_at) : null,
            'acquisition_tax_rate' => $request->secoundType == 0 ? $request->acquisition_tax_rate_0 : $request->acquisition_tax_rate_1,
            'etc_price' => $request->etc_price,
            'tax_price' => $request->tax_price,
            'estate_price' => $request->estate_price,
            'loan_price' => $request->loan_price,
            'loan_rate' => $request->loan_rate,
            'loan_period' => $request->loan_period,
            'loaned_at' => isset($request->loaned_at) ? $this->integerToDate($request->loaned_at) : null,
            'loan_type' => $request->loan_type,

            'is_vacancy' => $request->vacancy,
            'tenant_name' => $request->tenant_name,
            'tenant_phone' => $request->tenant_phone,
            'pay_type' => $request->pay_type,
            'check_price' => $request->check_price,
            'month_price' => $request->month_price,
            'deposit_day' => $request->deposit_day,
            'started_at' => isset($request->started_at) ? $this->integerToDate($request->started_at) : null,
            'ended_at' => isset($request->ended_at) ? $this->integerToDate($request->ended_at) : null
        ]);

        $this->imageTypeWithCreate($request->sale_image_ids, Asset::class, $result->id, 0);
        $this->imageTypeWithCreate($request->entre_image_ids, Asset::class, $result->id, 1);
        $this->imageTypeWithCreate($request->rental_image_ids, Asset::class, $result->id, 2);
        $this->imageTypeWithCreate($request->etc_image_ids, Asset::class, $result->id, 3);

        return Redirect::route('www.mypage.service.list.view')->with('message', "자산이 등록 되었습니다.");
    }

    public function integerToDate($int)
    {
        $date = substr($int, 0, 4) . '-' . substr($int, 4, 2) . '-' . substr($int, 6, 2);

        return $date;
    }

    /**
     * 매물 제안서
     */
    public function proposalListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.proposal_list', compact('user'));
    }

    /**
     * 수익률 계산기
     */
    public function calculatorRevenueListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $calculatorRevenueList = CalculatorRevenue::select();

        $calculatorRevenueList->where('users_id', Auth::guard('web')->user()->id);

        // 정렬
        $calculatorRevenueList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result_calculator = $calculatorRevenueList->get();

        return view('www.mypage.calculatorRevenue_list', compact('user', 'result_calculator'));
    }

    /**
     * 수익률 계산기
     */
    public function calculatorLoanListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.calculatorLoan_list', compact('user'));
    }

    /**
     * 내 정보 수정
     */
    public function myInfoView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.my_info', compact('user'));
    }

    /**
     * 중개사 내 정보 수정
     */
    public function companyInfoView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();



        return view('www.mypage.company_info', compact('user'));
    }

    /**
     * 커뮤니티 게시글 관리
     */
    public function communityListView(Request $request): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        // 커뮤니티 선택
        $communityList = Community::select();

        $communityList->where('author', Auth::guard('web')->user()->id);

        // 정렬
        $communityList->orderBy('community.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result_community = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);

        return view('www.mypage.community_list', compact('user', 'result_community'));
    }

    /**
     * 알림
     */
    public function alarmListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.alarm_list', compact('user'));
    }

    /**
     * 수익률 계산기 등록
     */
    public function calculatorRevenueCreate(Request $request): RedirectResponse
    {
        CalculatorRevenue::create([
            'users_id' => Auth::guard('web')->user()->id,
            'sale_price' => $request->sale_price,
            'acquisition_tax' => $request->acquisition_tax,
            'tax_price' => $request->tax_price ?? 0,
            'commission' => $request->commission ?? 0,
            'ctc_price' => $request->ctc_price ?? 0,
            'price' => $request->price ?? 0,
            'month_price' => $request->month_price ?? 0,
            'loan_ratio' => $request->loan_ratio ?? 0,
            'loan_interest' => $request->loan_interest ?? 0,
        ]);

        return Redirect::route('www.mypage.calculator.revenue.list.view')->with('message', "수익률을 계산했습니다.");
    }

    /**
     * 수익률 계싼기 삭제
     */
    public function calculatorRevenueDelete(Request $request): RedirectResponse
    {
        $result = CalculatorRevenue::where('id', $request->id)->first()
            ->delete();

        return Redirect::route('www.mypage.calculator.revenue.list.view')->with('message', "수익률을 삭제했습니다.");
    }
}
