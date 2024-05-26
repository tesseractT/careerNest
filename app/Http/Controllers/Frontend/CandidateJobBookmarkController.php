<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobBookmark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CandidateJobBookmarkController extends Controller
{
    function save(String $id)
    {
        if (!auth()->check()) {
            throw ValidationException::withMessages(['message' => 'You need to login first to bookmark a job.']);
        }
        if (auth()->check() && auth()->user()->role !== 'candidate') {
            throw ValidationException::withMessages(['message' => 'You need to login as a candidate to bookmark a job.']);
        }
        $alreadyBookmarked = JobBookmark::where(['job_id' => $id, 'candidate_id' => auth()->user()->candidateProfile->id])->exists();

        if ($alreadyBookmarked) {
            throw ValidationException::withMessages(['message' => 'Job already bookmarked.']);
        }
        $bookmark = new JobBookmark();
        $bookmark->job_id = $id;
        $bookmark->candidate_id = auth()->user()->candidateProfile->id;
        $bookmark->save();

        return response(['message' => 'Job bookmarked successfully.', 'id' => $id]);
    }

    function index(): View
    {
        $bookmarks = JobBookmark::where('candidate_id', auth()->user()->candidateProfile->id)->paginate(20);
        return view('frontend.candidate-dashboard.bookmark.index', compact('bookmarks'));
    }
}
