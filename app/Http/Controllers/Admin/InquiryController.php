<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::with('item')
            ->latest()
            ->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        if (! $inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function markRead(Inquiry $inquiry)
    {
        $inquiry->update(['is_read' => true]);

        return back()->with('success', 'Marked as read.');
    }
}
