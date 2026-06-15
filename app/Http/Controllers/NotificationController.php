<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
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
        if (!$user) {
            return response()->json(['notifications' => [], 'unread_count' => 0]);
        }

        $notifications = $user->notifications()
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn($n) => [
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

    public function markAsRead($id): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return response()->json(['unread_count' => 0], 401);
        }

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['unread_count' => $user->unreadNotifications()->count()]);
    }

    public function markAllRead(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return response()->json(['unread_count' => 0], 401);
        }

        $user->unreadNotifications()->update(['read_at' => now()]);

        return response()->json(['unread_count' => 0]);
    }

    public function clearAll(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return response()->json(['unread_count' => 0], 401);
        }

        $user->notifications()->delete();

        return response()->json(['unread_count' => 0]);
    }
}
