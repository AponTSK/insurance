<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotCover;
use Illuminate\Http\Request;

class NotCoversController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage What Not Covers';
        $notCovers = NotCover::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.cover.index', compact('pageTitle', 'notCovers'));
    }
    public function save(Request $request, $id = 0)
    {
        $isRequired = $id ? 'nullable' : 'required';

        $request->validate([
            'title' => 'required|string|unique:not_covers,title,' . $id,

        ]);

        if ($id) {
            $notCover = NotCover::find($id);
            $message  = "Option updated successfully";
        } else {
            $notCover = new NotCover();
            $message  = "Option created successfully";
        }

        $notCover->title = $request->title;

        $notCover->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }
    public function toggleStatus($id)
    {
        return NotCover::changeStatus($id);
    }
}
