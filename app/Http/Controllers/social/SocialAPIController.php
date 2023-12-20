<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersBlocks;
use App\Models\UsersFollows;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| 사용자 API
|--------------------------------------------------------------------------
|
| - 사용자 프로필 보기 (O)
| - 사용자 차단하기 / 차단 해제하기 (O)
| - 사용자 차단 목록 보기 (O)
| - 사용자 팔로우 / 언팔로우 (O)
| - 사용자 팔로우 보기
| - 사용자 팔로잉 보기

|
*/

class SocialAPIController extends Controller
{
    /**
     * 사용자 프로필 보기
     */
    public function profile(Request $request)
    {

        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $result = User::select()
            ->where('id', $request->id)
            ->with('user_follow')
            ->withCount('user_follow')
            ->with('user_following')
            ->withCount('user_following')
            ->with('block')
            ->first();


        return $this->sendResponse($result, "회원정보입니다.");
    }

    /**
     * 사용자 차단하기 / 차단 해제하기
     */
    public function profileBlock(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $userBlock = UsersBlocks::where('block_id', $request->id)
            ->where('users_id', Auth::guard('api')->user()->id)
            ->first();

        if ($userBlock) {
            $userBlock->delete();
            $success["block_id"] = $userBlock->block_id;
            return $this->sendResponse($success, "사용자 차단이 해제되었습니다.");
        } else {
            $created = UsersBlocks::create([
                'users_id' => Auth::guard('api')->user()->id,
                'block_id' => $request->id,
            ]);
            return $this->sendResponse($created, "사용자 차단되었습니다.");
        }
    }

    /**
     * 차단한 사용자 리스트 보기
     */
    public function profileBlockList(Request $request)
    {

        $usersBlocksList = UsersBlocks::select()
            ->with('user')
            ->whereHas('user', function ($query) {
                $query->where('state', 0);
            })
            ->where('users_id', Auth::guard('api')->user()->id);

        $result = $usersBlocksList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, "사용자 차단 목록입니다.");
    }

    /**
     * 사용자 팔로우 / 언팔로우
     */
    public function profileFollow(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $usersFollows = UsersFollows::where('follow_id', $request->id)
            ->where('users_id', Auth::guard('api')->user()->id)
            ->first();

        if ($usersFollows) {
            $usersFollows->delete();
            $success["follow_id"] = $usersFollows->follow_id;
            return $this->sendResponse($success, "사용자를 언팔로우합니다.");
        } else {
            $created = UsersFollows::create([
                'users_id' => Auth::guard('api')->user()->id,
                'follow_id' => $request->id,
            ]);
            return $this->sendResponse($created, "사용자를 팔로우합니다.");
        }
    }


    /**
     * 팔로잉 사용자 리스트 보기
     */
    public function profileFollowingList(Request $request)
    {

        $usersFollowsList = UsersFollows::select()
            ->with('following')
            ->whereHas('following', function ($query) {
                $query->where('state', 0);
            })->where('users_id', $request->id);

        $result = $usersFollowsList->paginate($request->per_page == null ? 10 : $request->per_page);

        return $this->sendResponse($result, "팔로잉 목록입니다.");
    }

    /**
     * 팔로워 사용자 리스트 보기
     */
    public function profileFollowerList(Request $request)
    {

        $usersFollowsList = UsersFollows::select()
            ->with('follower')
            ->whereHas('follower', function ($query) {
                $query->where('state', 0);
            })->where('follow_id', $request->id);

        $result = $usersFollowsList->paginate($request->per_page == null ? 10 : $request->per_page);
        return $this->sendResponse($result, "팔로워 목록입니다.");
    }
}
