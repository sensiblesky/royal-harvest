<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Candidate;
use App\Models\Contact;
use App\Models\Programme;
use App\Models\Venture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'ventures' => Venture::count(),
            'programmes' => Programme::count(),
            'candidates' => Candidate::count(),
            'contacts' => Contact::count(),
        ];
        $recent = Candidate::with('programme')->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }

    /* ---------------- Ventures ---------------- */
    public function ventures()
    {
        return view('admin.ventures', ['ventures' => Venture::orderBy('sort')->get()]);
    }

    public function storeVenture(Request $request)
    {
        $data = $this->validateVenture($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ventures', 'public');
        }
        Venture::create($data);

        return back()->with('message', 'Venture added.');
    }

    public function updateVenture(Request $request, Venture $venture)
    {
        $data = $this->validateVenture($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ventures', 'public');
        }
        $venture->update($data);

        return back()->with('message', 'Venture updated.');
    }

    public function toggleVenture(Venture $venture)
    {
        $venture->update(['isActive' => ! $venture->isActive]);

        return back()->with('message', 'Venture visibility updated.');
    }

    public function removeVenture(Venture $venture)
    {
        $venture->delete();

        return back()->with('message', 'Venture removed.');
    }

    private function validateVenture(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:120',
            'tagline' => 'nullable|string|max:160',
            'description' => 'nullable|string|max:600',
            'category' => 'nullable|string|max:60',
            'icon' => 'nullable|string|max:40',
            'url' => 'nullable|string|max:255',
            'status' => 'required|in:live,coming_soon',
            'sort' => 'nullable|integer',
            'image' => 'nullable|image|max:4096',
        ]);
    }

    /* ---------------- Programmes ---------------- */
    public function programmes()
    {
        return view('admin.programmes', ['programmes' => Programme::latest()->get()]);
    }

    public function storeProgramme(Request $request)
    {
        $data = $this->validateProgramme($request);
        Programme::create($data);

        return back()->with('message', 'Programme added.');
    }

    public function updateProgramme(Request $request, Programme $programme)
    {
        $data = $this->validateProgramme($request);
        $programme->update($data);

        return back()->with('message', 'Programme updated.');
    }

    public function toggleProgramme(Programme $programme)
    {
        $programme->update(['isActive' => ! $programme->isActive]);

        return back()->with('message', 'Programme visibility updated.');
    }

    public function removeProgramme(Programme $programme)
    {
        $programme->delete();

        return back()->with('message', 'Programme removed.');
    }

    private function validateProgramme(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:120',
            'cost' => 'required|string|max:60',
            'duration' => 'required|string|max:60',
            'summary' => 'nullable|string|max:600',
        ]);
    }

    /* ---------------- Candidates ---------------- */
    public function candidates()
    {
        return view('admin.candidates', [
            'candidates' => Candidate::with('programme')->latest()->paginate(15),
        ]);
    }

    public function toggleCandidate(Candidate $candidate)
    {
        $candidate->update(['isActive' => ! $candidate->isActive]);

        return back()->with('message', 'Candidate status updated.');
    }

    public function removeCandidate(Candidate $candidate)
    {
        $candidate->delete();

        return back()->with('message', 'Candidate removed.');
    }

    /* ---------------- Blogs ---------------- */
    public function blogs()
    {
        return view('admin.blogs', ['blogs' => Blog::latest()->get()]);
    }

    public function storeBlog(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:160',
            'content' => 'required|string',
            'image' => 'nullable|image|max:4096',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }
        Blog::create($data);

        return back()->with('message', 'Post published.');
    }

    public function removeBlog(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return back()->with('message', 'Post removed.');
    }

    /* ---------------- Contacts ---------------- */
    public function contacts()
    {
        return view('admin.contacts', ['contacts' => Contact::latest()->paginate(15)]);
    }

    public function removeContact(Contact $contact)
    {
        $contact->delete();

        return back()->with('message', 'Message removed.');
    }
}
