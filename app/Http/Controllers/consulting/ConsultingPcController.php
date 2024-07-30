<?php

namespace App\Http\Controllers\consulting;

use App\Http\Controllers\Controller;
use App\Models\ConsultingQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ConsultingPcController extends Controller
{
    // 상담문의 등록 페이지
    public function cosultingCreateView(): View
    {
        return view('www.consulting.consulting_create');
    }

    // 상담문의 등록
    public function cosultingCreate(Request $request): RedirectResponse
    {
        // 유효성 검사
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|min:11',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $result = ConsultingQuestion::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
            'state' => 0, // 등록 시에는 0
            'is_delete' => 0, // 등록 시에는 0
        ]);

        return Redirect::route('www.main.main')->with('message', '상담문의를 등록했습니다.');
    }
}
