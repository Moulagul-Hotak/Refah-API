<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const IMAGE_PATH = 'public/images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setEmailAttribute($value)
    {
        return $this->attributes['email'] = strtolower($value);
    }

    public function getImagePathAttribute($value)
    {
        return url('/').Storage::url($value);
    }

    public static function storeUser(Request $request)
    {
        //store the user's image in the specific path
        $imagePath = $request->file('image')->store(static::IMAGE_PATH);

        return User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image_path' => $imagePath
            ]
        );
    }

    public static function updateUser(Request $request, User $user)
    {
        //store the user's image in the specific path
        if ($request->hasFile('image'))
            $user->image_path = $request->file('image')->store(static::IMAGE_PATH);

        if ($request->password)
            $user->password = Hash::make($request->password);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return;
    }
}
