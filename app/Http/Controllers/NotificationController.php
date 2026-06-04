<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return response()->json(['notifications' => [], 'unread_count' => 0]);
        }

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->limit(20)
            ->get();

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

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

        $notification = Notification::where('user_id', $user->id)->findOrFail($id);
        $notification->update(['is_read' => true]);

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }

    public function markAllRead(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            return response()->json(['unread_count' => 0], 401);
        }

        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['unread_count' => 0]);
    }
}
