<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\ClassMeeting\ClassMeetingStoreRequest;
use App\Models\ClassMeeting;
use App\Models\ClassRoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClassMeetingController extends Controller
{
    const MEETING_TYPE_INSTANT = 1;

    const MEETING_TYPE_SCHEDULE = 2;

    const MEETING_TYPE_RECURRING = 3;

    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index(ClassRoom $classroom)
    {
        $meetings = ClassMeeting::select(['id', 'meeting_id', 'topic', 'start_date_time', 'duration', 'start_url', 'join_url', 'password'])->where('class_room_id', $classroom->id)->latest()->paginate(10);

        return view('teacher.class_meeting.index', compact('meetings', 'classroom'));
    }

    public function create(ClassRoom $classroom)
    {
        $this->data['title'] = 'Create';
        $this->data['route'] = route('teacher.class_meeting.store', $classroom->id);
        $this->data['classroom'] = $classroom;

        return view('teacher.class_meeting.create', $this->data);
    }

    protected function generateToken(): string
    {
        try {
            $base64String = base64_encode(config('services.zoom.client_id').':'.config('services.zoom.client_secret'));
            $accountId = config('services.zoom.account_id');

            $responseToken = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Basic {$base64String}",
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(ClassRoom $classroom, ClassMeetingStoreRequest $request)
    {
        $validated = $request->validated();

        $payload = [
            'topic' => $validated['topic'],
            'type' => isset($validated['recurring_meeting']) ? self::MEETING_TYPE_FIXED_RECURRING_FIXED : self::MEETING_TYPE_SCHEDULE,
            // 'start_time' => Carbon::parse($validated['start_date_time'])->toIso8601String(),
            'start_time' => Carbon::parse($validated['start_date_time'])->addHours(5)->addMinutes(45),  // adding 5:45 for npt time
            'timezone' => 'NP',
            'duration' => $validated['duration'],
            'auto_recording' => 'cloud',
            'default_password' => false,
            'password' => $validated['password'],
        ];

        if (isset($validated['recurring_meeting'])) {
            $payload['recurrence'] = [
                'type' => $validated['recurrence'],
                'repeat_interval' => $validated['repeat_interval'],
                'end_times' => $validated['end_time_after'],
            ];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->post('https://api.zoom.us/v2/users/me/meetings', $payload);
        } catch (\Throwable $th) {
            return $this->backWithError('Failed to create meeting link.');
        }

        $data = json_decode($response->body(), true);

        $meeting = ClassMeeting::create([
            'class_room_id' => $classroom->id,
            'meeting_id' => "{$data['id']}",
            'host_id' => $data['host_id'],
            'host_email' => $data['host_email'],
            // 'alternative_hosts' => $data['settings']['alternative_hosts'],
            'topic' => $data['topic'],
            'start_date_time' => Carbon::parse(isset($validated['recurring_meeting']) ? $data['occurrences'][0]['start_time'] : $data['start_time']),
            'duration' => isset($validated['recurring_meeting']) ? $data['occurrences'][0]['duration'] : $data['duration'],
            'start_url' => $data['start_url'],
            'join_url' => $data['join_url'],
            'password' => $data['password'],
            'recurring' => $validated['recurring_meeting'] ?? 0,
            'recurring_type' => isset($validated['recurring_meeting']) ? $validated['recurrence'] : null,
            'recurring_repeat_interval' => isset($validated['recurring_meeting']) ? $validated['repeat_interval'] : null,
            'recurring_end_times' => isset($validated['recurring_meeting']) ? $validated['end_time_after'] : null,
        ]);

        return $this->redirectWithSuccess('teacher.classroom.index', 'Meeting Link Added Successfully.');
    }

    public function getMeetingRecording()
    {
        $meetingId = '86833566911';
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->get('https://api.zoom.us/v2/meetings/'.$meetingId.'/recordings');

            $recording = json_decode($response->body(), true);
            dd($recording);
            // exec('wget', $output, $retval);
            // return redirect($recording['recording_files'][0]['download_url']);
            dd($recording['recording_files'][0]['download_url']);
        } catch (\Throwable $th) {
            return 'error';

            return $this->backWithError('Failed to create meeting link.');
        }
    }

    public function getMeetingParticipants()
    {
        $meetingId = '86833566911';
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->get('https://api.zoom.us/v2/past_meetings/'.$meetingId.'/participants');

            $participants = json_decode($response->body(), true);
            dd($participants);
            // return redirect($recording['recording_files'][0]['download_url']);
            // dd($recording['recording_files'][0]['download_url']);
        } catch (\Throwable $th) {
            return $this->backWithError('Failed to get participants.');
        }
    }

    public function show(ClassRoom $classroom, ClassMeeting $classMeeting)
    {
        $this->data['title'] = 'Show';
        $this->data['classroom'] = $classroom;
        $this->data['classMeeting'] = $classMeeting;
        $this->data['route'] = '';
        $this->data['updatedStartUrl'] = $this->getMeetingDetails($classMeeting->meeting_id);
        
        return view('teacher.class_meeting.create', $this->data);
    }

    public function getMeetingDetails($meetingId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->get('https://api.zoom.us/v2/meetings/'.$meetingId);

            $classMeeting = json_decode($response->body(), true);

            return $classMeeting['start_url'];
        } catch (\Throwable $th) {
            Log::error('Failed to get meeting details of Id: ' . $meetingId);
            return '';
        }
    }

    public function edit(ClassRoom $classroom, ClassMeeting $classMeeting)
    {
        $this->data['title'] = 'Edit';
        $this->data['classroom'] = $classroom;
        $this->data['classMeeting'] = $classMeeting;
        $this->data['route'] = route('teacher.class_meeting.update', [$classroom->id, $classMeeting->id]);

        return view('teacher.class_meeting.create', $this->data);
    }

    public function update(ClassMeetingStoreRequest $request, ClassRoom $classroom, ClassMeeting $classMeeting)
    {
        $validated = $request->validated();

        $payload = [
            'topic' => $validated['topic'],
            'type' => isset($validated['recurring_meeting']) ? self::MEETING_TYPE_FIXED_RECURRING_FIXED : self::MEETING_TYPE_SCHEDULE,
            'start_time' => Carbon::parse($validated['start_date_time'])->toIso8601String(),
            'duration' => $validated['duration'],
            'password' => $validated['password'],
        ];

        if (isset($validated['recurring_meeting'])) {
            $payload['recurrence'] = [
                'type' => $validated['recurrence'],
                'repeat_interval' => $validated['repeat_interval'],
                'end_times' => $validated['end_time_after'],
            ];
        }
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->patch('https://api.zoom.us/v2/meetings/'.$classMeeting->meeting_id, $payload);
        } catch (\Throwable $th) {
            return $this->backWithError('Failed to update meeting link.');
        }

        $data = json_decode($response->body(), true);

        $meeting = $classMeeting->update([
            'topic' => $validated['topic'] ?? $classMeeting->topic,
            'start_date_time' => Carbon::parse($validated['start_date_time'] ?? $classMeeting->start_date_time),
            'duration' => $validated['duration'] ?? $classMeeting->duration,
            'password' => $validated['password'] ?? $classMeeting->password,
            'recurring' => $validated['recurring_meeting'] ?? 0,
            'recurring_type' => isset($validated['recurring_meeting']) ? $validated['recurrence'] : null,
            'recurring_repeat_interval' => isset($validated['recurring_meeting']) ? $validated['repeat_interval'] : null,
            'recurring_end_times' => isset($validated['recurring_meeting']) ? $validated['end_time_after'] : null,
        ]);

        return $this->redirectWithSuccess('teacher.class_meeting.index', 'Meeting Link Updated Successfully.', [$classroom->id, $classMeeting->id]);

    }

    public function destroy(ClassRoom $classroom, ClassMeeting $classMeeting)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.self::generateToken(),
                'Content-Type' => 'application/json',
            ])->delete('https://api.zoom.us/v2/meetings/'.$classMeeting->meeting_id);
        } catch (\Throwable $th) {
            return $this->backWithError('Failed to update meeting link.');
        }

        $status = $response->status();

        if ($status != 204) {
            return $this->backWithError(message: 'Meeting Link Deletion Failed');
        }

        $deleted = $classMeeting->delete();

        return $this->redirectWithSuccess('teacher.class_meeting.index', 'Meeting Link Deleted Successfully.', [$classroom->id, $classMeeting->id]);
    }
}
