<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use App\Models\ContactMessage;
use App\Models\Content;
use App\Models\Emploee;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CvcController extends Controller
{
    public function home(): View
    {
        $pageContent = $this->getPageContent('cvc-home');
        $homeProjects = collect();
        $homeTeamMembers = collect();
        $homeNews = collect();

        if (Schema::hasTable('products')) {
            $homeProjects = Product::query()
                ->where('status', 4)
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderByDesc('id')
                ->take(6)
                ->get();
        }

        if (Schema::hasTable('emploees')) {
            $homeTeamMembers = Emploee::query()
                ->where('status', 4)
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderBy('id')
                ->take(3)
                ->get();
        }

        if (Schema::hasTable('posts')) {
            $homeNews = Post::query()
                ->where('status', 4)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('site.cvc.home', compact('pageContent', 'homeProjects', 'homeTeamMembers', 'homeNews'));
    }

    public function home3(): View
    {
        $pageContent = $this->getPageContent('cvc-home3');

        return view('site.cvc.home3', compact('pageContent'));
    }


    public function about(): View
    {
        $pageContent = $this->getPageContent('cvc-about');
        $teamMembers = collect();
        $teamCount = 0;
        $projectCount = 0;
        $newsCount = 0;

        if (Schema::hasTable('emploees')) {
            $teamMembers = Emploee::query()
                ->where('status', 4)
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderBy('id')
                ->take(6)
                ->get();
            $teamCount = Emploee::query()->where('status', 4)->count();
        }

        if (Schema::hasTable('products')) {
            $projectCount = Product::query()->where('status', 4)->count();
        }

        if (Schema::hasTable('posts')) {
            $newsCount = Post::query()->where('status', 4)->count();
        }

        return view('site.cvc.about', compact('pageContent', 'teamMembers', 'teamCount', 'projectCount', 'newsCount'));
    }

    public function contact(): View
    {
        $pageContent = $this->getPageContent('cvc-contact');
        return view('site.cvc.contact', compact('pageContent'));
    }

    public function career(): View
    {
        $pageContent = $this->getPageContent('cvc-career');
        return view('site.cvc.career', compact('pageContent'));
    }

    public function faq(): View
    {
        [$pageContent, $items] = $this->getDynamicPageContent('cvc-faq', 'faq');
        return view('site.cvc.faq', compact('pageContent', 'items'));
    }

    public function domains(): View
    {
        [$pageContent, $items] = $this->getDynamicPageContent('cvc-domains', 'domain');
        return view('site.cvc.domains', compact('pageContent', 'items'));
    }

    public function investment(): View
    {
        [$pageContent, $items] = $this->getDynamicPageContent('cvc-investment', 'investment');
        return view('site.cvc.investment', compact('pageContent', 'items'));
    }

    public function investmentProcess(): View
    {
        [$pageContent, $items] = $this->getDynamicPageContent('cvc-investment-process', 'investment-process');
        return view('site.cvc.investment-process', compact('pageContent', 'items'));
    }

    public function team(): View
    {
        $teamMembers = collect();

        if (Schema::hasTable('emploees')) {
            $teamMembers = Emploee::query()
                ->where('status', 4)
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderBy('id')
                ->get();
        }

        return view('site.cvc.team', compact('teamMembers'));
    }

    public function teamMember(string $slug): View
    {
        abort_unless(Schema::hasTable('emploees'), 404);

        $member = Emploee::query()
            ->where('status', 4)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.cvc.team-member', compact('member'));
    }

    public function portfolio(): View
    {
        $projects = collect();
        $categories = collect();

        if (Schema::hasTable('products')) {
            $projects = Product::query()
                ->where('status', 4)
                ->orderByRaw('COALESCE(priority, 999999) asc')
                ->orderByDesc('id')
                ->take(24)
                ->get();

            $categories = $projects
                ->pluck('sub_title')
                ->filter()
                ->unique()
                ->values();
        }

        return view('site.cvc.portfolio', compact('projects', 'categories'));
    }

    public function legacyTeamMember(): RedirectResponse
    {
        if (!Schema::hasTable('emploees')) {
            return redirect()->route('cvc.team');
        }

        $member = Emploee::query()
            ->where('status', 4)
            ->orderByRaw('COALESCE(priority, 999999) asc')
            ->orderBy('id')
            ->first();

        if (!$member || empty($member->slug)) {
            return redirect()->route('cvc.team');
        }

        return redirect()->route('cvc.team-member', $member->slug);
    }

    public function news(Request $request): View|JsonResponse
    {
        $featured = null;
        $listPosts = collect();
        $popularPosts = collect();
        $categories = collect();
        $tags = collect();
        $hasMore = false;
        $nextOffset = 0;

        if (Schema::hasTable('posts')) {
            $query = Post::query()
                ->where('status', 4)
                ->with('user:id,name,username')
                ->latest();

            $totalPosts = (clone $query)->count();
            $listOffset = max(0, (int) $request->integer('offset', 0));

            $featured = (clone $query)->first();
            $listPosts = (clone $query)
                ->skip($featured ? ($listOffset + 1) : $listOffset)
                ->take(6)
                ->get();
            $nextOffset = $listOffset + $listPosts->count();
            $remainingPosts = max($totalPosts - ($featured ? 1 : 0), 0);
            $hasMore = $nextOffset < $remainingPosts;

            $popularPosts = Post::query()
                ->where('status', 4)
                ->with('user:id,name,username')
                ->latest()
                ->take(4)
                ->get();

            $categories = Post::query()
                ->where('status', 4)
                ->selectRaw('COALESCE(NULLIF(sub_title, ""), "عمومی") as category, COUNT(*) as total')
                ->groupBy('category')
                ->orderByDesc('total')
                ->take(6)
                ->get();

            $tags = Post::query()
                ->where('status', 4)
                ->pluck('en_title')
                ->filter()
                ->flatMap(function ($value) {
                    return collect(explode(',', $value))
                        ->map(fn ($tag) => trim($tag))
                        ->filter();
                })
                ->unique()
                ->values()
                ->take(12);
        }

        if ($request->boolean('fragment') || $request->ajax()) {
            return response()->json([
                'html' => view('site.cvc.partials.news-cards', compact('listPosts'))->render(),
                'hasMore' => $hasMore,
                'nextOffset' => $nextOffset,
            ]);
        }

        return view('site.cvc.news', compact('featured', 'listPosts', 'popularPosts', 'categories', 'tags', 'hasMore', 'nextOffset'));
    }

    public function singleNews(string $slug): View
    {
        abort_unless(Schema::hasTable('posts'), 404);

        $post = Post::query()
            ->with('user:id,name,username')
            ->where('slug', $slug)
            ->where('status', 4)
            ->firstOrFail();

        $popularPosts = Post::query()
            ->where('status', 4)
            ->with('user:id,name,username')
            ->latest()
            ->take(4)
            ->get();

        $categories = Post::query()
            ->where('status', 4)
            ->selectRaw('COALESCE(NULLIF(sub_title, ""), "عمومی") as category, COUNT(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->take(6)
            ->get();

        $tags = Post::query()
            ->where('status', 4)
            ->pluck('en_title')
            ->filter()
            ->flatMap(function ($value) {
                return collect(explode(',', $value))
                    ->map(fn ($tag) => trim($tag))
                    ->filter();
            })
            ->unique()
            ->values()
            ->take(12);

        $relatedPosts = Post::query()
            ->where('status', 4)
            ->where('id', '!=', $post->id)
            ->when($post->sub_title, function ($query) use ($post) {
                $query->where('sub_title', $post->sub_title);
            })
            ->with('user:id,name,username')
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::query()
                ->where('status', 4)
                ->where('id', '!=', $post->id)
                ->with('user:id,name,username')
                ->latest()
                ->take(3)
                ->get();
        }

        return view('site.cvc.single-news', compact('post', 'relatedPosts', 'popularPosts', 'categories', 'tags'));
    }

    public function legacySingleNews(): RedirectResponse
    {
        if (!Schema::hasTable('posts')) {
            return redirect()->route('cvc.news');
        }

        $post = Post::query()->where('status', 4)->latest()->first();

        if (!$post) {
            return redirect()->route('cvc.news');
        }

        return redirect()->route('cvc.single-news', $post->slug);
    }

    public function applyCareer(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'national_code' => ['required', 'string', 'size:10'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:20'],
            'marital_status' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'education' => ['nullable', 'array'],
            'experience' => ['nullable', 'array'],
            'skills' => ['nullable', 'string'],
            'languages' => ['nullable', 'string'],
            'position' => ['required', 'string', 'max:100'],
            'expected_salary' => ['required', 'string', 'max:100'],
            'availability' => ['required', 'string', 'max:50'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'documents' => ['nullable', 'file', 'mimes:pdf,zip', 'max:10240'],
            'motivation' => ['nullable', 'string'],
            'source' => ['nullable', 'string', 'max:50'],
            'terms' => ['required', 'accepted'],
        ]);

        $resumePath = $request->file('resume')->store('career/resume', 'public');
        $documentsPath = $request->hasFile('documents')
            ? $request->file('documents')->store('career/documents', 'public')
            : null;

        CareerApplication::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_code' => $validated['national_code'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'marital_status' => $validated['marital_status'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'],
            'province' => $validated['province'],
            'education' => $validated['education'] ?? [],
            'experience' => $validated['experience'] ?? [],
            'skills' => $validated['skills'] ?? null,
            'languages' => $validated['languages'] ?? null,
            'position' => $validated['position'],
            'expected_salary' => $validated['expected_salary'],
            'availability' => $validated['availability'],
            'resume_path' => $resumePath,
            'documents_path' => $documentsPath,
            'motivation' => $validated['motivation'] ?? null,
            'source' => $validated['source'] ?? null,
            'terms' => true,
        ]);

        return redirect()->route('cvc.career')->with('career_success', true);
    }

    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($validated);

        return redirect()->route('cvc.contact')->with('contact_success', true);
    }

    private function getDynamicPageContent(string $pageSlug, string $section): array
    {
        $pageContent = null;
        $items = collect();

        if (Schema::hasTable('contents')) {
            $pageContent = Content::query()
                ->where('status', 4)
                ->where(function ($query) use ($pageSlug) {
                    $query->where('slug', $pageSlug)
                        ->orWhere('meta_title', 'page:' . $pageSlug);
                })
                ->first();

            $items = Content::query()
                ->where('status', 4)
                ->where('meta_title', 'section:' . $section)
                ->orderByDesc('id')
                ->take(12)
                ->get();
        }

        return [$pageContent, $items];
    }

    private function getPageContent(string $pageSlug): ?Content
    {
        if (!Schema::hasTable('contents')) {
            return null;
        }

        return Content::query()
            ->where('status', 4)
            ->where(function ($query) use ($pageSlug) {
                $query->where('slug', $pageSlug)
                    ->orWhere('meta_title', 'page:' . $pageSlug);
            })
            ->first();
    }
}
