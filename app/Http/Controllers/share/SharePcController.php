<?php

namespace App\Http\Controllers\share;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SharePcController extends Controller
{
    public function shareProposalDetail(Request $request): View
    {
        $proposal = Proposal::with('regions', 'products')->select()->where('id', $request->id)->first();

        $user = User::select()
            ->where('users.id',  $proposal->users_id)
            ->first();

        return view('www.sharePage.share_page', compact('proposal','user'));
    }
}
