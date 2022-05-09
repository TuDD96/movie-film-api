<?php

namespace App\Http\Controllers\App;

use App\Enums\ErrorType;
use App\Services\BookService;
use Illuminate\Http\Request;
use App\Services\GiftService;
use App\Http\Controllers\App\BaseController;

class BookController extends BaseController
{
    private $bookService;

    /**
     * Create a new rule instance.
     * @param GiftService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $userId = $this->getGuard()->user()->user_id;
        $data = $this->bookService->getListComic($params, $userId);

        return $this->sendSuccess($data, trans('response.success'));
    }

    public function block($id)
    {
        $userId = auth('api')->user()->user_id;
        $data = $this->bookService->block($userId, $id);

        if (!$data) return $this->sendError(ErrorType::CODE_4041, ErrorType::STATUS_4041, trans('errors.MSG_4041'));

        return $this->sendSuccess($data, trans('response.success'));
    }
}
