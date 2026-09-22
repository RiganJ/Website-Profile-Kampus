<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\HolidayService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(HolidayService $holidayService)
    {
        $isOpen = $holidayService->isCampusOpen();

        return view('contact.index', compact('isOpen'));
    }

    public function send(Request $request)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create([
            ...$payload,
            'status' => 'new',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Pesan berhasil dikirim. Tim kami akan segera memeriksa inbox Anda.',
        ]);
    }
}
