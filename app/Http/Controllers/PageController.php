<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInquiryRequest;
use App\Models\Inquiry;
use App\Models\Item;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function care()
    {
        return view('pages.care');
    }

    public function contact()
    {
        $items = Item::available()->orderBy('title')->get(['id', 'title', 'slug']);

        return view('pages.contact', compact('items'));
    }

    public function sendInquiry(ContactInquiryRequest $request)
    {
        Inquiry::create($request->validated());

        return back()->with('success', 'Your message has been sent. We\'ll reach out via Instagram or email soon 🖤');
    }
}
