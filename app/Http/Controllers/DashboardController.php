<?php

namespace App\Http\Controllers;

use App\Mail\NewStoryNotification;
use App\Mail\NotifyAdmin;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class DashboardController extends Controller
{
    public function index()
    {
        //
        // DB::enableQueryLog();
        $query = Story::where('status', 1);
        $type = request()->input('type');
        if (in_array($type, ['short', 'long'])) {
            $query->where('type', $type);
        }
        $stories = $query->with('user')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('dashboard.index', [
            'stories' => $stories
        ]);
    }

    public function show(Story $activeStory)
    {
        //
        return view('dashboard.show', [
            'story' => $activeStory
        ]);
    }

    public function email()
    {
        // Mail::send(new NotifyAdmin('Title of the story'));
        Mail::send(new NewStoryNotification('Title of the story'));
    }
}
