<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\ActivityLog;
use App\Models\AiReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TourismController extends Controller
{
    public function home()
    {
        return view('tourism.home');
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->role === 'Admin') {
            return view('tourism.admin');
        }

        if ($user->role === 'Staff') {
            return view('tourism.staff');
        }

        return view('tourism.tourist');
    }

    public function destinations()
    {
        return Destination::latest()->get();
    }

    public function storeDestination(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'location' => 'required',
        ]);

        $destination = Destination::create($data);

        $this->log('Admin', auth()->user()->name ?? 'System', 'Created Destination', $destination->name);

        return response()->json($destination);
    }

    public function updateDestination(Request $request, Destination $destination)
    {
        $destination->update($request->only([
            'name',
            'category',
            'description',
            'location',
        ]));

        $this->log('Admin', auth()->user()->name ?? 'System', 'Updated Destination', $destination->name);

        return response()->json($destination);
    }

    public function deleteDestination(Destination $destination)
    {
        $name = $destination->name;
        $destination->delete();

        $this->log('Admin', auth()->user()->name ?? 'System', 'Deleted Destination', $name);

        return response()->json(['success' => true]);
    }

    public function questions()
    {
        return SurveyQuestion::latest()->get();
    }

    public function storeQuestion(Request $request)
    {
        $data = $request->validate([
            'text' => 'required',
            'category' => 'required',
            'type' => 'required',
        ]);

        $data['is_active'] = true;

        $question = SurveyQuestion::create($data);

        $this->log('Admin', auth()->user()->name ?? 'System', 'Created Question', $question->text);

        return response()->json($question);
    }

    public function updateQuestion(Request $request, SurveyQuestion $question)
    {
        $question->update($request->only([
            'text',
            'category',
            'type',
            'is_active',
        ]));

        $this->log('Admin', auth()->user()->name ?? 'System', 'Updated Question', $question->text);

        return response()->json($question);
    }

    public function deleteQuestion(SurveyQuestion $question)
    {
        $text = $question->text;
        $question->delete();

        $this->log('Admin', auth()->user()->name ?? 'System', 'Deleted Question', $text);

        return response()->json(['success' => true]);
    }

    public function responses()
    {
        return SurveyResponse::with('destination')->latest()->get();
    }

    public function storeResponse(Request $request)
    {
        $data = $request->validate([
            'tourist_name' => 'required',
            'tourist_email' => 'nullable',
            'nationality' => 'required',
            'age_group' => 'required',
            'destination_id' => 'required|exists:destinations,id',
            'answers' => 'required|array',
            'feedback_text' => 'nullable',
            'encoded_by' => 'nullable',
        ]);

        $ratings = collect($data['answers'])
            ->filter(fn ($answer) => is_numeric($answer))
            ->values();

        $data['overall_rating'] = $ratings->count() > 0
            ? round($ratings->avg(), 1)
            : 0;

        $data['encoded_by'] = $data['encoded_by'] ?? 'self';

        $response = SurveyResponse::create($data);

        $this->updateDestinationRating($data['destination_id']);

        $this->log(
            auth()->user()->role ?? 'Tourist',
            auth()->user()->name ?? $data['tourist_name'],
            'Submitted Survey',
            'Survey response submitted by '.$data['tourist_name']
        );

        return response()->json($response->load('destination'));
    }

    public function logs()
    {
        return ActivityLog::latest()->get();
    }

    public function users()
    {
        return User::select('id', 'name', 'email', 'role', 'username')->latest()->get();
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4',
            'role' => 'required|in:Admin,Staff,Tourist',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $this->log('Admin', auth()->user()->name ?? 'System', 'Created Account', $user->username);

        return response()->json($user);
    }

    public function deleteUser(User $user)
    {
        if ($user->username === 'admin') {
            return response()->json(['error' => 'Main admin cannot be deleted.'], 403);
        }

        $username = $user->username;
        $user->delete();

        $this->log('Admin', auth()->user()->name ?? 'System', 'Deleted Account', $username);

        return response()->json(['success' => true]);
    }

    public function aiReport()
    {
        return AiReport::latest()->first()?->report ?? null;
    }

    public function generateAiReport()
    {
        $responses = SurveyResponse::with('destination')->latest()->get();

        $report = [
            'overallSatisfaction' => 'Tourists are generally satisfied with Hinunangan destinations, especially island attractions and hospitality.',
            'swotAnalysis' => [
                'strengths' => [
                    'Beautiful natural destinations',
                    'Friendly local tourism assistance',
                    'High satisfaction ratings from tourists',
                ],
                'weaknesses' => [
                    'Some destinations need better signage',
                    'Limited emergency assistance visibility',
                    'Transport accessibility can still improve',
                ],
                'opportunities' => [
                    'Promote island hopping packages',
                    'Improve online tourism feedback collection',
                    'Develop local guide training programs',
                ],
                'threats' => [
                    'Poor waste management may affect tourist experience',
                    'Weather disruptions may affect island travel',
                    'Overcrowding can reduce destination quality',
                ],
            ],
            'destinationInsights' => $responses->groupBy('destination_id')->map(function ($items) {
                $destination = $items->first()->destination;

                return [
                    'destinationName' => $destination?->name ?? 'Unknown',
                    'insight' => 'Average rating: '.round($items->avg('overall_rating'), 1).' from '.$items->count().' response(s).',
                    'recommendation' => 'Maintain strong service quality and improve accessibility, signage, and cleanliness.',
                ];
            })->values(),
            'strategicRecommendations' => [
                'Improve tourist signage and destination information boards.',
                'Strengthen cleanliness monitoring in beach and island areas.',
                'Train staff for better visitor assistance and emergency response.',
                'Use survey reports for monthly tourism planning.',
            ],
            'generatedAt' => now()->toDateTimeString(),
        ];

        AiReport::create(['report' => $report]);

        $this->log('Admin', auth()->user()->name ?? 'System', 'Generated AI Report', 'Generated tourism advisory report.');

        return response()->json([
            'report' => $report,
            'isDemo' => true,
            'message' => 'Demo AI report generated successfully.',
        ]);
    }

    public function resetDatabase()
    {
        SurveyResponse::truncate();
        ActivityLog::truncate();
        AiReport::truncate();

        Destination::query()->update([
            'average_rating' => 0,
            'total_reviews' => 0,
        ]);

        $this->log('Admin', auth()->user()->name ?? 'System', 'Reset Database', 'Survey responses and reports cleared.');

        return response()->json(['success' => true]);
    }

    private function updateDestinationRating($destinationId): void
    {
        $destination = Destination::find($destinationId);

        if (!$destination) return;

        $responses = SurveyResponse::where('destination_id', $destinationId)->get();

        $destination->update([
            'average_rating' => round($responses->avg('overall_rating'), 1),
            'total_reviews' => $responses->count(),
        ]);
    }

    private function log($role, $actor, $action, $details = null): void
    {
        ActivityLog::create([
            'user_role' => $role,
            'actor_name' => $actor,
            'action' => $action,
            'details' => $details,
        ]);
    }
}