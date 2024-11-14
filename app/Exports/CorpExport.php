<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class CorpExport implements FromView
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {

        $userList = User::select()->where('type', '=', '1')->where('company_state', '=', '1');

        // 담당자 이름
        if (isset($this->request->name)) {
            $userList->where('name', 'like', "%{$this->request->name}%");
        }

        // 중개사무소명
        if (isset($this->request->company_name)) {
            $userList->where('company_name', 'like', "%{$this->request->company_name}%");
        }

        // 중개사 상태
        if ($this->request->has('state') && $this->request->state > -1) {
            $userList->where('state', '=', $this->request->state);
        }

        // 게시 시작일 from ~ to
        if (isset($this->request->from_created_at) && isset($this->request->to_created_at)) {
            $userList->DurationDate('created_at', $this->request->from_created_at, $this->request->to_created_at);
        }

        // 정렬
        $userList->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        $result = $userList->get();

        if (isset($this->request->phone)) {
            $phone = $this->request->phone;
            $result = $result->filter(function ($user) use ($phone) {
                return strpos($user->phone, $phone) !== false;
            });
        }

        return view('exports.corp', [
            'result' => $result
        ]);
    }
}
