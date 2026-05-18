<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    private array $statuses = ['new', 'in_review', 'shortlisted', 'rejected', 'hired', 'archived'];

    public function index()
    {
        Gate::authorize('can-access', ['careerapplication', 'view']);

        $thispage = [
            'title' => 'درخواست‌های همکاری',
            'list' => 'لیست درخواست‌های همکاری',
        ];

        $applications = CareerApplication::query()->latest()->paginate(20);

        return view('panel.career-application', compact('thispage', 'applications'));
    }

    public function show(string $id)
    {
        Gate::authorize('can-access', ['careerapplication', 'view']);

        $thispage = [
            'title' => 'جزئیات درخواست همکاری',
            'list' => 'جزئیات درخواست همکاری',
        ];

        $application = CareerApplication::query()->findOrFail($id);
        $statuses = $this->statuses;

        return view('panel.career-application-show', compact('thispage', 'application', 'statuses'));
    }

    public function updateStatus(Request $request, string $id)
    {
        Gate::authorize('can-access', ['careerapplication', 'edit']);

        $validated = $request->validate([
            'workflow_status' => 'required|in:new,in_review,shortlisted,rejected,hired,archived',
            'review_note' => 'nullable|string|max:2000',
        ]);

        $application = CareerApplication::query()->findOrFail($id);
        $application->workflow_status = $validated['workflow_status'];
        $application->review_note = $validated['review_note'] ?? null;
        $application->reviewed_at = now();
        $application->reviewed_by = auth('panel')->id();
        $application->save();

        return redirect()->route('career-application.show', $application->id)->with('success', 'وضعیت درخواست به‌روزرسانی شد.');
    }

    public function destroy(string $id)
    {
        Gate::authorize('can-access', ['careerapplication', 'delete']);

        CareerApplication::query()->findOrFail($id)->delete();

        return redirect()->route('career-application.index')->with('success', 'درخواست حذف شد.');
    }

    public function downloadResume(string $id)
    {
        Gate::authorize('can-access', ['careerapplication', 'view']);

        $application = CareerApplication::query()->findOrFail($id);
        abort_unless($application->resume_path && Storage::disk('public')->exists($application->resume_path), 404);

        return Storage::disk('public')->download($application->resume_path);
    }

    public function downloadDocuments(string $id)
    {
        Gate::authorize('can-access', ['careerapplication', 'view']);

        $application = CareerApplication::query()->findOrFail($id);
        abort_unless($application->documents_path && Storage::disk('public')->exists($application->documents_path), 404);

        return Storage::disk('public')->download($application->documents_path);
    }
}
