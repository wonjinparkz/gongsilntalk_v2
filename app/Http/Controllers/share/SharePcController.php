<?php

namespace App\Http\Controllers\share;

use App\Http\Controllers\Controller;
use App\Models\CalculatorLoan;
use App\Models\CalculatorRevenue;
use App\Models\CorpProduct;
use App\Models\CorpProductAddress;
use App\Models\CorpProposal;
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

        return view('www.sharePage.proposal_share_page', compact('proposal', 'user'));
    }

    public function shareCorpProposalDetail(Request $request): View
    {
        $corpInfo = CorpProposal::select()->where('id', $request->id)->first();
        $address = CorpProductAddress::select()->where('corp_proposal_id', $request->id)->orderBy('id', 'asc')->get();
        $products = CorpProduct::select()->where('corp_proposal_id', $request->id)->orderBy('corp_product_address_id', 'asc')->get();

        $proposal_type = $request->proposal_type ?? 0;
        $is_type = $request->is_type ?? 0;

        return view('www.sharePage.corp_proposal_share_page', compact('address', 'corpInfo', 'products', 'proposal_type', 'is_type'));
    }

    public function shareCalculatorRevenueDetail($id): View
    {
        $calculator = CalculatorRevenue::select()->where('id', $id)->first();

        return view('www.sharePage.calculator_revenue_share_page', compact('calculator'));
    }

    public function shareCalculatorLoanDetail($id): View
    {

        $loan = CalculatorLoan::with('prepayments', 'loan_rates')->select()->where('id', $id)->first();

        return view('www.sharePage.calculator_loan_share_page', compact('loan'));
    }
}
