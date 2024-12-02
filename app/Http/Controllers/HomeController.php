<?php


namespace App\Http\Controllers;

use App\Http\Requests\Web\HomeRequest;
use App\Models\User;
use App\Services\HomeService;
use Illuminate\Http\Request;
use App\Models\Post;


class HomeController extends Controller
{
    
    private HomeService $homeService;

    public function __construct(HomeService $homeService) {
        $this->homeService = $homeService;
    }

    public function updateProfile(HomeRequest $homeRequest)
    {
        $params = $homeRequest->validated();
        $result = $this->homeService->updateProfile($params);

        if ($result) {
            return redirect()->route('home');
        }

        return back()->withErrors(['error' => 'Sửa thất bại']);
    }
    public function index()
    {
        $data = $this->homeService->getList();

        return view('home', [
            'users' => $data['users'],  
            'posts' => $data['posts'], 
        ]);
    }
}
