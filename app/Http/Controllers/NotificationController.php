<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public static function notifyAdmins(object $notification): void
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, $notification);
    }

    public function index(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return response()->json(['notifications' => [], 'unread_count' => 0]);
        }

        $notifications = $user->notifications()
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn ($n) => [
                'id' => $n->id,
                'title' => $n->data['title'] ?? '',
                'message' => $n->data['message'] ?? '',
                'url' => $n->data['url'] ?? null,
                'type' => $n->type,
                'is_read' => $n->read_at !== null,
                'created_at' => $n->created_at,
            ]);

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function handleAction(Request $request): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return response()->json(['unread_count' => 0], 401);
        }

        $action = $request->input('action');

        match ($action) {
            'read-all' => $user->unreadNotifications()->update(['read_at' => now()]),
            'clear-all' => $user->notifications()->delete(),
            'read' => $user->notifications()->findOrFail($request->input('id'))->markAsRead(),
            default => abort(400),
        };

        return response()->json(['unread_count' => $user->unreadNotifications()->count()]);
    }
}
