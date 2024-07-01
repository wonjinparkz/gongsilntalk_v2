<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Alarms;
use App\Models\Asset;
use App\Models\AssetAddress;
use App\Models\CalculatorLoan;
use App\Models\CalculatorLoanPayment;
use App\Models\CalculatorLoanRate;
use App\Models\CalculatorRevenue;
use App\Models\Community;
use App\Models\CorpProposal;
use App\Models\Product;
use App\Models\ProductAddInfo;
use App\Models\ProductOptions;
use App\Models\ProductPrice;
use App\Models\ProductServices;
use App\Models\Proposal;
use App\Models\SiteProduct;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserPcController extends Controller
{
    /**
     * 내 매물 관리
     */
    public function mypageMainView(Request $request)
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $countList = Product::select(
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state < 1) as request_count'),
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state > 0) as transactions_count')
        )->where('users_id', Auth::guard('web')->user()->id)->first();

        if ($request->ajax()) {
            $type = $request->type ?? 0;

            $productList = Product::select('product.*');
            $productList->leftjoin('product_price', 'product_price.product_id', 'product.id');

            $productList->where('product.users_id', Auth::guard('web')->user()->id);

            if ($request->type != 1) {
                $productList->where('product.state', '<', 1);
            } else {
                $productList->where('product.state', '>', 0);
            }

            // 매물 종류
            if (isset($request->product_type)) {
                $productList->where('product.type', $request->product_type);
            }

            // 매매/전세/월세 등 여부
            if (isset($request->payment_type)) {
                $productList->where('product_price.payment_type', $request->payment_type);
            }

            // 주소 / 매물번호 검색
            if (isset($request->search_text)) {
                $productList->where(function ($query) use ($request) {
                    $query->where('product.product_number', 'like', "%{$request->search_text}%")
                        ->orWhere('product.address', 'like', "%{$request->search_text}%");
                });
            }

            $productList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');
            $result = $productList->paginate(10);

            $view = view('components.user-mypage-product-main-list-layout', compact('result', 'type'))->render();
            return response()->json(['html' => $view]);
        }

        return view('www.mypage.product-management-list', compact('user', 'countList'));
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

        $countList = Product::select(
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state < 1) as request_count'),
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state > 0) as transactions_count')
        )->where('users_id', Auth::guard('web')->user()->id)->first();

        if ($request->ajax()) {
            $type = $request->type ?? 0;

            $productList = Product::select('product.*');
            $productList->leftjoin('product_price', 'product_price.product_id', 'product.id');

            $productList->where('product.users_id', Auth::guard('web')->user()->id);

            if ($request->type != 1) {
                $productList->where('product.state', '<', 1);
            } else {
                $productList->where('product.state', '>', 0);
            }

            // 매물 종류
            if (isset($request->product_type)) {
                $productList->where('product.type', $request->product_type);
            }

            // 매매/전세/월세 등 여부
            if (isset($request->payment_type)) {
                $productList->where('product_price.payment_type', $request->payment_type);
            }

            // 주소 / 매물번호 검색
            if (isset($request->search_text)) {
                $productList->where(function ($query) use ($request) {
                    $query->where('product.product_number', 'like', "%{$request->search_text}%")
                        ->orWhere('product.address', 'like', "%{$request->search_text}%");
                });
            }

            $productList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');
            $result = $productList->paginate(10);

            $view = view('components.user-mypage-product-list-layout', compact('result', 'type'))->render();
            return response()->json(['html' => $view]);
        }

        return view('www.mypage.productMagagement_list', compact('user', 'countList'));
    }

    /**
     * 내 매물 삭제
     */
    public function userProductDelete(Request $request)
    {
        $result = Product::select()->whereIn('id', $request->id)->get();

        foreach ($result as $product) {
            ProductAddInfo::select()->where('product_id', $product->id)->delete();
            ProductOptions::select()->where('product_id', $product->id)->delete();
            ProductPrice::select()->where('product_id', $product->id)->delete();
            ProductServices::select()->where('product_id', $product->id)->delete();

            $product->delete();
        }

        return Redirect::back()->with('message', '매물이 삭제 되었습니다.');
    }

    /**
     * 내 매물 상태 변경
     */
    public function corpProductStateChange(Request $request)
    {

        $result = Product::where('id', $request->id)->update([
            'state' => $request->state
        ]);

        return $this->sendResponse($result, '상태 변경 완');
    }

    /**
     * 중개사 매물 관리
     */
    public function corpProductMagagementListView(Request $request)
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $countList = Product::select(
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and user_type = 1) as all_count'),
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state = 1 and user_type = 1) as req_count'),
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state = 2 and user_type = 1) as done_count'),
            DB::RAW('(select count(*) from product where users_id = ' . Auth::guard('web')->user()->id . ' and state > 2 and user_type = 1) as non_count')
        )->where('users_id', Auth::guard('web')->user()->id)->first();

        if ($request->ajax()) {
            $type = $request->type ?? 0;

            $productList = Product::select('product.*');
            $productList->leftjoin('product_price', 'product_price.product_id', 'product.id');

            $productList->where('product.users_id', Auth::guard('web')->user()->id);

            if ($request->type == 1) {
                $productList->where('product.state', 1);
            } else if ($request->type == 2) {
                $productList->where('product.state', 2);
            } else if ($request->type == 3) {
                $productList->where('product.state', '>', 2);
            }

            // 매물 종류
            if (isset($request->product_type)) {
                $productList->where('product.type', $request->product_type);
            }

            // 매매/전세/월세 등 여부
            if (isset($request->payment_type)) {
                $productList->where('product_price.payment_type', $request->payment_type);
            }

            // 주소 / 매물번호 검색
            if (isset($request->search_text)) {
                $productList->where(function ($query) use ($request) {
                    $query->where('product.product_number', 'like', "%{$request->search_text}%")
                        ->orWhere('product.address', 'like', "%{$request->search_text}%");
                });
            }

            $productList->orderBy('product.created_at', 'desc')->orderBy('product.id', 'desc');
            $result = $productList->paginate(10);

            $view = view('components.corp-mypage-product-list-layout', compact('result', 'type'))->render();
            return response()->json(['html' => $view]);
        }

        return view('www.mypage.corpProductMagagement_list', compact('user', 'countList'));
    }

    /**
     * 중개사 매물 수정
     */
    public function corpProductMagagementUpdateView($id): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $product = Product::select()->where('id', $id)->first();

        return view('www.mypage.corp-product-update', compact('user', 'product'));
    }

    /**
     * 중개사 매물 수정
     */
    public function corpProductMagagementUpdate(Request $request): RedirectResponse
    {


        $productDate = [
            'region_code' => $request->region_code,
            'region_address' => $request->region_address,
            'address' => $request->address,
            'is_map' => $request->temporary_address ?? 0,
            'address_lat' => !isset($request->temporary_address) ? $request->address_lat : null,
            'address_lng' => !isset($request->temporary_address) ? $request->address_lng : null,
            'address_detail' => $request->address_detail,
            'address_dong' => $request->address_dong,
            'address_number' => $request->address_number,
            'floor_number' => in_array($request->type, ['6', '7']) ? null : $request->floor_number,
            'total_floor_number' => in_array($request->type, ['6', '7']) ? null : $request->total_floor_number,
            'lowest_floor_number' => $request->type == 7 ? $request->lowest_floor_number : null,
            'top_floor_number' => $request->type == 7 ? $request->top_floor_number : null,
            'area' => $request->area,
            'square' => $request->square,
            'exclusive_area' => $request->type != 6 ? $request->exclusive_area : null,
            'exclusive_square' => $request->type != 6 ? $request->exclusive_square : null,
            'total_floor_area' => $request->type == 7 ? $request->total_floor_area : null,
            'total_floor_square' => $request->type == 7 ? $request->total_floor_square : null,
            'approve_date' => $request->type != 6 ? $request->approve_date : null,
            'building_type' => $request->building_type,
            'move_type' => $request->type != 6 ? $request->move_type : null,
            'move_date' => ($request->type != 6 && $request->move_type == 2) ? $request->move_date : null,
            'is_service' => $request->type != 6 ? $request->is_service ?? 0 : null,
            'service_price' => ($request->type != 6 && $request->is_service != 1) ? $request->service_price : null,
            'loan_type' => $request->loan_type,
            'loan_price' => $request->loan_type != 0 ? $request->loan_price : null,
            'parking_type' => $request->type != 6 ? $request->parking_type : null,
            'parking_price' => $request->type != 6 && ($request->parking_type == 1 && $request->is_parking != 1) ? $request->parking_price : null,
            'comments' => $request->comments,
            'contents' => $request->contents,
            'commission' => $request->commission,
            'non_memo' => $request->non_memo,
            'commission_rate' => $request->commission_rate
        ];


        $result = Product::where('id', $request->id)->update($productDate);

        ProductServices::where('product_id', $request->id)->delete();
        ProductPrice::where('product_id', $request->id)->delete();
        ProductAddInfo::where('product_id', $request->id)->delete();
        ProductOptions::where('product_id', $request->id)->delete();

        // 관리비 항목
        if (isset($request->service_type)) {

            $serviceTypes = array_map('intval', $request->service_type);

            foreach ($serviceTypes as $service_type) {
                ProductServices::create([
                    'product_id' => $request->id,
                    'type' => $service_type,
                ]);
            }
        }


        // 가격정보
        $premium_price = $request->premium_price;

        if ($request->type == 3) {
            $premium_price = $request->is_premium == 1 ? $premium_price : null;
        } else if ($request->type > 13) {
            $premium_price = $premium_price;
        }

        ProductPrice::create([
            'product_id' => $request->id,
            'payment_type' => $request->payment_type,
            'price' => $request->{'price_'.$request->payment_type},
            'month_price' => in_array($request->payment_type, [1, 2, 4]) ? $request->month_price : null,
            'is_price_discussion' => $request->is_price_discussion ?? 0,
            'is_use' => $request->type >= 14 ? NULL : $request->is_use ?? 0,
            'current_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_price : null,
            'current_month_price' =>  $request->type < 14 && $request->is_use == 1 ? $request->current_month_price : null,
            'is_premium' => $request->type == 3 ? $request->is_premium : null,
            'premium_price' => $premium_price,
        ]);



        // 추가정보
        if (in_array($request->type, [0, 1, 2, 4])) {
            $product_add_info = [
                'product_id' => $request->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'weight' => $request->weight,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,

            ];
        } else if ($request->type == 3) {
            $product_add_info = [
                'product_id' => $request->id,
                'current_business' => $request->current_business,
                'recommend_business_type' => $request->recommend_business_type,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 5) {
            $product_add_info = [
                'product_id' => $request->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 6) {
            $product_add_info = [
                'product_id' => $request->id,
                'land_use_type' => $request->land_use_type,
                'city_plan_type' => $request->city_plan_type,
                'building_permit_type' => $request->building_permit_type,
                'land_permit_type' => $request->land_permit_type,
                'access_load_type' => $request->access_load_type,
            ];
        } else if ($request->type == 7) {
            $product_add_info = [
                'product_id' => $request->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'recommend_business_type' => $request->recommend_business_type,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'is_dock' => $request->is_dock,
                'is_hoist' => $request->is_hoist,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type == 9) {
            $product_add_info = [
                'product_id' => $request->id,
                'room_count' => $request->room_count,
                'bathroom_count' => $request->bathroom_count,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'structure_type' => $request->structure_type,
                'builtin_type' => $request->builtin_type,
                'is_elevator' => $request->is_elevator,
                'declare_type' => $request->declare_type,
                'is_option' => $request->is_option,
            ];
        } else if (in_array($request->type, [8, 10, 11, 12, 13])) {
            $product_add_info = [
                'product_id' => $request->id,
                'room_count' => $request->room_count,
                'bathroom_count' => $request->bathroom_count,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'is_elevator' => $request->is_elevator,
                'is_option' => $request->is_option,
            ];
        } else if ($request->type > 13) {
            $product_add_info = [
                'product_id' => $request->id,
                'direction_type' => $request->direction_type,
                'cooling_type' => $request->cooling_type,
                'heating_type' => $request->heating_type,
                'weight' => $request->weight,
                'is_elevator' => $request->is_elevator,
                'is_goods_elevator' => $request->is_goods_elevator,
                'interior_type' => $request->interior_type,
                'floor_height_type' => $request->floor_height_type,
                'wattage_type' => $request->wattage_type,
                'is_option' => $request->is_option,
            ];
        }

        ProductAddInfo::create($product_add_info);

        // 옵션정보
        if ($request->type != 6 && $request->is_option == 1 && isset($request->option_type)) {

            $optionTypes = array_map('intval', $request->option_type);

            foreach ($optionTypes as $option_type) {
                ProductOptions::create([
                    'product_id' => $request->id,
                    'type' => $option_type,
                ]);
            }
        }

        $this->imageWithEdit($request->image_ids, Product::class, $request->id);

        return Redirect::route('www.mypage.corp.product.magagement.list.view')->with('message', "매물이 수정 되었습니다.");
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
     * 기업 이전 제안서 리스트
     */
    public function corpProposalListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $proposalList = CorpProposal::with('users', 'products')->select()
            ->where('users_id', Auth::guard('web')->user()->id)
            ->where('is_delete', '0')
            ->get();

        return view('www.mypage.corpProposal_list', compact('user', 'proposalList'));
    }

    /**
     * 기업 이전 제안서 삭제
     */
    public function corpProposalDelete(Request $request): RedirectResponse
    {

        $result = CorpProposal::select()->where('id', $request->id)->delete();

        return Redirect::route('www.mypage.corp.proposal.list.view')->with('message', "기업이 삭제 되었습니다.");
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

        $addressList = AssetAddress::with('asset')->select()->where('users_id', Auth::guard('web')->user()->id)->orderBy('id', 'desc')->get();

        $addressData = Asset::select(
            DB::raw('SUM(asset.price) AS price'),
            DB::raw('SUM(asset.check_price) AS check_price'),
            DB::raw('SUM(asset.month_price) AS month_price'),
            DB::raw('SUM(asset.loan_price) AS loan_price'),
            DB::raw('SUM(asset.etc_price +asset.tax_price+asset.estate_price) AS etc_price'),
            DB::raw('SUM(IFNULL(((asset.loan_price * (asset.loan_rate / 100)) / 12), 0)) AS loan_rate_price'),
            DB::raw('SUM(IFNULL((asset.price * (asset.acquisition_tax_rate / 100)), 0)) AS acquisition_tax_price')
        )
            ->leftJoin('asset_address', function ($report) {
                $report->on('asset_address.id', '=', 'asset.asset_address_id')
                    ->where('asset_address.users_id', '=', Auth::guard('web')->user()->id);
            })
            ->where('asset_address.users_id', '=', Auth::guard('web')->user()->id)
            ->first();

        return view('www.mypage.service_list', compact('user', 'addressList', 'addressData'));
    }

    /**
     * 내 자산 삭제
     */
    public function addressDelete(Request $request)
    {
        $result = AssetAddress::select()->where('id', $request->id)->delete();
        $result = Asset::select()->where('asset_address_id', $request->id)->delete();

        return $this->sendResponse($result, '주소가 삭제 되었습니다.');
    }

    /**
     * 내 자산 개별 삭제
     */
    public function addressOneDelete(Request $request): RedirectResponse
    {
        $asset = Asset::select()->where('id', $request->id)->select()->first();

        $count = Asset::select()->where('asset_address_id', $asset->asset_address_id)->count();

        if ($count < 2) {
            AssetAddress::select()->where('id', $asset->asset_address_id)->select()->delete();
        }

        $asset->delete();

        return Redirect::route('www.mypage.service.list.view')->with('message', "자산이 삭제 되었습니다.");
    }

    /**
     * 내 자산 상세
     */
    public function serviceDetailView($id): View
    {
        $result = Asset::with('asset_address', 'images')->select()->where('id', $id)->first();

        $industryCenterAvgPrice = Asset::select()
            ->leftJoin('asset_address', function ($report) use ($result) {
                $report->on('asset_address.id', '=', 'asset.asset_address_id')
                    ->where('asset_address.region_code', '=', $result->asset_address->region_code);
            })
            ->where('asset.type_detail', 0)->avg('price');

        $industryCenterArea = Asset::select()
            ->leftJoin('asset_address', function ($report) use ($result) {
                $report->on('asset_address.id', '=', 'asset.asset_address_id')
                    ->where('asset_address.region_code', '=', $result->asset_address->region_code);
            })
            ->where('asset.type_detail', 0)->sum('area');

        return view('www.mypage.asset-detail', compact('result', 'industryCenterAvgPrice', 'industryCenterArea'));
    }

    /**
     * 내 자산 주소 목록
     */
    public function addressList(Request $request)
    {
        $addressList = AssetAddress::select();

        $addressList->where('users_id', Auth::guard('web')->user()->id);
        $addressList->where('region_code', $request->region_code);

        $result = $addressList->first();

        return $this->sendResponse($result, '검색이 완료 되었습니다.');
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

        return view('www.mypage.asset-create-second', compact('request'));
    }

    /**
     * 내 자산관리 등록 3
     */
    public function serviceThirdCreateView(Request $request): View
    {

        return view('www.mypage.asset-create-third', compact('request'));
    }

    /**
     * 내 자산관리 등록 4
     */
    public function serviceFourthCreateView(Request $request): View
    {

        return view('www.mypage.asset-create-fourth', compact('request'));
    }

    /**
     * 내 자산 등록
     */
    public function serviceCreate(Request $request): RedirectResponse
    {



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

            'tran_type' => $request->secoundType,
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

    /**
     * 내 자산관리 수정 1
     */
    public function serviceFirstUpdateView($id): View
    {
        $result = Asset::with('asset_address')->select()->where('id', $id)->first();

        return view('www.mypage.asset-update-first', compact('result'));
    }

    /**
     * 내 자산관리 수정 2
     */
    public function serviceSecondUpdateView(Request $request): View
    {


        $result = Asset::with('asset_address')->select()->where('id', $request->id)->first();

        return view('www.mypage.asset-update-second', compact('request', 'result'));
    }

    /**
     * 내 자산관리 수정 3
     */
    public function serviceThirdUpdateView(Request $request): View
    {


        $result = Asset::with('asset_address')->select()->where('id', $request->id)->first();

        return view('www.mypage.asset-update-third', compact('request', 'result'));
    }

    /**
     * 내 자산관리 수정 4
     */
    public function serviceFourthUpdateView(Request $request): View
    {
        $result = Asset::with('asset_address', 'sale_images', 'entre_images', 'rental_images', 'etc_images')->select()->where('id', $request->id)->first();
        info('수정 해보자');


        return view('www.mypage.asset-update-fourth', compact('request', 'result'));
    }


    /**
     * 내 자산 수정
     */
    public function serviceUpdate(Request $request): RedirectResponse
    {

        info('수정 해보자');


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

        $result = Asset::where('id', $request->id)->update([
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

            'tran_type' => $request->secoundType,
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
            'tenant_name' => $request->vacancy == 1 ? $request->tenant_name : null,
            'tenant_phone' => $request->vacancy == 1 ? $request->tenant_phone : null,
            'pay_type' => $request->pay_type,
            'check_price' =>  $request->vacancy == 1 ? $request->check_price : null,
            'month_price' =>  $request->vacancy == 1 ? $request->month_price : null,
            'deposit_day' => $request->vacancy == 1 ? $request->deposit_day : null,
            'started_at' => $request->vacancy == 1 ? (isset($request->started_at) ? $this->integerToDate($request->started_at) : null) : null,
            'ended_at' => $request->vacancy == 1 ? (isset($request->ended_at) ? $this->integerToDate($request->ended_at) : null) : null
        ]);

        $this->imageTypeWithEdit($request->sale_image_ids, Asset::class, $request->id, 0);
        $this->imageTypeWithEdit($request->entre_image_ids, Asset::class, $request->id, 1);
        $this->imageTypeWithEdit($request->rental_image_ids, Asset::class, $request->id, 2);
        $this->imageTypeWithEdit($request->etc_image_ids, Asset::class, $request->id, 3);

        return Redirect::route('www.mypage.service.list.view')->with('message', "자산이 수정 되었습니다.");
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

        $proposalList = Proposal::with('regions', 'products')->select()->where('users_id', Auth::guard('web')->user()->id)->get();

        return view('www.mypage.proposal_list', compact('user', 'proposalList'));
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
     * 대출 이자 계산기
     */
    public function calculatorLoanListView(): View
    {
        // 회원 정보
        $user = User::select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        $loanList = CalculatorLoan::with('prepayments', 'loan_rates')->select()->where('users_id', Auth::guard('web')->user()->id)->orderBy('created_at', 'asc')->get();

        info($loanList);

        return view('www.mypage.calculatorLoan_list', compact('user', 'loanList'));
    }

    /**
     * 대출 이자 계산 등록
     */
    public function calculatorLoanCreate(Request $request): RedirectResponse
    {
        $result = CalculatorLoan::create([
            'users_id' => Auth::guard('web')->user()->id,
            'type' => $request->type,
            'loan_price' => $request->loan_price,
            'loan_rate' => $request->loan_rate,
            'loan_month' => $request->loan_month,
            'holding_month' => $request->holding_month,
        ]);

        if (isset($request->prePay)) {
            foreach ($request->prePay as $key => $pay) {
                CalculatorLoanPayment::create([
                    'calculator_loan_id' => $result->id,
                    'sequence' => $request->prePayCount[$key],
                    'pay_price' => $pay,
                ]);
            }
        }

        if (isset($request->interestRate)) {
            foreach ($request->interestRate as $key => $rate) {
                CalculatorLoanRate::create([
                    'calculator_loan_id' => $result->id,
                    'sequence' => $request->rateCount[$key],
                    'interest_rate' => $rate,
                ]);
            }
        }

        return Redirect::route('www.mypage.calculator.loan.list.view')->with('message', "계산이 완료 되었습니다.");
    }

    /**
     * 대출 이자 계산 삭제
     */
    public function calculatorLoanDelete(Request $request): RedirectResponse
    {
        $result = CalculatorLoan::select()->where('id', $request->id)->delete();

        CalculatorLoanRate::select()->where('calculator_loan_id', $request->id)->delete();
        CalculatorLoanPayment::select()->where('calculator_loan_id', $request->id)->delete();

        return Redirect::route('www.mypage.calculator.loan.list.view')->with('message', "계산이 삭제 되었습니다.");
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
     * 프로필 이미지 변경
     */
    public function profileImageUpdate(Request $request)
    {
        // 회원 정보
        $user = User::with('image')->select()
            ->where('users.id', Auth::guard('web')->user()->id)
            ->first();

        if (isset($user->image)) {
            $this->imageWithEdit($request->image_ids, User::class, Auth::guard('web')->user()->id);
        } else {
            $this->imageWithCreate($request->image_ids, User::class, Auth::guard('web')->user()->id);
        }

        return $this->sendResponse(null, '프로필 이미지 변경에 성공했습니다.');
    }

    /**
     * 중개사 대표 전화번호 변경
     */
    public function corpCompanyNumberUpdate(Request $request)
    {
        User::where('id', Auth::guard('web')->user()->id)->update([
            'company_phone' => Crypt::encryptString($request->company_phone)
        ]);

        return $this->sendResponse(null, '대표 전화번호 변경에 성공했습니다.');
    }

    /**
     * 중개사 내 정보 수정
     */
    public function companyInfoView(): View
    {
        // 회원 정보
        $user = User::with('image')->select()
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
        $communityList = Community::select(
            'community.*',
            DB::raw("(SELECT count(*) FROM reply WHERE target_id = community.id AND target_type = 'community' AND is_delete = 0) AS replys_count")
        );

        $communityList->where('author', Auth::guard('web')->user()->id);
        $communityList->where('is_delete', 0);

        // 정렬
        $communityList->orderBy('community.created_at', 'desc')->orderBy('id', 'desc');

        // 페이징 처리
        $result_community = $communityList->paginate($request->per_page == null ? 10 : $request->per_page);

        $result_community->appends(request()->except('page'));

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

        // 전체 알림
        $alarmList = Alarms::with('tour_users', 'product')->select()->where('users_id', Auth::guard('web')->user()->id)->where('index', '!=', 101)->get();
        $checkCount = Alarms::select()->where('readed_at', NULL)->where('users_id', Auth::guard('web')->user()->id)->where('index', '!=', 101)->count();

        // 분양 알림
        $productAlarmList = Alarms::with('siteProduct')->select()->where('users_id', Auth::guard('web')->user()->id)->where('index', 101)->get();
        $prouctCheckCount = Alarms::select()->where('readed_at', NULL)->where('users_id', Auth::guard('web')->user()->id)->where('index', 101)->count();

        return view('www.mypage.alarm_list', compact('user', 'alarmList', 'checkCount', 'productAlarmList', 'prouctCheckCount'));
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

    /**
     * 비밀번호 변경
     */
    public function changePw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력해주세요.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $user = User::where('id', Auth::guard('web')->user()->id)->first();

        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError("현재 사용중인 비밀번호와 일치하지 않습니다.", 1, Response::HTTP_BAD_REQUEST);
        }

        $pattern = "/^(?=.*[a-zA-Z])(?=.*[!@#$%^~*+=-])(?=.*[0-9]).{8,15}$/";

        if (!preg_match($pattern, $request->new_password, $matchResult)) {
            return $this->sendError("영문, 숫자를 포함하여 8자리 이상으로 작성해주세요.", 2, Response::HTTP_BAD_REQUEST);
        }

        if ($request->new_password != $request->new_password_confirmation) {
            return $this->sendError("비밀번호가 일치하지 않습니다", 3, Response::HTTP_BAD_REQUEST);
        }

        // if (Hash::check($request->new_password, $user->password)) {
        //     return $this->sendError("기존 비밀번호를 새 비밀번호로 변경할 수 없습니다.", null, Response::HTTP_BAD_REQUEST);
        // }

        // 사용자 비밀번호 변경
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return $this->sendResponse(null, '비밀번호 변경에 성공했습니다.');
    }
}
