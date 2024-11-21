<?php


namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        $members = Member::paginate(10);
        return view('members.index', compact('members'));
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'type' => 'required|in:organisation,agency,person',
            'message' => 'nullable|string',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', __('messages.member_added'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'type' => 'required|in:organisation,agency,person',
            'message' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', __('messages.member_updated'));
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', __('messages.member_deleted'));
    }
}
