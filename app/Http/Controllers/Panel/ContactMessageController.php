<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactMessageController extends Controller
{
    private array $statuses = ['new', 'in_review', 'resolved', 'archived'];

    public function index()
    {
        Gate::authorize('can-access', ['contactmessage', 'view']);

        $thispage = [
            'title' => 'پیام‌های تماس',
            'list' => 'لیست پیام‌های تماس',
        ];

        $messages = ContactMessage::query()->latest()->paginate(20);

        return view('panel.contact-message', compact('thispage', 'messages'));
    }

    public function show(string $id)
    {
        Gate::authorize('can-access', ['contactmessage', 'view']);

        $thispage = [
            'title' => 'جزئیات پیام تماس',
            'list' => 'جزئیات پیام تماس',
        ];

        $message = ContactMessage::query()->findOrFail($id);
        $statuses = $this->statuses;

        return view('panel.contact-message-show', compact('thispage', 'message', 'statuses'));
    }

    public function updateStatus(Request $request, string $id)
    {
        Gate::authorize('can-access', ['contactmessage', 'edit']);

        $validated = $request->validate([
            'workflow_status' => 'required|in:new,in_review,resolved,archived',
            'review_note' => 'nullable|string|max:2000',
        ]);

        $message = ContactMessage::query()->findOrFail($id);
        $message->workflow_status = $validated['workflow_status'];
        $message->review_note = $validated['review_note'] ?? null;
        $message->reviewed_at = now();
        $message->reviewed_by = auth('panel')->id();
        $message->save();

        return redirect()->route('contact-message.show', $message->id)->with('success', 'وضعیت پیام به‌روزرسانی شد.');
    }

    public function destroy(string $id)
    {
        Gate::authorize('can-access', ['contactmessage', 'delete']);

        ContactMessage::query()->findOrFail($id)->delete();

        return redirect()->route('contact-message.index')->with('success', 'پیام حذف شد.');
    }
}
