<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::where('id',$this->assigned_to_id)->first();
        $admin = User::where('id',$this->assigned_by_id)->first();

        return [

            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'assigned_name' => $user->name,
            'admin_name' => $admin->name,
          
        ];
    }
}
